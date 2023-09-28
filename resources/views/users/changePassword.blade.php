@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section("content")
<section id="form">
    <div class="container">
        <h1>Changement de mot de passe</h1>
        <form action="{{route('changePasswordT')}}" method="post">
            @csrf
            <div class="form_section"><label for="password1">Nouveau mot de passe</label><input type="password" name="password1"  placeholder="Votre nouveau mot de passe" required id="password1">
            <label for="password2">Confirmation du nouveau mot de passe</label><input type="password" name="password2"  placeholder="Confirmer nouveau mot de passe" required id="password2"></div>
            @if(session()->has("error"))
            <p id="error">{{session("error")}}</p>
            @unset($_SESSION["error"])
            @endif
            <button type="submit">Valider</button>
        </form>
    </div>
</section>
@endsection