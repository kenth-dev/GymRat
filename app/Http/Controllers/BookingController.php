<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
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

    public function index(Request $request)
    {
        $scheduledClasses = $request->user()
            ->bookedClasses()
            ->with(['classType', 'instructor'])
            ->where('date_time', '>=', now())
            ->oldest('date_time')
            ->get();

        return view('member.upcoming', compact('scheduledClasses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scheduled_class_id' => 'required|exists:scheduled_classes,id',
        ]);

        $scheduledClass = ScheduledClass::findOrFail($validated['scheduled_class_id']);

        if ($scheduledClass->date_time->isPast()) {
            return redirect()->route('booking.create')->withErrors(['booking' => 'You can only book upcoming classes.']);
        }

        $request->user()->bookedClasses()->syncWithoutDetaching([$scheduledClass->id]);

        return redirect()->route('booking.create')->with('success', 'Class booked successfully.');
    }

    public function destroy(Request $request, ScheduledClass $booking)
    {
        $request->user()->bookedClasses()->detach($booking->id);

        return redirect()->back()->with('success', 'Booking canceled successfully.');
    }
}
