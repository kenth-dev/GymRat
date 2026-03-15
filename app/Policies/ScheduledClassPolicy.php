<?php

namespace App\Policies;

use App\Models\ScheduledClass;

class ScheduledClassPolicy
{
    public function delete($user, ScheduledClass $scheduledClass)
    {
        return $user->id === $scheduledClass->instructor_id;
    }
}
