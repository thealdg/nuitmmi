@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/login.css">
@endsection
@section("content")
<section id="form">
    <div class="container">
        <h1>Changement de mot de passe</h1>
        <form action="index.php?action=changePassword&key={{$_GET['key']}}" method="post">
            <div class="form_section"><label for="password1">Nouveau mot de passe</label><input type="password" name="password1"  placeholder="" required id="password1">
            <label for="password2">Confirmer nouveau mot de passe</label><input type="password" name="password2"  placeholder="" required id="password2"></div>
            @if(isset($_SESSION["error"]))
            <p id="error">{{$_SESSION["error"]}}</p>
            @unset($_SESSION["error"])
            @endif
            <button type="submit">Valider</button>
        </form>
    </div>
</section>
@endsection