<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    public function list()
    {
        return response()->json([
            'data'=>auth()->user()->notifications()->orderBy('id','desc')->limit(5)->get()
        ],200);
    }
}
