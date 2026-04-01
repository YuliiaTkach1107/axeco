<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResumeMail;
use Illuminate\Support\Facades\Mail;

class ResumeController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:5120', 
            'email' => 'required|email',
        ],
        [
            'file.required' => 'Veuillez sélectionner un fichier.',
            'file.file' => 'Le fichier doit être valide.',
            'file.max' => 'Le fichier est trop volumineux (max 5 Mo).', 
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez saisir un email valide.',
        ]);

        $file = $request->file('file'); 
        $email = $request->email;

        Mail::to('info@axeco.immo')->send(new ResumeMail($file, $email));

        return back()->with('success', 'CV envoyé !');
    }
}
