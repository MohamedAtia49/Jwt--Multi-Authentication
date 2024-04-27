<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPost extends Component
{
    public function render()
    {
        $name = 'Mohamed Atia';
        return view('livewire.show-post');
    }
}
