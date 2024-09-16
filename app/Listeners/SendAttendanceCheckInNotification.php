<?php

namespace App\Listeners;

use App\Events\AttendanceCheckInRegistered;
use ClockInTime\Modules\Attendance\Actions\SendAttendanceCheckInNotificationMail;

final readonly class SendAttendanceCheckInNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private SendAttendanceCheckInNotificationMail $sendAttendanceCheckInNotificationMail
    ) {}

    /**
     * Handle the event.
     */
    public function handle(AttendanceCheckInRegistered $event): void
    {
        $this->sendAttendanceCheckInNotificationMail->handle(
            attendance: $event->attendance
        );
    }
}
