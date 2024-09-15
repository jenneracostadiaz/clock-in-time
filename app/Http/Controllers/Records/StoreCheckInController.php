<?php

namespace App\Http\Controllers\Records;

use App\Http\Controllers\Controller;
use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use ClockInTime\Modules\Attendance\Services\AttendanceService;
use ClockInTime\Modules\Core\Enums\Http;
use Illuminate\Http\Response;

class StoreCheckInController extends Controller
{
    public function __construct(
        public readonly AttendanceService $service
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(NewCheckInRecord $checkInRecord): Response
    {
        $record = $this->service->checkIn();

        return response(['attendance' => $record], Http::CREATED->value);
    }
}
