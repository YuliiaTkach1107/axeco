<p>
    Bonjour,<br>
    Vous recevez cet email car vous êtes abonné(e) à notre newsletter.<br>
    Un nouvel article a été publié sur notre site et pourrait vous intéresser.<br>
</p>
<h1>{{ $article->title }}</h1>
<p>Nous vous invitons à le découvrir en cliquant sur le bouton ci-dessous.</p>

<a href="{{ route('Article', ['id' => $article->id]) }}" 
   style="display: inline-block; padding: 12px 24px; background-color: #0d4677; color: #ffffff; text-decoration: none; border-radius: 25px; font-weight: bold;">
    Lire l’article
</a>

<p>Merci de votre confiance et à très bientôt.</p>

<p>
    Si vous ne souhaitez plus recevoir nos emails, vous pouvez vous désabonner à tout moment en cliquant sur le lien ci-dessous :
</p>

<a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}">
    Se désabonner
</a>
