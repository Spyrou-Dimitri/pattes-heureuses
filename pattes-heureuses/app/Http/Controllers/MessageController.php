<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {

    }
    public function create()
    {
        return view('client.contact');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|min:3|max:100',
            'first_name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'telephone' => 'nullable|regex:/^\+?[0-9 ]{10,15}$/',
            'topic' => 'required|min:3|max:40',
            'message' => 'required|max:1000',
        ]);

        Message::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'topic' => $validated['topic'],
            'description' => $validated['message'],
        ]);
        $request->session()->flash('success', 'Message envoyé avec succès !');
        return redirect()->back();

    }
}
