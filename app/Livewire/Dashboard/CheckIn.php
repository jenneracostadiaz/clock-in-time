<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use ClockInTime\Modules\Attendance\Services\AttendanceService;
use Livewire\Component;

class CheckIn extends Component
{
    public string $today;

    public function mount(): void
    {
        Carbon::setLocale('es');

        $this->today = Carbon::now()->isoFormat('dddd D, MMM YYYY');
    }

    public function render()
    {
        return view('livewire.dashboard.check-in');
    }

    public function checkIn()
    {
        // TODO: Move to CheckOut component
        $record = app(AttendanceService::class)->checkIn();

        // Emit event to CheckOut component
        $this->emit('checkIn');
    }
}
