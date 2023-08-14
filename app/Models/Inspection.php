<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'turbine_id',
        'inspection_date',
    ];

    public function turbine(): BelongsTo
    {
        return $this->belongsTo(Turbine::class, 'turbine_id');
    }

    public function grades(): HasMany
    {
        return $this->hasMany(ComponentGrade::class, 'inspection_id');
    }

}
