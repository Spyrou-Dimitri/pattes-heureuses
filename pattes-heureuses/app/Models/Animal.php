<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use phpDocumentor\Reflection\Types\Boolean;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'coat',
        'description',
        'age',
        'author',
        'state',
        'avatar',
        'place',
        'accept_cats',
        'accept_dogs',
        'accept_kids',
        'breed_id',
    ];


    function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function specieBreed(): HasOneThrough
    {

        return $this->hasOneThrough(
            Specie::class,
            Breed::class,
            'species_id',
            'id',
            'breed_id',
            'id'
        );

    }


    protected function booleanToOuiNon(): Attribute
    {
        return Attribute::make(
            get: fn(bool $value) => $value ? 'Oui' : 'Non',
        );
    }

    protected function acceptCats(): Attribute
    {
        return $this->booleanToOuiNon();
    }

    protected function acceptKids(): Attribute
    {
        return $this->booleanToOuiNon();
    }

    protected function acceptDogs(): Attribute
    {
        return $this->booleanToOuiNon();
    }


}
