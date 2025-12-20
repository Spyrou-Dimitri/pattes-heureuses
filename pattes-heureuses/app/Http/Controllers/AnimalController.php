<?php

namespace App\Http\Controllers;

use App\Enums\AnimalStatus;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        $animals_adoptable = Animal::where('state', AnimalStatus::ADOPTABLE)->with('behaviors')->get();
        return view('client.animals.index', compact('animals_adoptable'));
    }
    public function show($id)
    {
        $animal = Animal::findOrFail($id);

        return view('client.animals.show', compact('animal'));
    }
}
