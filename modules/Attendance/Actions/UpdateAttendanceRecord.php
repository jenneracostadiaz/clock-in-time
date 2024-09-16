<?php

namespace ClockInTime\Modules\Attendance\Actions;

use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckOutRecord;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdateAttendanceRecord
{
    public function handle(int $id, Authenticatable $user, NewCheckOutRecord $checkOutRecord): AttendanceRecord
    {
        $attendance = $user->attendances()->findOrFail($id);

        $attendance->update(
            array_merge($checkOutRecord->toArray(), ['attended' => true])
        );

        return AttendanceRecord::from(
            $attendance->fresh()
        );
    }
}
