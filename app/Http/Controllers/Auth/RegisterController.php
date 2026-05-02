<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Gestion\Contractor;
use App\Models\Gestion\Invitation;
use App\Models\Gestion\Resident;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{
    public function show()
    {
        return Inertia::render('auth/Register', [
            'invitation' => session('invitation'),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(10)
                    ->letters()
                    ->mixedCase()
                    ->numbers(),
            ],
        ]);

        $invitation = session('invitation');

        if (!$invitation) {
            return redirect()->route('EnterCode')
                ->withErrors(['error' => 'Invitation expirée']);
        }

        $invitationRecord = Invitation::whereKey($invitation['id'])
            ->whereNull('used_at')
            ->first();

        if (! $invitationRecord) {
            $request->session()->forget('invitation');

            return redirect()->route('EnterCode')
                ->withErrors(['error' => 'Code invalide ou déjà utilisé']);
        }
        $nameParts = explode(' ', $request->name, 2);
        $prenom = $nameParts[0] ?? '';
        $nom = $nameParts[1] ?? '';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'role' => $invitation['role'],
        ]);

        if ($user->role === 'contractor') {
            Contractor::create([
                'user_id' => $user->id,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'email'=>$user->email,
                'telephone' => null,
                'adresse' => null,
                'ville' => null,
                'code_postal' => null,
                'note' => 0,
            ]);
        }

        if ($user->role === 'resident') {
            Resident::create([
                'user_id' => $user->id,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'email'=>$user->email,
                'telephone' => null,
                'copropriete_id'=>null,
                'appartement_id'=>null,
                'role'=>null,
            ]);
        }

        $invitationRecord->delete();

        $request->session()->forget('invitation');

        Auth::login($user);
        $request->session()->regenerate();
        
        return response('', 409)

        ->header('X-Inertia-Location', url('/admin'));
    }
}
