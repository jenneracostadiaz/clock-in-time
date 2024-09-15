<?php

namespace ClockInTime\Modules\Attendance\Services;

use Carbon\Carbon;
use ClockInTime\Modules\Attendance\Actions\CreateNewCheckInRecord;
use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Support\Facades\Auth;

final readonly class AttendanceService
{
    public function __construct(
        public CreateNewCheckInRecord $createNewCheckInRecord,
    ) {}

    public function checkIn(): AttendanceRecord
    {
        $checkInRecord = new NewCheckInRecord(
            Carbon::now()->format('Y-m-d'),
            Carbon::now()->format('Y-m-d H:i:s'),
            AttendanceStatus::STARTED
        );

        return $this->createNewCheckInRecord->handle(
            user: Auth::user(),
            checkInRecord: $checkInRecord
        );
    }
}
