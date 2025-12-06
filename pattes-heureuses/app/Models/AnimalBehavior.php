<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalBehavior extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'animal_behavior';

    protected $fillable = [
        'animal_id',
        'behavior_id',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function behavior(): BelongsTo
    {
        return $this->belongsTo(Behavior::class);
    }
}
