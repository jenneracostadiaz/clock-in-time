<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navigation extends Component
{
    public ?User $user;

    public function mount(): void
    {
        $this->user = Auth::user();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.navigation');
    }
}
