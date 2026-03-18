<?php

namespace App\Notifications;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClassBookedInstructorNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ScheduledClass $scheduledClass,
        public User $member
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message'             => "{$this->member->name} booked your class.",
            'member'              => $this->member->name,
            'member_id'           => $this->member->id,
            'class'               => $this->scheduledClass->classType->name,
            'date_time'           => $this->scheduledClass->date_time->format('l, F j, Y \a\t g:i a'),
            'scheduled_class_id'  => $this->scheduledClass->id,
            'notification_type'   => 'instructor',
        ];
    }
}
