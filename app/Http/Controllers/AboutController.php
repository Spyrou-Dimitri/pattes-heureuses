<?php

namespace App\Http\Controllers;

use App\Models\User;

class AboutController extends Controller
{
    public function index()
    {
        $volunteers = User::all();

        return view('client.about', compact('volunteers'));
    }
}
