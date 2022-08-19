<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\Http\Controllers\Controller;
use App\Models\PrimaryModels\StudentInfo;
use App\Models\Roles\RoleModel;
use App\Models\RoleUser\RoleUsers;
use Sentinel;
use Session;
use App\User;

class UserController extends Controller
{
    // show users page
    public function show_users() {
        $users = Sentinel::getUserRepository()->with('roles')->get();
        $users = User::has('studentInfo')->with('roles','studentInfo')->get();
        return view('admin.users.users')->with('users', $users);
    }

    //  show the page to edit the students
    public function show_edit_user_view($id){
        $users = Sentinel::findById($id);
        $data['roles'] = RoleModel::get();
        return view('admin.users.edit_user')->with('users', $users)
                                        ->with('data', $data);
    }

    // function for the update user
    public function edit_user(Request $request, $id)
    {
        $user = Sentinel::findById($id);
        $rolUser = $user->roles()->get();
        $roles = Sentinel::findRoleBySlug($rolUser[0]->slug);
        $roles->users()->detach($user);
        $data = $request->input('role');
        $role = Sentinel::findRoleById($data);
        $role->users()->attach($user);
        $user->status = $request->status;
        $user->save();
        Session::flash('statuscode', 'info');
        return redirect('show_users')->with('status', 'Data Updated Successfully!');
    }

    // delete user
    public function delete_user($id) {   
        $user = Sentinel::findById($id);   
        $user->delete();

        Session::flash('statuscode', 'error');
        return redirect('show_users')->with('status', 'User Deleted!');
    }
}
