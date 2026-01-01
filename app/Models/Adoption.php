<?php

namespace App\Models;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Observers\AdoptionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([AdoptionObserver::class])]
class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'status',
        'email',
        'telephone',
        'environment',
        'housing_type',
        'motivations',
        'animal_id',
    ];

    protected $casts = [
        'status' => AdoptionStatus::class

    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }
}
