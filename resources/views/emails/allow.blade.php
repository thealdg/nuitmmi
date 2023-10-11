@extends("emails.template");
@section("content")
<h2 style='font-size: 14px; margin: 30px 0;'>Bonjour {{$infos->userName}} {{$infos->userSurname}}</h2>
    <p style='font-size: 12px; text-align: justify;'>Suite à la demande de participation de votre oeuvre “{{$infos->workName}}” dans la catégorie “{{$infos->category}}”, nous vous remercions de votre participation et nous sommes heureux de vous annoncer que celle-ci a été validée et apparaît dès à présent sur le site de La Nuit MMI ! </p>
    <p style='font-size: 12px; text-align: justify;'>Pour rappel, elle candidate dans les oeuvres @if($infos->competition==1) en exposition et en compétition @else en exposition @endif.". Par conséquent, elle sera exposée le 8 janvier 2024 au cours de la cérémonie.</p>
    <p style='font-size: 12px; text-align: justify; margin-top: 20px;'>L’ensemble de vos oeuvres sont visibles dans l’onglet “Vos oeuvres” de votre compte ou via le lien ci-dessous.</p>
    <a href="{{route('profil')}}?oeuvres" style='display: block; margin: 40px auto; font-size: 16px; width: fit-content; color: white; text-decoration: none; padding: 10px 45px; background: linear-gradient(130deg,#845917,#DAC469 50%); border-radius: 15px;'>Voir mes oeuvres</a>
@endsection