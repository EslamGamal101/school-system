<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = [
        'name',
        'grade_id',
    ];
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
    public function sections(): HasMany
    {
        return $this->hasMany(Sections::class);
    }
    

}
