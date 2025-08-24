<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Classes;
use App\Models\Sections;

class SelectSection extends Component
{
    public $grades;
    public $classes = [];
    public $sections = [];

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
        $this->sections = [];
    }
    public function submit()
    {
        if ($this->selectedClass) {
            $this->sections = Sections::where('classes_id', $this->selectedClass)->get();
        } else {
            $this->sections = [];
        }
    }


    public function render()
    {
        return view('livewire.select-section');
    }
}
