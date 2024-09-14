<?php

use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;

test('it can create a new check in record', function () {
    $record = new NewCheckInRecord(
        '2024-09-17',
        '2024-09-17 08:00:00',
        AttendanceStatus::STARTED,
    );

    $this->assertInstanceOf(NewCheckInRecord::class, $record);
});
