<?php

namespace ClockInTime\Modules\Attendance\Data;

use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class AttendanceRecord extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly int $user_id,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y-m-d')]
        public readonly Carbon $attendance_date,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y-m-d H:i:s')]
        public readonly Carbon $check_in_time,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $check_out_time,
        public readonly ?string $remark,
        public readonly ?bool $attended,
        public readonly AttendanceStatus $status,
    ) {}
}
