<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use Inertia\Inertia;

class WorkshopController extends Controller
{

    public function index() {
        $workshops = Workshop::orderBy('created_at', 'desc')->get();

        return Inertia::render('Workshops/Index', [
            'workshops' => $workshops
        ]);
    }
}
