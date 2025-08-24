<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlionClasses extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classes::class, 'classe_id');
    }

    public function section()
    {
        return $this->belongsTo(Sections::class);
    }
}
