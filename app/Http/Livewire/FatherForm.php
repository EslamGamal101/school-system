<?php

namespace App\Http\Livewire;

use App\Models\TypeBlood;
use Livewire\Component;

class FatherForm extends Component
{
    public function render()
    {
        $Type_Bloods = \App\Models\TypeBlood::all();
        return view('livewire.show-form', compact('Type_Bloods'));
    }
}
