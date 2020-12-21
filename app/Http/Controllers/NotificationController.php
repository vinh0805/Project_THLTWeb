<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index() {
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(1);
        return view('notifications.index')->with('notifications', $notifications);
    }

    public function show($id) {
        $notification = Notification::find($id);
        return $notification;
    }
}
