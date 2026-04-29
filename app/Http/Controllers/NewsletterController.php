<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterConfirmationMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ],
            [
                'email.unique' => 'Vous êtes déjà abonné à la newsletter.',
            ]);

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'is_verified' => false,
            'verification_token' => Str::random(60),
            'unsubscribe_token' => Str::random(60),
        ]);
        Mail::to($subscriber->email)
            ->send(new NewsletterConfirmationMail($subscriber));

        return redirect()->route('Actualites')->with('success', 'Consultez votre boîte mail pour confirmer votre abonnement.');
    }

    public function confirm($token)
    {
        $subscriber = Subscriber::where('verification_token', $token)->first();
        if (! $subscriber) {
            return redirect()->route('Actualites')->with('error', 'Lien de confirmation invalide ou expiré.');
        }
        $subscriber->is_verified = true;
        $subscriber->verification_token = null;

        $subscriber->save();

        return redirect()->route('Actualites')->with('success', 'E-mail confirmé avec succès !');
    }

    public function unsubscribe($token)
    {
        $subscriber = Subscriber::where('unsubscribe_token', $token)->first();

        if (! $subscriber) {
            return redirect()->route('Actualites')
                ->with('error', 'Lien invalide');
        }
        $subscriber->delete();

        return redirect()->route('Actualites')
            ->with('success', 'Vous êtes désabnné avec succès.');
    }
}
