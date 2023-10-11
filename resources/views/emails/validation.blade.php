@extends("emails.template")
@section("content")
            <h2 style='font-size: 14px; margin: 30px 0;'>Bonjour {{$name}}</h2>
            <p style='font-size: 12px; text-align: center;'>Vous trouverez ci-dessous le code de vérification afin de confirmer votre adresse email:</p>
            <h1 style='width: fit-content; margin: 40px auto; font-size: 42px; color: #DAC469; padding: 15px 30px; border: solid #DAC469 1px;'>{{$code}}</h1>
            <p style='font-size: 12px; text-align: center;'>Pour garantir la confidentialité de vos informations et accéder à votre compte, le code de validation ci-dessus est valable les <b>15 minutes</b> suivant la demande de vérification.</p>
@endsection