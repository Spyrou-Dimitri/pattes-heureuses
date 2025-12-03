<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use phpDocumentor\Reflection\Types\Boolean;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'coat',
        'type',
        'description',
        'age',
        'author',
        'breed',
        'state',
        'avatar',
        'place',
        'accept_cats',
        'accept_dogs',
        'accept_kids',
    ];


    protected function booleanToOuiNon(): Attribute
    {
        return Attribute::make(
            get: fn (bool $value) => $value ? 'Oui' : 'Non',
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
