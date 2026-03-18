<?php

namespace App\Notifications;

use App\Models\ScheduledClass;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClassBookedMemberNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ScheduledClass $scheduledClass
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message'            => "You successfully booked {$this->scheduledClass->classType->name}.",
            'class'              => $this->scheduledClass->classType->name,
            'date_time'          => $this->scheduledClass->date_time->format('l, F j, Y \a\t g:i a'),
            'scheduled_class_id' => $this->scheduledClass->id,
            'notification_type'  => 'member',
        ];
    }
}
