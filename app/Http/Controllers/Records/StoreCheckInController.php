<?php

namespace App\Http\Controllers\Records;

use App\Http\Controllers\Controller;
use ClockInTime\Modules\Attendance\Data\NewCheckInRecord;
use ClockInTime\Modules\Core\Enums\Http;
use Illuminate\Http\Response;

class StoreCheckInController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(NewCheckInRecord $checkInRecord): Response
    {
        $attendance = auth()->user()->attendances()->create(
            $checkInRecord->toArray()
        );

        return response(['attendance' => $attendance], Http::CREATED->value);
    }
}
