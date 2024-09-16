<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class CheckIn extends Component
{
    public $showingCheckIn = false;

    protected $listeners = [
        'showCheckIn' => 'showingCheckInOrder',
        'hideCheckIn' => 'hideCheckInOrder',
    ];

    public function mount(): void
    {
        $this->showingCheckIn = false;
    }

    public function render()
    {
        return view('livewire.dashboard.check-in');
    }

    public function showingCheckInOrder()
    {
        $this->showingCheckIn = true;
    }
    public function hideCheckInOrder()
    {
        $this->showingCheckIn = false;
    }

    public function checkIn()
    {
        $this->dispatch('starCheckIn');
    }
}
