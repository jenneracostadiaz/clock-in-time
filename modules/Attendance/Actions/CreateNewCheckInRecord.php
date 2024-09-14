<?php

namespace ClockInTime\Modules\Attendance\Actions;

use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateNewCheckInRecord
{
    public function handle(Authenticatable $user, NewCheckInRecord $checkInRecord): AttendanceRecord
    {
        $attendance = $user->attendances()->create(
            $checkInRecord->toArray()
        );

        return AttendanceRecord::from($attendance);
    }
}
