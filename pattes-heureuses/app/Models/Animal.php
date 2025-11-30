<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'coat',
        'type',
        'age',
        'author',
        'breed',
        'state',
        'avatar'
    ];
}
