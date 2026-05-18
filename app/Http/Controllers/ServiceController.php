<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Service;
use App\Models\Valeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('details')->get()
            ->map(function ($service) {
                $service->image_url = $service->image_url
                    ? Storage::url($service->image_url)
                    : null;

                return $service;
            });
        $details = Detail::all();
        $valeurs = Valeur::all();

        return Inertia::render('Services', [
            'services' => $services,
            'details' => $details,
            'valeurs' => $valeurs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
