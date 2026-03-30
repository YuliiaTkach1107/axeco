    <p><strong>Nom:</strong> {{$data['frname']}}</p>
    <p><strong>Prenom:</strong> {{$data['name']}}</p>
    <p><strong>Email:</strong> {{$data['email']}}</p>
    <p><strong>Message:</strong> {{$data['message']}}</p>
    @if(!empty($data['telephone']))
    <p><strong>Téléphone:</strong> {{ $data['telephone'] }}</p>
    @endif
    @if(!empty($data['adresse_immeuble']))
        <p><strong>Adresse de l'immeuble: </strong>{{ $data['adresse_immeuble'] }}</p>
    @endif
    @if(!empty($data['numero_police']))
        <p><strong>Numéro de police:</strong> {{ $data['numero_police'] }}</p>
    @endif
    @if(!empty($data['code_postal']))
        <p><strong>Code postal:</strong> {{ $data['code_postal'] }}</p>
    @endif
    @if(!empty($data['nombre_lots']))
        <p><strong>Nombre de lots:</strong> {{ $data['nombre_lots'] }}</p>
    @endif
    @if(isset($data['file']))
        <p><strong>Fichier envoyé :</strong> {{ $data['file']->getClientOriginalName() }}</p>
    @endif