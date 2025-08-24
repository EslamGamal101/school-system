<?php

namespace App\Http\Livewire;

use App\Models\Classes;
use App\Models\Grade;
use Livewire\Component;

class AddSection extends Component
{
    public $grades;
    public $classes = [];

    public $selectedGrade = null;
    public $selectedClass = null;
    public function mount()
    {
        $this->grades = Grade::all();
    }
    public function updatedSelectedGrade($gradeId)
    {
        $this->classes = Classes::where('grade_id', $gradeId)->get();
        $this->selectedClass = null;
    }
    public function render()
    {
        return view('livewire.add-section');
    }
}
