<?php

namespace App\Models;

use App\Enums\SexeAnimal;
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
        'description',
        'age',
        'sexe',
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

    public function coats(): BelongsToMany
    {
        return $this->belongsToMany(Coat::class, 'animal_coat', 'animal_id', 'coat_id');
    }

    public function behaviors(): BelongsToMany
    {
        return $this->belongsToMany(Behavior::class, 'animal_behavior', 'animal_id', 'behavior_id');
    }

    protected $casts = [
        'accept_cats' => 'boolean',
        'accept_kids' => 'boolean',
        'accept_dogs' => 'boolean',
        'sexe' => SexeAnimal::class,
    ];

    //Création de label afin de retourner oui non dans le show des animaux.
    //Ainsi si je veux la valeur (pour un radio) => $this->animal->accept_dog & pour une valeur oui / non => $this->animal->accept_dogs_label
    protected function getAcceptKidsLabelAttribute () {
        return $this->accept_kids ? 'Oui' : 'Non';
    }
    protected function getAcceptDogsLabelAttribute () {
        return $this->accept_dogs ? 'Oui' : 'Non';
    }
    protected function getAcceptCatsLabelAttribute () {
        return $this->accept_cats ? 'Oui' : 'Non';
    }


}
