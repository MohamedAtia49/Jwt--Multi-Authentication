<?php

namespace App\Http\Livewire\Events;

use Livewire\Attributes\On;
use Livewire\Component;

class ThirdEvent extends Component
{
    #[On('onFired')]
    public function onFired(){
        dd('Hello from Third Comp');
    }
    public function render()
    {
        return view('livewire.events.third-event');
    }
}
