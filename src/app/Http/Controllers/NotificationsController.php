<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{

    public function index()
    {
        return Auth::user()->unreadNotifications;
    }

    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return redirect($notification->data['route']);
    }
}
