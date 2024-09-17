<?php

namespace App\Livewire\Records;

use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return view('livewire.records.table', [
            'user_attendances' => auth()->user()->attendances()->latest()->paginate(10)
        ]);
    }
}
