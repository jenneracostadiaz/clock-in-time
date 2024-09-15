<?php

namespace ClockInTime\Modules\Attendance\Data;

use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class NewCheckOutRecord extends Data
{
    public function __construct(
        public readonly int $id,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly Carbon|string $check_out_time,
        public readonly AttendanceStatus $status,
    ) {}
}
