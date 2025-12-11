<?php

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


    Route::view('animals', 'client.animals.index')->name('animals.index');
    Route::view('animals/show-test', 'client.animals.show')->name('animals.show-test');



    Route::view('contact', 'client.contact')->name('contact');

    Route::view('adoption', 'client.adoption-create')->name('adoption.create');
});
