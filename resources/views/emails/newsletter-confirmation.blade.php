<p>Merci pour votre inscription !</p>

<p>Cliquez sur le lien pour confirmer :</p>

<a href="{{ route('newsletter.confirm', $subscriber->verification_token) }}">
    Confirmer mon email
</a>

<p>
    Si vous souhaitez vous désabonner :
</p>

<a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}">
    Se désabonner
</a>