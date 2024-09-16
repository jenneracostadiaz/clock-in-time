<?php

namespace ClockInTime\Modules\Attendance\Actions;

use App\Models\User;
use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Notifications\AttendanceCheckInConfirmed;
use Illuminate\Support\Facades\Log;

class SendAttendanceCheckInNotificationMail
{
    public function handle(AttendanceRecord $attendance): void
    {
        $user = User::query()->findOrFail($attendance->user_id);

        Log::debug(__METHOD__, [$user]);

        User::query()->findOrFail($attendance->user_id)->notify(
            new AttendanceCheckInConfirmed($attendance)
        );
    }
}
