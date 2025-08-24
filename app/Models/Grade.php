<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name', 'notes'];

    public $translatable = ['name'];
    public function classes(): HasMany
    {
        return $this->hasMany(Classes::class);
    }
    public function section(): HasMany
    {
        return $this->hasMany(Sections::class);
    }
    public function OnlionClasses(): HasMany
    {
        return $this->hasMany(OnlionClasses::class);
    }
}
