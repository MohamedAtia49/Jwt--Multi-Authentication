<?php

namespace App\Http\Livewire\Events;

use Livewire\Component;

class FirstEvent extends Component
{
    public function fire()
    {
        $this->dispatch('fire');
    }
    public function render()
    {
        return view('livewire.events.first-event');
    }
}
