<?php

namespace ClockInTime\Modules\Attendance\Services;

use App\Events\AttendanceCheckInRegistered;
use Carbon\Carbon;
use ClockInTime\Modules\Attendance\Actions\CreateNewAttendanceRecord;
use ClockInTime\Modules\Attendance\Actions\UpdateAttendanceRecord;
use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckOutRecord;
use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Support\Facades\Auth;

final readonly class AttendanceService
{
    public function __construct(
        public CreateNewAttendanceRecord $createNewCheckInRecord,
        private UpdateAttendanceRecord $updateAttendanceRecord
    ) {}

    public function findAttendance(string $date): AttendanceRecord
    {
        $attendance = Auth::user()->attendances()->where('attendance_date', $date)->firstOrFail();

        return AttendanceRecord::from($attendance);
    }

    public function checkIn(): AttendanceRecord
    {
        $checkInRecord = new NewCheckInRecord(
            Carbon::now()->format('Y-m-d'),
            Carbon::now()->format('Y-m-d H:i:s'),
            AttendanceStatus::STARTED
        );

        $attendance = $this->createNewCheckInRecord->handle(
            user: Auth::user(),
            checkInRecord: $checkInRecord
        );

        event(new AttendanceCheckInRegistered($attendance));

        return $attendance;
    }

    public function checkOut(): AttendanceRecord
    {
        $attendance = $this->findAttendance(
            date: Carbon::now()->format('Y-m-d')
        );

        $checkOutRecord = new NewCheckOutRecord(
            check_out_time: Carbon::now(),
            status: AttendanceStatus::FINISHED
        );

        return $this->updateAttendanceRecord->handle(
            id: $attendance->id,
            user: Auth::user(),
            checkOutRecord: $checkOutRecord
        );
    }
}
