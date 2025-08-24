<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'national_id',
        'email',
        'password',
        'birth_date',
        'religion_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'parent_id',
        'address',
    ];

    

    
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classes::class, 'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Sections::class);
    }

    public function parent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }
    public function fees()
    {
        return $this->hasMany(student_fee::class);
    }
}
