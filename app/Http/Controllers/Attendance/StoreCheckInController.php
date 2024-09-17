<?php

namespace App\Http\Controllers\Attendance;

use App\Events\AttendanceCheckInRegistered;
use App\Http\Controllers\Controller;
use ClockInTime\Modules\Attendance\Actions\CreateNewAttendanceRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use ClockInTime\Modules\Core\Enums\Http;
use Illuminate\Http\JsonResponse;

class StoreCheckInController extends Controller
{
    public function __construct(
        public readonly CreateNewAttendanceRecord $createNewAttendanceRecord
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(NewCheckInRecord $checkInRecord): JsonResponse
    {
        $record = $this->createNewAttendanceRecord->handle(
            user: auth()->user(),
            checkInRecord: $checkInRecord
        );

        event(
            new AttendanceCheckInRegistered($record)
        );

        return response()->json(['attendance' => $record], Http::CREATED->value);
    }
}
