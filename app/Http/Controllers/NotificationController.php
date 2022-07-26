<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    
    public function list()
    {
        return response()->json([
            'data'=>auth()->user()->notifications()->orderBy('id','desc')->limit(5)->get()
        ],200);
    }

    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return response()->json([
            'message'=>'Read',
            'code'=>200,
            'data'=> [
                'link'=> $notification->data['link']
            ]
        ],200);

    }
}
