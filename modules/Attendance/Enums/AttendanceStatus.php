<?php

namespace ClockInTime\Modules\Attendance\Enums;

enum AttendanceStatus: string
{
    case STARTED = 'started';
    case FINISHED = 'finished';

    public static function values(): array
    {
        return [
            self::STARTED->value,
            self::FINISHED->value,
        ];
    }
}
