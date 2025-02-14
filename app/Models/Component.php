<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function grades(): HasMany
    {
        return $this->hasMany(ComponentGrade::class, 'component_id');
    }
}
