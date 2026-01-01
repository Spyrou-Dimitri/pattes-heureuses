<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecieVaccin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'specie_vaccin';

    protected $fillable = [
        'specie_id',
        'vaccin_id',
    ];

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class);
    }

    public function vaccin(): BelongsTo
    {
        return $this->belongsTo(Vaccin::class);
    }
}
