<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class Navigation extends Component
{
    public $user;

    public function mount(): void
    {
        $this->user = User::find(1);
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.navigation');
    }
}
