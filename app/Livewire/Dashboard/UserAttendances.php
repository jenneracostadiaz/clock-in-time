<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use ClockInTime\Modules\Attendance\Services\AttendanceService;
use Illuminate\View\View;
use Livewire\Component;

class UserAttendances extends Component
{
    private ?Attendance $attendance;

    public string $mainTime = '';

    public string $upTitle = '';

    public string $downTitle = '';

    public string $showButton = '';

    public string $counter = '';

    public function mount(): void
    {
        $this->setUserAttendance();

        if (! $this->hasNotAttendance() && ! $this->isAttendanceStarted()) {
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

    private function getAttendanceCheckInTime(): Carbon
    {
        return $this->attendance->check_in_time->setTimezone('America/Lima');
    }

    private function getAttendanceCheckOutTime(): Carbon
    {
        return $this->attendance->check_out_time->setTimezone('America/Lima');
    }

    private function getAttendanceWorkTime(): CarbonInterval
    {
        return $this->attendance->check_in_time->diff(
            $this->attendance->check_out_time
        );
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
        $this->upTitle = 'Click to check in';
        $this->mainTime = '00:00:00';
        $this->downTitle = 'Register your attendance';
        $this->showButton = 'checkIn';
    }

    public function registerCheckout(): void
    {
        $this->setUserAttendance();
        $this->counter = $this->getAttendanceCheckInTime()->format('H:i:s');
        $this->upTitle = 'Click to check out';
        $this->mainTime = '';
        $this->downTitle = 'Entrance: '.$this->counter;
        $this->showButton = 'checkOut';
        $this->dispatch('startCounter');
    }

    public function registerResume(): void
    {
        $this->setUserAttendance();
        $this->upTitle = 'Total hours worked';
        $this->mainTime = $this->getAttendanceWorkTime()->format('%H:%I:%S');
        $this->downTitle = '
            <p>Check in: '.$this->getAttendanceCheckInTime()->format('H:i:s').'</p>
            <p>Check out: '.$this->getAttendanceCheckOutTime()->format('H:i:s').'</p>
        ';
        $this->showButton = 'resume';
        $this->dispatch('stopCounter');
    }

    public function showResume(): void
    {
        $this->redirectRoute('records:index');
    }
}
