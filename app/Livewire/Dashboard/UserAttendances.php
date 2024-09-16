<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use Carbon\Carbon;
use ClockInTime\Modules\Attendance\Services\AttendanceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;

class UserAttendances extends Component
{
    private ?Attendance $attendance;

    public string $main_time = '';

    public string $up_title = '';

    public string $down_title = '';

    public string $showButton = '';

    public string $initial_counter = '00:00:00';

    public function mount(): void
    {
        $this->setUserAttendance();

        if (! $this->hasNotAttendance()) {
            $this->registerCheckin();
        }

        if ($this->isAttendanceStarted() && ! $this->isAttendanceEnded()) {
            $this->registerCheckout();
        }

        if ($this->isAttendanceEnded()) {
            $this->registerResume();
        }
    }

    private function setUserAttendance(): void
    {
        $this->attendance = auth()->user()->attendances()?->whereDate('attendance_date', Carbon::today())->first();
    }

    private function hasAttendance(): bool
    {
        return ! $this->attendance;
    }

    private function hasNotAttendance(): bool
    {
        return ! $this->hasAttendance();
    }

    private function isAttendanceStarted(): bool
    {
        if (! $this->hasNotAttendance()) {
            return false;
        }

        return ! is_null($this->attendance->check_in_time);
    }

    private function isAttendanceEnded(): bool
    {
        if (! $this->hasNotAttendance()) {
            return false;
        }

        return ! is_null($this->attendance->check_out_time);
    }

    public function render(): View
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
        $this->initial_counter = $this->attendance->check_in_time->setTimezone('America/Lima')->format('H:i:s');
        $this->up_title = 'Click to check out';
        $this->main_time = '';
        $this->down_title = 'Entrance: '.$this->initial_counter;
        $this->showButton = 'checkOut';
        $this->dispatch('startCounter');
    }

    public function registerResume(): void
    {
        $this->setUserAttendance();
        $start_time = $this->attendance->check_in_time->setTimezone('America/Lima');
        $end_time = $this->attendance->check_out_time->setTimezone('America/Lima');
        $this->up_title = 'Total hours worked';
        $this->main_time = $this->attendance->check_in_time->diff($end_time)->format('%H:%I:%S');
        $this->down_title = '
            <p>Check in: '.$start_time->format('H:i:s').'</p>
            <p>Check out: '.$end_time->format('H:i:s').'</p>
        ';
        $this->showButton = 'resume';
        $this->dispatch('stopCounter');
    }

    public function showResume(): RedirectResponse
    {
        return redirect()->route('records:index');
    }
}
