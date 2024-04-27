<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InlineComponent extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            Hello From Inline Component
        </div>
        HTML;
    }
}
