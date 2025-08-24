<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPromotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'from_grade',
        'to_grade',
        'from_classroom',
        'to_classroom',
        'from_section',
        'to_section',
        'from_academic_year',
        'to_academic_year'
    ];

    // 🔹 العلاقة مع الطالب
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // 🔹 من وإلى المرحلة (Grade)
    public function fromGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function toGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    // 🔹 من وإلى الصف (Classroom)
    public function fromClassroom()
    {
        return $this->belongsTo(Classes::class, 'from_classroom');
    }

    public function toClassroom()
    {
        return $this->belongsTo(Classes::class, 'to_classroom');
    }

    // 🔹 من وإلى الفصل (Section)
    public function fromSection()
    {
        return $this->belongsTo(Sections::class, 'from_section');
    }

    public function toSection()
    {
        return $this->belongsTo(Sections::class, 'to_section');
    }
}
