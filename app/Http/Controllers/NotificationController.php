<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    
    public function index()
    {

        $notifications = auth()->user()->notifications()->orderBy('id','desc')->get();
        return view('notifications', compact('notifications'));
    }
    public function list()
    {

        $list = auth()->user()->notifications()->orderBy('id','desc')->limit(5)->get();
        $data = count($list) > 0 ?  $list : [];
        return response()->json([
            'data'=>  $data
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

    public function view(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return redirect($notification->data['link']);
    }
}
