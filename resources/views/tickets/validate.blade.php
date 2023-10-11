@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/ticketing.css')}}">
@endsection
@section("content")
@if(session()->has("tickets") and Cookie::has("verify"))
@endif
<section id="tickets">
    <div class="container">
        <section id="validated">
            <h1>Merci pour votre réservation !</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit deserunt recusandae quae quidem! Voluptas delectus impedit voluptate fugit? Ipsa ex id commodi impedit quaerat non recusandae? Corporis ratione dolor facere officia possimus quibusdam nobis natus reiciendis obcaecati eum? Quam, nihil?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, ullam! Eveniet, exercitationem. Saepe minima quam necessitatibus molestiae exercitationem sunt voluptatem similique harum magnam omnis fuga natus atque eligendi officiis dolores quae praesentium inventore velit asperiores veritatis repellendus, adipisci perferendis maxime possimus. Aspernatur at harum eveniet!</p>
            <div class="redirect">
                <a href="{{route('profil')}}?billets">Voir mes réservations</a>
                <a href="{{route('index')}}">Retourner à l'accueil</a>
            </div>
        </section>
    </div>
</section>

@endsection