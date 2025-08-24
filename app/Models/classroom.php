<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;


class classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = [
        'name',
        'status',
        'grade_id',
        'class_id',

    ];
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }
}
