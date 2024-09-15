<?php

use ClockInTime\Modules\Attendance\Data\NewCheckOutRecord;
use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;

it('can create a new check out record', function () {
    $record = new NewCheckOutRecord(
        id: 1,
        check_out_time: '2024-09-17 08:00:00',
        status: AttendanceStatus::FINISHED,
    );

    $this->assertInstanceOf(NewCheckOutRecord::class, $record);
});
