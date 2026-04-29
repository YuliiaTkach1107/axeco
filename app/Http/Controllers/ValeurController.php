<?php

namespace App\Http\Controllers;

use App\Models\Valeur;
use Inertia\Inertia;

class ValeurController extends Controller
{
    public function index()
    {
        $valeurs = Valeur::all();

        return Inertia::render('Services', [
            'valeurs' => $valeurs,
        ]);
    }
}
