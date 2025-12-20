<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;

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
        $validated = $request;
        Adoption::create([
            'last_name' => $validated['last-name'],
            'first_name' => $validated['first-name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'housing_type' => $validated['housing-type'],
            'environment' => $validated['environment'],
            'motivations' => $validated['motivations'],
            'animal_id' => $validated['animal-id']
        ]);
        return redirect()->route('about');

    }

}
