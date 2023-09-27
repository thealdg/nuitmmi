@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section("content")
<section id="form">
    <div class="container">
        <h1>Connexion</h1>
        <form action="{{route('loginT')}}" method="post">
            @csrf
            <label for="email">Email</label><input type="email" name="email" id="email" required ><label for="password">Mot de passe</label><input type="password" name="password" id="password" required >
            <div>
                <div><div><input type="checkbox" name="remember" id="remember" value="true"><label for="remember">Se souvenir de moi</label></div></div>
            </div>
            @if(isset($_SESSION["error"]))
            <p id="error">{{$_SESSION["error"]}}</p>
            @unset($_SESSION["error"])
            @endif
            <button type="submit">Valider</button>
            <a href="{{route('register')}}">Pas de compte? <span>Inscrivez-vous !</span></a>
            <a href="{{route('password')}}"><span>Mot de passe oublié ?</span></a>
        </form>
    </div>
</section>
@endsection