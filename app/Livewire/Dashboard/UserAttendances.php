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
        if (! $this->attendance) {
            $this->registerCheckin();
        }
        if ($this->attendance && ! $this->attendance->check_out_time) {
            $this->registerCheckout();
        }
        if ($this->attendance && $this->attendance->check_out_time) {
            $this->registerResume();
        }
    }

    private function setUserAttendance(): void
    {
        $this->attendance = auth()->user()->attendances()?->whereDate('attendance_date', Carbon::today())->first();
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
        $end_time = $this->attendance->check_out_time->setTimezone('America/Lima');
        $this->up_title = 'Total hours worked';
        $this->main_time = $this->attendance->check_in_time->diff($end_time)->format('%H:%I');
        $this->down_title = '
            <p>Check in: '.$this->initial_counter.'</p>
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
