<?php

Route::view('/login', 'admin.login')->name('login')->middleware('guest');
Route::livewire('dashboard', 'pages::⚡dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
