<p>
    Bonjour,<br>
    Vous recevez cet email parce que vous êtes abonné(e) à notre newsletter.<br>
    Nous avons publié un nouvel article que nous pensons pouvoir vous intéresser.<br>
</p>
<h1>{{ $article->title }}</h1>
<p>Merci de votre confiance et à très bientôt !</p>

<p>Si vous ne souhaitez plus recevoir nos emails, <br>
vous pouvez vous désabonner à tout moment en cliquant ici :</p>

<a href="{{ route('Article', ['id' => $article->id]) }}" 
   style="display: inline-block; padding: 12px 24px; background-color: #0d4677; color: #ffffff; text-decoration: none; border-radius: 25px; font-weight: bold;">
    Lire l’article
</a>
<p>
    Si vous souhaitez vous désabonner :
</p>

<a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}">
    Se désabonner
</a>

