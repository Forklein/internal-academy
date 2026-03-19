<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use Inertia\Inertia;

class WorkshopController extends Controller
{

    public function index() {
        $user = auth()->user();

        $workshops = Workshop::withCount('registrations')->get();

        $userRegistrations = $user->registrations()->pluck('workshop_id');

        return Inertia::render('workshops/index', [
            'workshops' => $workshops,
            'userRegistrations' => $userRegistrations,
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

    public function edit(Workshop $workshop){
        return Inertia::render('workshops/edit', [
            'workshop' => $workshop,
        ]);
    }

    public function update(Request $request, Workshop $workshop) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'starts_at' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);

        $workshop->update($validated);

        return redirect()->route('workshops.index')->with('success', 'Workshop updated successfully');
    }

    public function destroy(Workshop $workshop) {
        $workshop->delete();

        return redirect()->route('workshops.index')->with('success', 'Workshop deleted successfully');
    }
}
