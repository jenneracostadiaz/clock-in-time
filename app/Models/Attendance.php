<?php

namespace App\Models;

use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property Carbon $attendance_date
 * @property Carbon $check_in_time
 * @property Carbon|null $check_out_time
 * @property bool $attended
 * @property string|null $remark
 * @property AttendanceStatus $status
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class Attendance extends Model
{
    use HasFactory;

    protected $attributes = [
        'attended' => false,
    ];

    protected $fillable = [
        'attendance_date',
        'check_in_time',
        'check_out_time',
        'attended',
        'remark',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'attendance_date' => 'datetime:Y-m-d',
            'check_in_time' => 'datetime',
            'check_out_time' => 'datetime',
            'attended' => 'boolean',
            'status' => AttendanceStatus::class,
        ];
    }
}
