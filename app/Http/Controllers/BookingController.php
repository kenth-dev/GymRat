<?php

namespace App\Http\Controllers;

use App\Mail\ClassBookedMail;
use App\Mail\InstructorBookingNotificationMail;
use App\Models\ScheduledClass;
use App\Notifications\ClassBookedInstructorNotification;
use App\Notifications\ClassBookedMemberNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $scheduledClasses = ScheduledClass::with(['classType', 'instructor'])
            ->where('date_time', '>=', now())
            ->oldest('date_time')
            ->get();

        $bookedClassIds = $request->user()
            ->bookedClasses()
            ->pluck('scheduled_classes.id')
            ->toArray();

        return view('member.book', compact('scheduledClasses', 'bookedClassIds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scheduled_class_id' => 'required|exists:scheduled_classes,id',
        ]);

        $scheduledClass = ScheduledClass::findOrFail($validated['scheduled_class_id']);

        if ($scheduledClass->date_time->isPast()) {
            return redirect()->route('booking.index')->withErrors(['booking' => 'You can only book upcoming classes.']);
        }

        $request->user()->bookedClasses()->syncWithoutDetaching([$scheduledClass->id]);

        // Send confirmation email + notification to member
        Mail::to($request->user()->email)->send(
            new ClassBookedMail($scheduledClass, $request->user())
        );
        $request->user()->notify(new ClassBookedMemberNotification($scheduledClass));

        // Notify instructor
        if ($scheduledClass->instructor) {
            Mail::to($scheduledClass->instructor->email)->send(
                new InstructorBookingNotificationMail($scheduledClass, $request->user())
            );
            $scheduledClass->instructor->notify(
                new ClassBookedInstructorNotification($scheduledClass, $request->user())
            );
        }

        return redirect()->route('booking.index')->with('success', 'Class booked successfully. Check your email for confirmation.');
    }

    public function upcoming(Request $request)
    {
        $scheduledClasses = $request->user()
            ->bookedClasses()
            ->with(['classType', 'instructor'])
            ->where('date_time', '>=', now())
            ->oldest('date_time')
            ->get();

        return view('member.upcoming', compact('scheduledClasses'));
    }

    public function destroy(Request $request, ScheduledClass $booking)
    { 

        $request->user()->bookedClasses()->detach($booking->id);

        return redirect()->back()->with('success', 'Booking canceled successfully.');
    }
}
