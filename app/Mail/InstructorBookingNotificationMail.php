<?php

namespace App\Mail;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InstructorBookingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ScheduledClass $scheduledClass,
        public User $member
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Booking - ' . $this->scheduledClass->classType->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.instructor-booking-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
