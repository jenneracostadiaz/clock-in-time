<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Limber Jaimes',
            'email' => 'limber@clockintime.com',
            'password' => Hash::make('password'),
        ]);

        collect(range(100, 1))->each(
            fn ($days) => $this->createAttendances($user, $days)
        );
    }

    private function createAttendances($user, int $days): void
    {
        $this->createAttendanceItem(
            user: $user,
            date: $currentDate = now()->subDays($days),
            checkInTime: $this->fakeCheckInTime($currentDate),
            checkOutTime: $this->fakeCheckOutTime($currentDate)
        );
    }

    public function createAttendanceItem($user, Carbon $date, Carbon $checkInTime, Carbon $checkOutTime): void
    {
        Attendance::factory()->create([
            'user_id' => $user->id,
            'attendance_date' => $date->format('Y-m-d'),
            'check_in_time' => $checkInTime,
            'check_out_time' => $checkOutTime,
            'attended' => true,
            'status' => AttendanceStatus::FINISHED,
        ]);
    }

    private function fakeCheckInTime(Carbon $currentDate): Carbon
    {
        $newTime = $currentDate->clone();

        return match ($hour = fake()->numberBetween(12, 13)) {
            12 => $newTime->setTime($hour, fake()->numberBetween(55, 59)),
            13 => $newTime->setTime($hour, fake()->numberBetween(0, 5)),
        };
    }

    public function fakeCheckOutTime(Carbon $currentDate): Carbon
    {
        $newTime = $currentDate->clone();

        return match ($hour = fake()->numberBetween(21, 22)) {
            21 => $newTime->setTime($hour, fake()->numberBetween(55, 59)),
            22 => $newTime->setTime($hour, fake()->numberBetween(0, 5)),
        };
    }
}
