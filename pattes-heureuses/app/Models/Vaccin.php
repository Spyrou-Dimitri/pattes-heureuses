<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vaccin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function species(): BelongsToMany
    {
        return $this->belongsToMany(Specie::class, 'specie_vaccin', 'vaccin_id', 'specie_id');
    }

    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_vaccin', 'vaccin_id', 'animal_id');
    }
}
