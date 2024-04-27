<?php

namespace App\Http\Livewire\Actions;

use Livewire\Component;

class TestActions extends Component
{
    public $count = 0;
    public $active = true;

    public function increment(){
        $this->count++ ;
    }
    public function decrement(){
        $this->count-- ;
    }
    public function test($param){
        dd('This fn is test for ' . $param);
    }
    public function render()
    {
        return view('livewire.actions.test-actions');
    }
}
