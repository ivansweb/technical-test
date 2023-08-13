<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Turbine extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'model',
        'manufacturer',
        'serial_number',
        'instalation_date',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
