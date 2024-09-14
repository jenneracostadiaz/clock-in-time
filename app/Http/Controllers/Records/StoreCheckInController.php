<?php

namespace App\Http\Controllers\Records;

use App\Http\Controllers\Controller;
use ClockInTime\Modules\Core\Enums\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreCheckInController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $record = auth()->user()->attendances()->create(
            $request->all()
        );

        return response(['attendance' => $record], Http::CREATED->value);
    }
}
