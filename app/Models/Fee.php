<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classes::class);
    }
    public function section()
    {
        return $this->belongsTo(Sections::class);
    }
}
