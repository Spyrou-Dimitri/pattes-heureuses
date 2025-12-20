<?php

use App\Http\Controllers\AnimalController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;






Route::domain('les-pattes-heureuses.test')->group(function () {
    Route::get('/', function () {
        return view('client.home');
    })->name('home');
    Route::view('about', 'client.about')->name('about');
    Route::get('animals', [AnimalController::class, 'index'])
        ->name('animals.index');
    Route::get('animals/{id}', [AnimalController::class, 'show'])
        ->name('animals.show');
    Route::view('contact', 'client.contact')->name('contact');
    Route::view('adoption', 'client.adoption-create')->name('adoption.create');
});
