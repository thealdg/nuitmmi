@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section("content")
<section id="form">
    <div class="container">
        <h1>Demande de réinitialisation de mot de passe</h1>
        <p>Si votre email est reconnu, vous recevrez un lien pour réinitialiser votre mot de passe sur celui-ci.</p>
        <form action="{{route('resetPassword')}}" method="post">
            @csrf
            <div><input type="email" name="email" id="email" placeholder="Votre email" required></div>
            @if(isset($_SESSION["error"]))
            <p id="error">{{$_SESSION["error"]}}</p>
            @unset($_SESSION["error"])
            @endif
            <button type="submit">Valider</button>
        </form>
    </div>
</section>
@endsection