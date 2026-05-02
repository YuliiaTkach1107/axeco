<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return Inertia::render('Contact', [
            'contacts' => $contacts,
        ]);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'frname' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);
        $file = null;
        if ($request->subject === 'demande') {
            $request->validate([
                'telephone' => ['required', 'string', 'regex:/^(?=(?:\D*\d){8,15}\D*$)\+?[0-9\s().-]+$/'],
                'adresse_immeuble' => 'required|string',
                'numero_police' => 'required|string',
                'code_postal' => 'required|string',
                'nombre_lots' => 'required|integer',
            ], [
                'telephone.required' => 'Veuillez renseigner votre numéro de téléphone.',
                'telephone.string' => 'Le numéro de téléphone doit être valide.',
                'telephone.regex' => 'Veuillez saisir un numéro de téléphone valide (8 à 15 chiffres).',
                'adresse_immeuble.required' => 'Veuillez renseigner l\'adresse de l\'immeuble.',
                'numero_police.required' => 'Veuillez renseigner le numéro de police.',
                'code_postal.required' => 'Veuillez renseigner le code postal.',
                'nombre_lots.required' => 'Veuillez renseigner le nombre de lots.',
                'nombre_lots.integer' => 'Le nombre de lots doit être un nombre entier.',
            ]);
            $data = array_merge($data, $request->only([
                'telephone',
                'adresse_immeuble',
                'numero_police',
                'code_postal',
                'nombre_lots',
            ]));
        }
        if ($request->subject === 'stage') {
            $request->validate([
                'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            ], [
                'file.required' => 'Veuillez sélectionner un fichier.',
                'file.file' => 'Le fichier doit être valide.',
                'file.mimes' => 'Le fichier doit être un document PDF, DOC ou DOCX.',
                'file.max' => 'Le fichier est trop volumineux (max 5 Mo).',
            ]);

            $file = $request->file('file');

            $data['file'] = $file;
        }
        Mail::to('info@axeco.immo')->send(new ContactFormMail($data, $file));

        return back()->with('success', 'Votre demande a été envoyée !');
    }
}
