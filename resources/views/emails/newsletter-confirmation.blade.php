<p>Merci pour votre inscription !</p>

<p>Cliquez sur le lien pour confirmer :</p>

<a href="{{ route('newsletter.confirm', $subscriber->verification_token) }}">
    Confirmer mon email
</a>