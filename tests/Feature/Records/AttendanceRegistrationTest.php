<?php

use App\Models\User;
use ClockInTime\Modules\Core\Enums\Http;

use function Pest\Laravel\actingAs;

test('an authenticated user can check in his attendance entrance', function ($checkInRecord) {
    $user = User::factory()->create();

    $response = actingAs($user)->post('/records/check-in', [
        'attendance_date' => $checkInRecord->attendance_date,
        'check_in_time' => $checkInRecord->check_in_time,
        'status' => $checkInRecord->status,
    ]);

    expect($response->status())->toBe(Http::CREATED->value)
        ->and($response)->assertJson([
            'attendance' => [
                'user_id' => $user->id,
                'attendance_date' => $checkInRecord->attendance_date,
                'check_in_time' => $checkInRecord->check_in_time,
                'check_out_time' => null,
                'attended' => false,
                'status' => $checkInRecord->status,
            ],
        ]);
})->with([
    'checkInRecord' => (object) [
        'attendance_date' => '2024-09-17',
        'check_in_time' => '2024-09-17 08:00:00',
        'status' => 'started',
    ],
]);

test('an authenticated user can check out his attendance entrance', function ($checkOutRecord) {
    $this->withoutExceptionHandling();
    $user = User::factory()->create();

    $user->attendances()->create([
        'attendance_date' => $checkOutRecord->attendance_date,
        'check_in_time' => $checkOutRecord->check_in_time,
        'status' => $checkOutRecord->status,
    ]);

    $response = actingAs($user)->patchJson('/records/check-out', [
        'id' => $user->attendances->first()->id,
        'check_out_time' => $checkOutRecord->check_out_time,
        'status' => $checkOutRecord->status,
    ]);

    expect($response->status())->toBe(Http::OK->value)
        ->and($response)->assertJson([
            'attendance' => [
                'user_id' => $user->id,
                'attendance_date' => $checkOutRecord->attendance_date,
                'check_in_time' => $checkOutRecord->check_in_time,
                'check_out_time' => $checkOutRecord->check_out_time,
                'attended' => true,
                'status' => $checkOutRecord->status,
            ],
        ]);
})->with([
    'checkOutRecord' => (object) [
        'attendance_date' => '2024-09-17',
        'check_in_time' => '2024-09-17 08:00:00',
        'check_out_time' => '2024-09-17 17:00:00',
        'status' => 'finished',
    ],
]);
