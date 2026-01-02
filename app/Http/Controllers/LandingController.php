<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        $adoptions_completed =  Adoption::where('status', AdoptionStatus::Completed)->count();
        $volunteers =  User::count();
        $animals_adoptable = Animal::where('state', AnimalStatus::ADOPTABLE)->count();
        $animals = Animal::count();

        return view('client.home', compact('adoptions_completed', 'volunteers', 'animals_adoptable', 'animals'));

    }
}
