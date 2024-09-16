<?php

namespace ClockInTime\Modules\Attendance\Data;

use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class AttendanceRecord extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly int $user_id,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public readonly Carbon $attendance_date,
        public readonly Carbon $check_in_time,
        public readonly ?Carbon $check_out_time,
        public readonly ?string $remark,
        public readonly ?bool $attended,
        public readonly AttendanceStatus $status,
    ) {}
}
