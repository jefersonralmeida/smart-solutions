<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{

    public function index()
    {
        $loggedUser = Auth::user();
        return isset($loggedUser) ? Auth::user()->unreadNotifications : '';
    }

    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return redirect($notification->data['route']);
    }
}
