<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navigation extends Component
{
    public $user;

    public function mount(): void
    {
        $this->user = Auth::user();
        //        dd($this->user);

    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.navigation');
    }
}
