<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class ResumeHours extends Component
{
    public $showingResumeHours = false, $check_in, $check_out;

    protected $listeners = ['starResume' => 'showResume'];

    public function mount(): void
    {
        $this->showingResumeHours = false;
        $check_in = auth()->user()->attendances()->whereDate('check_in_time', today())->first();
        $this->check_in = Carbon::parse($check_in->check_in_time)->setTimezone('America/Lima')->format('H:i:s');
        $this->check_out = Carbon::parse($check_in->check_out_time)->setTimezone('America/Lima')->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.dashboard.resume-hours');
    }

    public function showResume()
    {
        $this->showingResumeHours = true;
    }
}
