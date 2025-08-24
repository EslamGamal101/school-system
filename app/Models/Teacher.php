<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable=['name','Email', 'Password', 'Joining_Date', 'Address', 'Gender', 'Specialists_id'];
    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class, 'Specialists_id');
    }
    public function sections()
    {
        return $this->belongsToMany(Sections::class, 'section_teacher', 'teachers_id', 'sections_id');
    }
}
