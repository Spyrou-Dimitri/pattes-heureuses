<?php

use App\Http\Controllers\StatsPdfController;
use App\Models\User;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::view('/', 'admin.login')->name('login')->middleware('guest');
    Route::livewire('/dashboard', 'pages::⚡dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');


    //Animaux
    Route::livewire('/animals', 'pages::animals.index')
        ->middleware(['auth', 'verified'])
        ->name('animals');
    Route::livewire('/animals/create', 'pages::animals.create')
        ->middleware(['auth'])
        ->name('animals-create');
    Route::livewire('/animals/{id}', 'pages::animals.show')
        ->middleware(['auth'])
        ->name('animals-show');
    Route::livewire('/animals/edit/{id}', 'pages::animals.edit')
        ->middleware(['auth'])
        ->name('animals-edit');


    //Bénévoles
    Route::livewire('/volunteers', 'pages::volunteers.index')
        ->middleware(['auth', 'verified'])
        ->name('volunteers');
    Route::livewire('/volunteers/create', 'pages::volunteers.create')
        ->can('create', User::class)
        ->middleware(['auth', 'verified'])
        ->name('volunteers-create');
    Route::livewire('/volunteers/{id}', 'pages::volunteers.show')
        ->middleware(['auth'])
        ->name('volunteers-show');
    Route::livewire('/volunteers/edit/{id}', 'pages::volunteers.edit')
        ->middleware(['auth'])
        ->name('volunteers-edit');


    //Adoptions

    Route::livewire('/adoptions/create', 'pages::adoptions.create')
        ->middleware(['auth', 'verified'])
        ->name('adoptions-create');
    Route::livewire('/adoptions', 'pages::adoptions.index')
        ->middleware(['auth', 'verified'])
        ->name('adoptions');
    Route::livewire('/adoptions/{id}', 'pages::adoptions.show')
        ->middleware(['auth', 'verified'])
        ->name('adoptions-show');


    //Settings
    Route::livewire('/settings', 'pages::settings.index')
        ->middleware(['auth', 'verified'])
        ->name('settings');

    //Messagery
    Route::livewire('/messagery', 'pages::messagery.index')
        ->middleware(['auth', 'verified'])
        ->name('messagery-index');
    Route::livewire('/messagery/{id}', 'pages::messagery.show')
        ->middleware(['auth', 'verified'])
        ->name('messagery-show');

    //PDF
    Route::get('/pdf/statistiques/mois', [StatsPdfController::class, 'monthly_stats'])
        ->name('pdf.stats.month');
});

