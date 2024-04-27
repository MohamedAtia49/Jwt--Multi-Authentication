<?php

namespace App\Http\Livewire\Events;

use Livewire\Attributes\On;
use Livewire\Component;

class SecondEvent extends Component
{
    #[On('onFired')]
    public function WhenFired()
    {
        dd('Hello from Second Comp');
    }
    public function render()
    {
        return view('livewire.events.second-event');
    }
}
