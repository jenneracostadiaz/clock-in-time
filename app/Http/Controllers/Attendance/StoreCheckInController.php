<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use ClockInTime\Modules\Attendance\Actions\CreateNewAttendanceRecord;
use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use ClockInTime\Modules\Core\Enums\Http;
use Illuminate\Http\Response;

class StoreCheckInController extends Controller
{
    public function __construct(
        public readonly CreateNewAttendanceRecord $createNewAttendanceRecord
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(NewCheckInRecord $checkInRecord): Response
    {
        $record = $this->createNewAttendanceRecord->handle(
            user: auth()->user(),
            checkInRecord: $checkInRecord
        );

        return response(['attendance' => $record], Http::CREATED->value);
    }
}
