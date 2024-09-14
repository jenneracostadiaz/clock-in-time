<?php

namespace App\Models;

use ClockInTime\Modules\Attendance\Enums\AttendanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
