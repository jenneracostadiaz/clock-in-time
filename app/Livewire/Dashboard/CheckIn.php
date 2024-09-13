<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class CheckIn extends Component
{
    public $today;

    public function mount()
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
        $this->emit('checkIn');
    }
}
