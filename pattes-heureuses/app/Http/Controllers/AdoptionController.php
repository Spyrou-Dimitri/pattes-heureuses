<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdoptionController extends Controller
{

    public function index()
    {

    }

    public function create($id)
    {
        $animal = Animal::findOrFail($id);
        return view('client.adoption-create', compact('animal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|min:3|max:100',
            'first_name' => 'required|min:3|max:100',
            'email' => 'required',
            'status' =>  Rule::enum(AdoptionStatus::class),
            'telephone' => 'nullable|regex:/^\+?[0-9 ]{10,15}$/',
            'housing_type' => 'nullable|max:100',
            'environment' => 'nullable|max:100',
            'motivations' => 'nullable|max:100',
            'animal_id'=> 'required',

        ]);
        Adoption::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'status' => AdoptionStatus::Pending,
            'telephone' => $validated['telephone'],
            'housing_type' => $validated['housing_type'],
            'environment' => $validated['environment'],
            'motivations' => $validated['motivations'],
            'animal_id' => $validated['animal_id']
        ]);
        $request->session()->flash('success', 'Demande d\'adoption envoyée avec succès !');

        return redirect()->back();

    }

}
