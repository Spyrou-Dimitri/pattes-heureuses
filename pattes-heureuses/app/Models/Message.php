<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'telephone',
        'topic',
        'description',
        'is_favourite',
    ];


    public function formatedForMessagery() {
        $created = $this->created_at;

        if ($created->isToday()) {
            return $created->format('H:i');
        } elseif ($created->isCurrentYear()) {
            return $created->format('j M');
        }
        return $created->format('j M Y');



    }
}
