<?php

namespace App\Http\Controllers\Attendance;

use App\Events\AttendanceCheckOutRegistered;
use App\Http\Controllers\Controller;
use ClockInTime\Modules\Attendance\Actions\UpdateAttendanceRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckOutRecord;
use Illuminate\Http\JsonResponse;

class StoreCheckOutController extends Controller
{
    public function __construct(
        private readonly UpdateAttendanceRecord $updateAttendanceRecord
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(int $id, NewCheckOutRecord $checkOutRecord): JsonResponse
    {
        $attendance = $this->updateAttendanceRecord->handle(
            id: $id,
            user: auth()->user(),
            checkOutRecord: $checkOutRecord
        );

        event(new AttendanceCheckOutRegistered($attendance));

        return response()->json([
            'attendance' => $attendance,
        ]);
    }
}
