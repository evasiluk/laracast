<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NotificationsController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function personal() {
        $notifications = auth()->user()->unreadNotifications;
        auth()->user()->unreadNotifications->markAsRead();

        return view("notifications.personal", compact("notifications"));
    }
}
