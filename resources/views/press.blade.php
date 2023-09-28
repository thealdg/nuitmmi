@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/press.css')}}">
@endsection
@section("content")
<section id="contact">
    <div class="container">
        <h1>espace presse</h1>
        <h2>Contact Presse</h2>
        <a href="mailto:contact@lanuitmmi.fr">contact@lanuitmmi.fr</a>
        <a href="tel:0612817526">+33 6 12 81 75 26</a>
    </div>
    
</section>
<section id="press">
    <div class="container">
        <div class="category">
            <h3>Communiqués de Presse</h3>
            <div class="link">
                <h4>12 décembre 2023 - Lorem ipsum dolor sit amet.</h4>
                <a href="#">Télécharger</a>
            </div>
            <div class="link">
                <h4>12 décembre 2023 - Lorem ipsum dolor sit amet.</h4>
                <a href="#">Télécharger</a>
            </div>
            <div class="link">
                <h4>12 décembre 2023 - Lorem ipsum dolor sit amet.</h4>
                <a href="#">Télécharger</a>
            </div>
        </div>
        <div class="category">
            <h3>Dossier de Presse</h3>
            <div class="link">
                <h4>12 décembre 2023 - Lorem ipsum dolor sit amet.</h4>
                <a href="#">Télécharger</a>
            </div>
        </div>
        <div class="category">
            <h3>Documents publicitaires</h3>
            <div class="link">
                <h4>12 décembre 2023 - Lorem ipsum dolor sit amet.</h4>
                <a href="#">Télécharger</a>
            </div>
            <div class="link">
                <h4>12 décembre 2023 - Lorem ipsum dolor sit amet.</h4>
                <a href="#">Télécharger</a>
            </div>
        </div>

    </div>
</section>
@endsection