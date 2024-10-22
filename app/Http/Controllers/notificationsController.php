<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;

class notificationsController extends Controller
{
    private function handleResponse($status,$code,$msg,$data){
        return [
            'status'  => $status,
            'code'    => $code,
            'message' => $msg,
            'data'    => $data
        ];
    }   
    public function getNotifications()
    {
        $notifications = notification::all();
        return response()->json($this->handleResponse('sucess',200,'sucess',$notifications),200);
    }
    public function createNotification(Request $request){
        $path = $request->file('image')->store('/','notifications');

        $filename = $request->file('image')->hashName();

        $create = notification::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>'https:\/\/atr-eg.net\/assets\/images\/notifications/'.$filename,
            'created_by'=> 1
        ]);
        
        return redirect()->route('notifications.index')->with('success', 'Notification Added successfully');
    }

    public function notificationsView(){
        return view('dashboard.notifications');
    }
}
