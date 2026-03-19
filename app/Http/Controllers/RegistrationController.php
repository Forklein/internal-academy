<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function store(Workshop $workshop) {
        $user = auth()->user();

        // già registrato
        if ($workshop->registrations()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Already registered');
        }

        // posti disponibili
        if ($workshop->registrations()->count() >= $workshop->capacity) {
            return back()->with('error', 'Workshop full');
        }

        Registration::create([
            'user_id' => $user->id,
            'workshop_id' => $workshop->id,
        ]);

        return back()->with('success', 'Registered successfully');
    }

    public function destroy(Workshop $workshop) {
        $user = auth()->user();

        Registration::where('user_id', $user->id)->where('workshop_id', $workshop->id)->delete();

        return back()->with('success', 'Unregistered successfully');
    }
}
