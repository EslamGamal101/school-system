<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
class Sections extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = [
        'name',
        'status',
        'grade_id',
        'classes_id',

    ];
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'section_teacher', 'sections_id', 'teachers_id');
    }
}
