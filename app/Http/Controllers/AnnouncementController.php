<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{
    public function index()
    {   
        $announcements = Announcement::with('user')->orderBy('id','desc')->get();
        return view('announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcement.create');
    }
    public function store(Request $request)
    {
        Announcement::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>auth()->user()->id
        ]);

        Session::flash('status','Success!');
        Session::flash('statuscode','Annoucement Added!');
        
        return redirect()->back();
    }
}
