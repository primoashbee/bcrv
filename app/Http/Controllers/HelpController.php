<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->roles()->where("name","Admin")->count() == 1){
            return view('help');
        }
        return view('student-help');
    }
}
