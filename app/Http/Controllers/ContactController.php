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
                'telephone' => 'required|string',
                'adresse_immeuble' => 'required|string',
                'numero_police' => 'required|string',
                'code_postal' => 'required|string',
                'nombre_lots' => 'required|integer',
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
                'file' => 'required|file|max:5120',
            ], [
                'file.required' => 'Veuillez sélectionner un fichier.',
                'file.file' => 'Le fichier doit être valide.',
                'file.max' => 'Le fichier est trop volumineux (max 5 Mo).',
            ]);

            $file = $request->file('file');

            $data['file'] = $file;
        }
        Mail::to('info@axeco.immo')->send(new ContactFormMail($data, $file));

        return back()->with('success', 'Votre demande a été envoyée !');
    }
}
