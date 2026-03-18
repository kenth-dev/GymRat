
Route::get('/test-email', function () {
    $user = \App\Models\User::where('role', 'member')->first();
    $scheduledClass = \App\Models\ScheduledClass::with(['classType', 'instructor'])->first();
    
    return new \App\Mail\ClassBookedMail($scheduledClass, $user);
})->middleware('auth');
