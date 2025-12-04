<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Specie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    function breeds(): HasMany
    {
        return $this->hasMany(Breed::class);
    }

    public function animals(): HasManyThrough
    {
        return $this->hasManyThrough(
            Animal::class,
            Breed::class,
            'species_id',
            'breed_id',
            'id',
            'id'
        );
    }
}
