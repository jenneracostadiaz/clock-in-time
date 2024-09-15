<?php

namespace App\Http\Controllers\Records;

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
    public function __invoke(NewCheckOutRecord $checkOutRecord): JsonResponse
    {
        $attendance = $this->updateAttendanceRecord->handle(
            user: auth()->user(),
            checkOutRecord: $checkOutRecord
        );

        return response()->json([
            'attendance' => $attendance,
        ]);
    }
}
