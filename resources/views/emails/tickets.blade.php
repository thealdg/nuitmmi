@extends("emails.template")
@section("content")
<h2 style='font-size: 14px; margin: 30px 0;'>Bonjour {{$name}}</h2>
<p style='font-size: 12px; text-align: center;'>Vous trouverez ci-dessous l'ensemble des billets obtenus via votre réservation, accompagné à chaque fois du nom de la personne désignée :</p>
<div>
    @foreach($tickets as $ticket)
        <div style="margin: 30px auto">
            <img src="{{asset($ticket->qrCode)}}" alt="qrCode" style="display:block,margin:auto">
            <h2 style="text-align: center">{{$ticket->name}} {{$ticket->surname}}</h2>
        </div>
    @endforeach
</div>
<p style='font-size: 12px; text-align: center;'>Nous vous souhaitons de passer une agréable soirée à la date du 08/01/2024, à 19h. </p>
@endsection