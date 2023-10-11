@extends("emails.template")
@section("content")
<h2 style='font-size: 14px; margin: 30px 0;'>Bonjour {{$infos->userName}} {{$infos->userSurname}}</h2>
    <p style='font-size: 12px; text-align: justify;'>Suite à la demande de participation de votre oeuvre “{{$infos->workName}}” dans la catégorie “{{$infos->category}}"”, nous vous remercions de votre participation et nous sommes navrés de vous annoncer que celle-ci a été refusée et ne peut apparaître sur le site de La Nuit MMI.</p>
    <p style='font-size: 12px; text-align: justify;'>Pour plus de détails, la modération vous a adressé un message pour préciser et justifier les raisons de refus :</p><p style='font-size: 12px; text-align: center; margin: 30px 0;'><b>$reasons</b></p>
@endsection