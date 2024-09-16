<?php

namespace ClockInTime\Modules\Attendance\Actions;

use App\Models\User;
use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Notifications\AttendanceCheckInConfirmed;

class SendAttendanceCheckInNotificationMail
{
    public function handle(AttendanceRecord $attendance): void
    {
        User::query()->findOrFail($attendance->user_id)->notify(
            new AttendanceCheckInConfirmed($attendance)
        );
    }
}
