<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{


    private  $Notification;


    public function __construct( Notification  $Notification)
    {
        $this->Notification   = $Notification;
    }

    public function store(Request $request)
    {
        dd($this->Notification);
        $allUsersDevice_ids=['fIUBwo77xEO6vOlks6-x5I:APA91bHKXZ25CFGjURje2nb9aEMeJFcoDRbGgbatI1s5xh3ncgfTi4LLpWtBqQu4KZyZw1JR23gFFbcqQ6KHKcajSZuBC1_IzWw631ow03lfQh8th4KCdiXxDlLw8_roxDvRo9U3rEXU'];
        $this->Notification->send($allUsersDevice_ids,'test','test');
    }







}
