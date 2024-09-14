<?php

namespace Database\Factories;

use App\Models\Attendance;
use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attendance_date' => fake()->date(),
            'check_in_time' => fake()->dateTime(),
            'check_out_time' => fake()->dateTime(),
            'remark' => fake()->sentence(),
            'attended' => fake()->boolean(),
            'status' => fake()->randomElement(AttendanceStatus::values()),
        ];
    }
}
