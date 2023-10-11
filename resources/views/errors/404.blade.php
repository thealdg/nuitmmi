@extends('layouts.app')
@section("css")
<link rel="stylesheet" href="{{asset('css/404.css')}}">
@section('content')
<section id="error_404">
    <div class="container">
        <div class="error">
            <h1>4</h1>
            <div class="star"></div>
            <h1>4</h1>
        </div>
        <p>La page que vous cherchez n'est pas disponible. Nous vous invitons à revenir sur la page d'accueil ou celle de votre choix.</p>
        <a href="/">Retour à la page d'accueil</a>
    </div>
</section>
@endsection