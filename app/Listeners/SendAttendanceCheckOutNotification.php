<?php

namespace App\Listeners;

use App\Events\AttendanceCheckOutRegistered;
use ClockInTime\Modules\Attendance\Actions\SendAttendanceCheckOutNotificationMail;

final readonly class SendAttendanceCheckOutNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private SendAttendanceCheckOutNotificationMail $sendAttendanceCheckOutNotificationMail
    ) {}

    /**
     * Handle the event.
     */
    public function handle(AttendanceCheckOutRegistered $event): void
    {
        $this->sendAttendanceCheckOutNotificationMail->handle(
            attendance: $event->attendance
        );
    }
}
