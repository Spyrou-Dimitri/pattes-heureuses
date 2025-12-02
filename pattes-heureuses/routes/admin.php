<?php

Route::domain('admin.les-pattes-heureuses.test')->middleware('auth')->group(function () {
    Route::view('/', 'admin.login')->name('login')->middleware('guest');
    Route::livewire('dashboard', 'pages::⚡dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');


    /* Animaux */
    Route::livewire('animals', 'pages::animals.index')
        ->middleware(['auth', 'verified'])
        ->name('animals');
    Route::livewire('animals-create', 'pages::animals.create')
        ->middleware(['auth'])
        ->name('animals-create');


    /* Bénévoles */
    Route::livewire('volunteers', 'pages::volunteers.index')
        ->middleware(['auth', 'verified'])
        ->name('volunteers');
    Route::livewire('volunteers-create', 'pages::volunteers.create')
        ->middleware(['auth', 'verified'])
        ->name('volunteers-create');
});

