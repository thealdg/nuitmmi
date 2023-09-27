@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section("content")
@if(isset($_COOKIE["verify"]))
<section id="confirm">
    <div>
        <h1>Vérifiez votre adresse email</h1>
        <p>Un code à six chiffres a été envoyé à l'adresse <span>{{session("register")["email"]}}</span>. Entrez le code ci-dessous pour confirmer votre adresse email.</p>
        <form action="{{route('registerValidation')}}" method="post" id="verify">
            @csrf
            <input type="text" name="code" placeholder="XXXXXX" minlength="6" maxlength="6" id="code" size="5" required>
        </form>
        <p>Veuillez garder cette page ouverte tout au long de la procédure.</p>
        <a href="index.php?action=resetRegisterCode">Renvoyer un nouveau code</a>
        @if(session()->has("error"))
            <p id="error">{{session("error")}}</p>
            @endif
    </div>
</section>
@endif
<section id="form">
    <div class="container">
        <h1>Inscription</h1>
        <form action="{{route('registerT')}}" method="post">
        @csrf
        <div class="form_section">
            <h2>Informations personnelles</h2>
            <label for="surname">Nom</label>
            <input type="text" name="surname" required placeholder="Votre nom" id="surname">
            <label for="surname">Prénom</label>
            <input type="text" name="name" required placeholder="Votre prénom" id="name">
            <label for="year">Votre niveau d'étude</label>
            <select name="year" id="year">
                <option value="1">MMI 1</option>
                <option value="2">MMI 2</option>
                <option value="3">MMI 3</option>
                <option value="Ancien">Ancien MMI</option>
            </select></div>
            <div class="form_section">
                <h2>Contact</h2><label for="email">Email</label><input type="email" name="email" id="email"  required placeholder="Votre email">
            <label for="phone">Numéro de téléphone <i>(optionnel)</i></label><input type="tel" name="phone" id="phone" pattern="[0-9]{10}" placeholder="01 02 03 04 05"></div>
            
            
            <div class="form_section"><h2>Sécurité</h2><label for="password">Mot de passe</label><input type="password" name="password" id="password" required placeholder="Votre mot de passe">
            <label for="password2">Confirmer mot de passe</label><input type="password" name="password2" id="password2" required placeholder="Confirmer le mot de passe"></div>
            <div class="form_section"><h2>Réseaux</h2><div class="link"><label for="linkedin"><i class='bx bxl-linkedin-square' ></i></label><input type="text" name="linkedin" placeholder="https://www.linkedin.com/"></div>
            <p>Votre profil LinkedIn sera visible par les visiteurs ayant accés à une ou plusieurs de vos œuvres sur le site.</p></div>
            
            <div>
            <div><div><input type="checkbox" name="conditions" id="conditions" value="true"><label for="conditions">J'accepte les <a href="#"><span>conditions générales</span></a> *.</label></div>
            <div><input type="checkbox" name="newsletter" id="newsletter" value="true"><label for="newsletter">J'accepte de recevoir par email des informations relatives à cet événement.</label></div></div>
                
            </div>
            @if(isset($_SESSION["error"]))
            <p id="error">{{$_SESSION["error"]}}</p>
            @unset($_SESSION["error"])
            @endif
            <button type="submit">Valider</button>
            <a href="index.php?action=profil&page=login">Vous avez déjà un compte ? <span>Connectez-vous !</span></a>
        </form>
    </div>
</section>
<script src="{{asset('js/validationCode.js')}}">
    
</script>
@endsection