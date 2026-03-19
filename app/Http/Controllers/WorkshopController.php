<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use Inertia\Inertia;

class WorkshopController extends Controller
{

    public function index() {
        $workshops = Workshop::orderBy('created_at', 'desc')->get();

        return Inertia::render('workshops/index', [
            'workshops' => $workshops
        ]);
    }

    public function create() {
        return Inertia::render('workshops/create');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'starts_at' => 'required|date|after:now',
            'capacity' => 'required|integer|min:1',
        ]);

        Workshop::create($validated);

        return redirect()->route('workshops.index')->with('success', 'Workshop created successfully');
    }
}
