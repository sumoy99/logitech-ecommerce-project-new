<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    // public function index()
    // {
    //     $notifications = auth()->user()->notifications()->latest()->get();
    //     return view('frontend.customer.notifications', compact('notifications'));
    // }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['redirect_url'] ?? '/');
        }
    
        return redirect()->back()->with('error', 'Notification not found.');    
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }


    public function notificationDelete($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->delete();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Notification not found.'], 404);
    }


    public function notificationDeleteAll()
    {
        auth()->user()->notifications()->delete();
        return back();
    }
}

