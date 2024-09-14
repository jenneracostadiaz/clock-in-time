<?php

namespace ClockInTime\Modules\Attendance\Data;

use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Spatie\LaravelData\Data;

class AttendanceRecord extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly int $user_id,
        public readonly string $attendance_date,
        public readonly string $check_in_time,
        public readonly ?string $check_out_time,
        public readonly ?string $remark,
        public readonly ?bool $attended,
        public readonly AttendanceStatus $status,
    ) {}
}
