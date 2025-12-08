<?php

use App\Enums\SexeAnimal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->enum('sexe', SexeAnimal::cases());
            $table->integer('age');
            $table->string('state');
            $table->string('author');
            $table->string('avatar');
            $table->boolean('accept_kids');
            $table->boolean('accept_dogs');
            $table->boolean('accept_cats');
            $table->foreignId('breed_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
