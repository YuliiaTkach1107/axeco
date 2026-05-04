<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestion\Invitation;

class InvitationController extends Controller
{
    public function check(Request $request){
        $request->validate([
            'code'=>'required|string'
        ]);
        $invitation = Invitation::where('code',$request->code)
            ->whereNull('used_at')
            ->first();
        if(!$invitation){
            return back()->withErrors([
                'code'=>'Code invalide ou déjà utilisé'
            ]);
        }

        session()->regenerate();
        session([
            'invitation' => [
            'role' => $invitation->role,
            'id' => $invitation->id,
            ]
        ]);
        return redirect()->route('register');    
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
