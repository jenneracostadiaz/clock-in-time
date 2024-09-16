<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use ClockInTime\Modules\Attendance\Services\AttendanceService;
use Livewire\Component;

class CheckOut extends Component
{
    public $showingCheckOut = false, $user_check_in, $initial_counter;

    protected $listeners = ['starCheckIn' => 'checkIn'];

    public function mount(): void
    {
        $this->user_check_in = auth()->user()->attendances()->whereDate('check_in_time', Carbon::today())->first();
        if ($this->user_check_in) {
            $this->showingCheckOut = true;
            $this->startCounter();
        }

        if(!$this->user_check_in) {
            $this->showingCheckOut = false;
            $this->dispatch('showCheckIn');
        }

    }
    public function render()
    {
        return view('livewire.dashboard.check-out');
    }

    public function checkIn()
    {
        $this->dispatch('hideCheckIn');
        $record = app(AttendanceService::class)->checkIn();
        $this->showingCheckOut = true;
        $this->startCounter();
    }

    public function checkOut()
    {
//        dd('asdasdsda');
//        $record = app(AttendanceService::class)->checkOut();
        $this->dispatch('starResume');
        $this->showingCheckOut = false;
    }

    private function startCounter(): void
    {
        $star_time = auth()->user()->attendances()->whereDate('check_in_time', Carbon::today())->first();
        $this->initial_counter = Carbon::parse($star_time->check_in_time)->setTimezone('America/Lima')->format('H:i:s');
    }

}
