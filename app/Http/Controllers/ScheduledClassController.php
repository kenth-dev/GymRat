<?php

namespace App\Http\Controllers;

use App\Events\ClassCanceled;
use Illuminate\Http\Request;
use App\Models\ClassType;
use App\Models\ScheduledClass;


class ScheduledClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $scheduledClasses = $request->user()
            ->scheduledClasses()
            ->with('classType')
            ->where('date_time', '>=', now())
            ->oldest('date_time')
            ->get();

        return view('instructor.upcoming', compact('scheduledClasses'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classTypes = ClassType::all();
        return view('instructor.schedule')->with(['classTypes' => $classTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $date_time = $request->input('class_date') . ' ' . $request->input('class_time');

        $request->merge([
            'date_time' => $date_time,
            'instructor_id' => $userId,
        ]);

        $validated = $request->validate([
            'class_type_id' => 'required|exists:class_types,id',
            'date_time' => 'required|date|unique:scheduled_classes,date_time|after:now',
            'instructor_id' => 'required|exists:users,id',
        ]);

        ScheduledClass::create($validated);

        return redirect()->route('schedule.index')->with('success', 'Class scheduled successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ScheduledClass $schedule)
    {   
        if($request->user()->cannot('delete', $schedule)) {
            abort(403);
        }

        ClassCanceled::dispatch($schedule);

        $schedule->delete();
        $schedule->members()->detach(); 

        return redirect()->route('schedule.index')->with('success', 'Class canceled successfully.');
    }
}
