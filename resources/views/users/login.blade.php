@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section("content")
<section id="form" class="login">
    <div class="container">
        <h1>Connexion</h1>
        <form action="{{route('loginT')}}" method="post">
            @csrf
            <label for="email">Email</label><input type="email" name="email" id="email" required placeholder="Votre email"><label for="password">Mot de passe</label><input type="password" name="password" id="password" required placeholder="Votre mot de passe">
            <div>
                <div><div><input type="checkbox" name="remember" id="remember" value="true"><label for="remember">Se souvenir de moi</label></div></div>
            </div>
            @if(session()->has("error"))
            <p id="error">{{session("error")}}</p>
            {{session()->forget("error")}}
            @endif
            <button type="submit">Valider</button>
            <a href="{{route('register')}}">Pas de compte ? <span>Inscrivez-vous !</span></a>
            <a href="{{route('password')}}"><span>Mot de passe oublié ?</span></a>
        </form>
    </div>
</section>
@endsection