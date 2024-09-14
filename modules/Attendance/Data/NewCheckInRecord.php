<?php

namespace ClockInTime\Modules\Attendance\Data;

use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

final class NewCheckInRecord extends Data
{
    public function __construct(
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public readonly Carbon|string $attendance_date,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly Carbon|string $check_in_time,
        public readonly AttendanceStatus $status,
    ) {}
}
