@extends("emails.template")
@section("content")
<h2 style='font-size: 14px; margin: 30px 0;'>Bonjour {{$name}}</h2>
<p style='font-size: 12px; text-align: center;'>Vous trouverez ci-dessous le lien afin de modifier votre mot de passe :</p>
<a href="{{route('changePassword',[$email,$token])}}" style='display: block; margin: 40px auto; font-size: 14px; width: fit-content; color: white; text-decoration: none; padding: 15px 30px; background: linear-gradient(130deg,#845917,#DAC469 50%); border-radius: 15px;'>Modifier mon mot de passe</a>
<p style='font-size: 12px; text-align: center;'>Pour garantir la confidentialité de vos informations et assurer le changement de votre mot de passe, le code de vérification ci-dessus est valable les <b>15 minutes</b> qui suivent la validation de votre précommande. </p>
@endsection