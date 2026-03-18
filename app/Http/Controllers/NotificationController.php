<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->get();
        $request->user()->unreadNotifications()->update(['read_at' => now()]);

        return view('notifications.index', compact('notifications'));
    }

    public function show(Request $request, string $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $data = $notification->data;

        if (empty($data['scheduled_class_id']) || empty($data['notification_type'])) {
            return view('notifications.unavailable');
        }

        $scheduledClass = ScheduledClass::with(['classType', 'instructor'])
            ->findOrFail($data['scheduled_class_id']);

        if ($data['notification_type'] === 'instructor') {
            $member = User::findOrFail($data['member_id']);
            return view('emails.instructor-booking-notification', compact('scheduledClass', 'member'));
        }

        $user = $request->user();
        return view('emails.class-booked', compact('scheduledClass', 'user'));
    }
}
