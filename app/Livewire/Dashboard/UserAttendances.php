<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use ClockInTime\Modules\Attendance\Services\AttendanceService;
use Livewire\Component;

class UserAttendances extends Component
{
    public $main_time;

    public $up_title;

    public $down_title;

    public $showButton;

    public $initial_counter;

    public $user_attendance;

    public function mount(): void
    {
        $this->setUserAttendance();
        if (! $this->user_attendance) {
            $this->registerCheckin();
        }
        if ($this->user_attendance && ! $this->user_attendance->check_out_time) {
            $this->registerCheckout();
        }
        if ($this->user_attendance && $this->user_attendance->check_out_time) {
            $this->registerResume();
        }
    }

    private function setUserAttendance(): void
    {
        $this->user_attendance = auth()->user()->attendances()?->whereDate('attendance_date', Carbon::today())->first();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.user-attendances');
    }

    public function checkIn(): void
    {
        app(AttendanceService::class)->checkIn();
        $this->registerCheckout();
    }

    public function checkOut(): void
    {
        app(AttendanceService::class)->checkOut();
        $this->registerResume();
    }

    public function registerCheckin(): void
    {
        $this->up_title = 'Click to check in';
        $this->main_time = '00:00:00';
        $this->down_title = 'Register your attendance';
        $this->showButton = 'checkIn';
    }

    public function registerCheckout(): void
    {
        $this->setUserAttendance();
        $this->initial_counter = $this->user_attendance->check_in_time->setTimezone('America/Lima')->format('H:i:s');
        $this->up_title = 'Click to check out';
        $this->main_time = '';
        $this->down_title = 'Entrance: '.$this->initial_counter;
        $this->showButton = 'checkOut';
        $this->dispatch('startCounter');
    }

    public function registerResume(): void
    {
        $this->setUserAttendance();
        $end_time = $this->user_attendance->check_out_time->setTimezone('America/Lima');
        $this->up_title = 'Total hours worked';
        $this->main_time = $this->user_attendance->check_in_time->diff($end_time)->format('%H:%I');
        $this->down_title = '
            <p>Check in: '.$this->initial_counter.'</p>
            <p>Check out: '.$end_time->format('H:i:s').'</p>
        ';
        $this->showButton = 'resume';
        $this->dispatch('stopCounter');
    }

    public function showResume()
    {
        return redirect()->route('records:index');
    }
}
