<?php

namespace ClockInTime\Modules\Attendance\Actions;

use App\Models\User;
use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Notifications\AttendanceCheckOutRegistered;

class SendAttendanceCheckOutNotificationMail
{
    public function handle(AttendanceRecord $attendance): void
    {
        User::query()->findOrFail($attendance->user_id)->notify(
            new AttendanceCheckOutRegistered($attendance)
        );
    }
}
