<?php

namespace App\Http\Livewire;

use App\Models\Classes;
use App\Models\Grade;
use App\Models\Sections;
use Livewire\Component;

class PromotionForm extends Component
{
    public $gradeName;
    public $classroomName;
    public $sectionName;

    public $grades;
    public $classrooms = [];
    public $sections = [];

    public $selectedGrade = null;
    public $selectedClassroom = null;
    public $selectedSection = null;
    public function mount($gradeName = 'grade_id', $classroomName = 'classroom_id', $sectionName = 'section_id')
    {
        $this->gradeName     = $gradeName;
        $this->classroomName = $classroomName;
        $this->sectionName   = $sectionName;
        $this->grades = Grade::all(); // هنعرض المراحل كلها
    }

    public function updatedSelectedGrade($gradeId)
    {
        $this->classrooms = Classes::where('grade_id', $gradeId)->get();
        $this->sections = [];
        $this->selectedClassroom = null;
        $this->selectedSection = null;
    }

    public function updatedSelectedClassroom($classroomId)
    {
        $this->sections = Sections::where('classes_id', $classroomId)->get();
        $this->selectedSection = null;
    }
    public function render()
    {
        return view('livewire.promotion-form');
    }
}
