<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\MessageController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;






Route::group([],function () {
    Route::get('/', function () {
        return view('client.home');
    })->name('home');
    Route::view('/about', 'client.about')->name('about');
    Route::get('/animals', [AnimalController::class, 'index'])
        ->name('animals.index');
    Route::get('/animals/{id}', [AnimalController::class, 'show'])
        ->name('animals.show');

    //Contacts
    Route::get('/contact', [MessageController::class, 'create'])
        ->name('contact.create');
    Route::post('/contact', [MessageController::class, 'store'])
        ->name('contact.store');


    //Adoption create
    Route::get('/adoption/{id}', [AdoptionController::class, 'create'])
        ->name('adoption.create');
    route::post('/adoption', [AdoptionController::class, 'store'])
        ->name('adoption.store');
});
