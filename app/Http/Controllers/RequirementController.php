<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequirementController extends Controller
{
    
    public function index()
    {
        $list = ['Form 137', 'Birth Certificate', 'NBI Clearance'];
        return view('admin.requirements.index',compact('list'));
    }
}
