<?php

namespace App\Http\Livewire\Properties;

use Livewire\Component;

class TestProperties extends Component
{
    public $name = 'Mohamed Atia';
    // public $name;
    // public $name2;
    // public $name3;
    // public function mount(){
    //     $this->fill([
    //             'name2' => 'Maher Zidan',
    //         ]);
    // }
    // $this->reset();
    // $this->resetExcept();
    // public function mount()
    // {
    //     $this->name = 'Mohamed Atia';
    // }
    public function search()
    {

    }
    // public function getFullNameProperty()
    // {
    //     return implode(' ',$this->names);
    // }
    public function render()
    {

        return view('livewire.properties.test-properties');
    }
}
