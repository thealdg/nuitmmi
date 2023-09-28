@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section("content")
@if(isset($_COOKIE["verify"]))
<section id="confirm">
    <div>
        <h1>Vérifier votre adresse email</h1>
        <p>Un code à six chiffres a été envoyé à l'adresse suivante : <span>{{session("preorder")["email"]}}</span>. Entrez le code ci-dessous pour confirmer votre adresse email.</p>
        <form action="{{route('preorderValidation')}}" method="post" id="verify">
            @csrf
            <input type="text" name="code" placeholder="XXXXXX" minlength="6" maxlength="6" id="code" size="5" required>
        </form>
        <p>Veuillez garder cette page ouverte tout au long de la procédure.</p>
        <a href="index.php?action=resetPreorderCode">Renvoyer un nouveau code</a>
        @if(isset($_SESSION["error"]))
            <p id="error">{{$_SESSION["error"]}}</p>
            @unset($_SESSION["error"])
            @endif
    </div>
</section>
@endif
<section id="form">
    <div class="container">
        <h1>Validation de votre précommande</h1>
        <form action="{{route('preorderT')}}" method="post">
        @csrf
        <div class="form_section">
        <h2>Informations personnelles</h2>
            <label for="surname">Nom</label><input type="text" name="surname" required id="surname" value="<?php if(isset($infos) and property_exists($infos,"surname")): echo $infos->surname; endif;?>" placeholder="Votre nom">
            <label for="name">Prénom</label><input type="text" name="name" required id="name" value="<?php if(isset($infos) and property_exists($infos,"name")): echo $infos->name; endif;?>" placeholder="Votre prénom">
        </div>
        <div class="form_section"><h2>Contact</h2><label for="email">Email</label><input type="email" name="email" id="email"  required value="<?php if(isset($infos) and property_exists($infos,"email")): echo $infos->email; endif;?>" placeholder="Votre email">
            <label for="phone">Numéro de téléphone <i>(optionnel)</i></label><input type="tel" name="phone" id="phone" pattern="[0-9]{10}" value="<?php if(isset($infos) and property_exists($infos,"phone")): echo $infos->phone; endif;?>" placeholder="01 02 03 04 05"></div>
            <div></div>
            <button type="submit">Valider</button>
</form>
</div>
</section>
<script src="{{asset('js/validationCode.js')}}">

</script>
@endsection