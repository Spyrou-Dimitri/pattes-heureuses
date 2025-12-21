<?php

use App\Enums\AnimalStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->enum('status', AnimalStatus::cases());
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('environment')->nullable();
            $table->string('housing_type')->nullable();
            $table->text('motivations')->nullable();
            $table->foreignId('animal_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
