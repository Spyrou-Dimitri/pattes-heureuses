<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Behavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_behavior', 'behavior_id', 'animal_id');
    }
}
