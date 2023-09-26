@extends("emails.template")
@section("content")
<h2 style='font-size: 14px; margin: 30px 0;'>Bonjour {{$infos->userName}} {{$infos->userSurname}}</h2>
    <p style='font-size: 12px; text-align: justify;'>Suite à la demande de participation de votre oeuvre “{{$infos->workName}}” dans la catégorie “{{$infos->category}}"”, nous vous remercions de votre participation et nous sommes navrés de vous annoncer que celle-ci a été refusée et ne peut apparaître sur le site de La Nuit MMI.</p>
        <p style='font-size: 12px; text-align: justify; margin-top: 20px;'>Votre oeuvre “{{$infos->workName}}” a été refusé pour la/les raison(s) suivantes :</p>
    <p style='font-size: 12px; text-align: center; margin: 30px 0;'><b>{{$reasons["reasons"]}}</b></p>
    @if(isset($reasons["more_reasons"]))<p style='font-size: 12px; text-align: justify;'>Pour plus de détails, la modération vous a adressé un message pour préciser et justifier les raisons de refus :</p><p style='font-size: 12px; text-align: center; margin: 30px 0;'><b>{{$reasons["more_reasons"]}}</b></p>@endif
    <p style='font-size: 12px; margin: 50px 0 75px 0;'>A très bientôt !<br>
    La Team Nuit MMI</p>
@endsection