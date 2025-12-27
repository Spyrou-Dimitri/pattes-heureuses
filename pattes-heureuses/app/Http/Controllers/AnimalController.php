<?php

namespace App\Http\Controllers;

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $all_species = Specie::all();
        $all_breeds = Breed::all();
        $all_coats = Coat::all();
        $all_behaviors = Behavior::all();
        $query = Animal::query();

        if ($request->filled('species')) {
            $breedIds = Breed::whereIn('specie_id', $request->species)->pluck('id');
            $query->whereIn('breed_id', $breedIds);
        }

        if ($request->filled('breeds')) {
            $query->whereIn('breed_id', $request->breeds);
        }

        if ($request->filled('sexes')) {
            $query->whereIn('sexe', $request->sexes);
        }

        if ($request->filled('age_range') && !empty($request->filled('age_range'))) {
            [$min, $max] = explode('-', $request->age_range);
            $query->whereBetween('age', [$min, $max]);
        }

        if ($request->filled('coats')) {
            $query->whereHas('coats', fn($getCoat) => $getCoat->whereIn('coats.id', $request->coats));

        }

        if ($request->filled('behaviors')) {
            $query->whereHas('behaviors', fn($getBehaviors) => $getBehaviors->whereIn('behaviors.id', $request->behaviors));
        }
        if ($request->filled('accept_cats')) {
            $query->where('accept_cats', $request->accept_cats);
        }
        if ($request->filled('accept_dogs')) {
            $query->where('accept_dogs', $request->accept_dogs);
        }
        if ($request->filled('accept_kids')) {
            $query->where('accept_kids', $request->accept_kids);
        }


        $animals = $query->where('state', AnimalStatus::ADOPTABLE)->get();


        return view('client.animals.index', compact('animals', 'all_species', 'all_breeds', 'all_coats', 'all_behaviors'));
    }

    public function show($id)
    {
        $animal = Animal::findOrFail($id);

        return view('client.animals.show', compact('animal'));
    }
}
