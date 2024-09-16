<?php

use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Support\Carbon;

test('it can create an attendance record', function () {
    $record = new AttendanceRecord(
        1,
        1,
        Carbon::createFromDate(2024, 9, 17),
        Carbon::createFromTimeString('2024-09-17 08:00:00'),
        Carbon::createFromTimeString('2024-09-17 17:00:00'),
        'This is a remark',
        true,
        AttendanceStatus::STARTED,
    );

    $this->assertInstanceOf(AttendanceRecord::class, $record);
});
