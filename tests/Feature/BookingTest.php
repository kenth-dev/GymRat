<?php

use App\Models\ClassType;
use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

test('member can book a class', function () {
    $member = User::factory()->create(['role' => 'member']);
    $classType = ClassType::factory()->create();
    $scheduledClass = ScheduledClass::factory()->create([
        'class_type_id' => $classType->id,
        'date_time' => now()->addDay(),
    ]);

    $this->actingAs($member)
        ->post('/member/bookings', ['scheduled_class_id' => $scheduledClass->id])
        ->assertRedirect('/member/bookings');

    $this->assertDatabaseHas('bookings', [
        'user_id' => $member->id,
        'scheduled_class_id' => $scheduledClass->id,
    ]);
});
