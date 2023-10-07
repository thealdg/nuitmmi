
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/profil.css')}}">
@endsection
@section("content")
<div id="logout" style="display: none">
    <div class="box">
        <p>Se déconnecter?</p>
        <div class="choice">
            <span onclick="document.getElementById('logout').style.display='none'">Annuler</span>
            <a href="{{route('logout')}}">Confirmer</a>
        </div>
    </div>

</div>
<section id="profil">
    <div class="container">
        <nav>
            <label for="account" class="current">Mon compte</label>
            <label for="security">Sécurité</label>
            <label for="works">Mes œuvres</label>
            <span onclick="document.getElementById('logout').style.display='flex'">Déconnexion</span>
        </nav>
        <input type="radio" id="account" name="section" checked>
        <section class="account_section">
            <h1>Mon compte</h1>
            <form action="{{route('edit')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                <div class="infos">
                    <div><div class="entry">
                    <label for="surname">Nom</label>
                    <input type="text" name="surname" id="surname" value="{{$data->surname}}" placeholder="{{$data->surname}}" readonly></div>
                    <div class="entry">
                    <label for="name">Prénom</label>
                    <input type="text" name="name" id="name" value="{{$data->name}}" placeholder="{{$data->name}}" readonly></div></div>
                    <div><div class="entry"><label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{$data->email}}" placeholder="{{$data->email}}"></div>
                    <div class="entry"><label for="phone">Numéro de téléphone</label>
                    <input type="tel" name="phone" id="phone" value="{{$data->phone}}" placeholder="01 02 03 04 05"></div></div>
                    <div class="entry" id="linkedin"><label for="linkedin" style="font-size: 3rem"><i class='bx bxl-linkedin-square' ></i></label>
                    <input type="text" name="linkedin" id="linkedin" value="{{$data->linkedin}}" placeholder="https://www.linkedin.com">
                </div>
                    <p>Votre profil LinkedIn sera visible dans les pages dédiées à vos oeuvres.</p>
                </div>
                <div class="pp">
                    @if(property_exists($data,"profilePicture"))
                    <img src="{{$data->profilePicture}}" alt="Photo de profil" id="preview">
                    @else
                    <img src="images/icons/profile.svg" alt="Photo de profil" id="preview" style="background: white";>
                    @endif
                    <input type="file" name="profilePic" id="profilePic" accept="image/*" onchange="loadFile(event)">
                    <label for="profilePic">Modifier</label>

                </div>
            </div>
            <button type="submit">Mettre à jour</button>
            </form>
        </section>
        <input type="radio" id="security" name="section">
        <section class="security_section">
            <h1>Sécurité</h1>
            <h2>Changer le mot de passe</h2>
            <form action="{{route('edit')}}" method="post">
                @csrf
                <div class="form_section"><label for="oldPassword">Mot de passe actuel</label>
                <input type="password" name="oldPassword" id="oldPassword" placeholder="Votre mot de passe actuel"></div>
                <div><div class='form_section'><label for="password1">Nouveau mot de passe</label>
                <input type="password" name="password1" id="password1" placeholder="Votre nouveau mot de passe"></div>
                <div class="form_section"><label for="password2">Confirmer mot de passe</label>
                <input type="password" name="password2" id="password2" placeholder="Confirmer le nouveau mot de passe"></div></div>
                <button type="submit">Confirmer</button>
            </form>
        </section>
        <input type="radio" id="works" name="section">
        <section class="works_section">
        <h1>Mes œuvres</h1>
        <p>Les œuvres doivent tout d'abord être validées par les organisateurs de l'événement afin de figurer sur le site et être exposées le jour même.</p>
        <p>Une <strong>seule œuvre</strong> au maximum doit être validée <strong>par catégorie</strong>.</p>
        <div class="switch">
            <h2 class="current" onclick="exposition()" id="select_exposition">En exposition</h3>
            <h2 onclick="participation()" id="select_competition">En compétition</h3>
        </div>
            <div class="works" id="exposition">
                @foreach($works as $work)
                <div class="work">
                    <h5>{{$work->category}}</h5>
                    <img src="{{asset($work->thumbnail)}}" alt="miniature">
                    <h3>{{$work->name}}</h3>
                    @if($work->result==0 and !is_null($work->result))
                    <h4>Refusé</h4>
                    @elseif($work->result==1)
                    <h4>Validé</h4>
                    @else
                    <h4>En cours</h4>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="works hidden" id="participation">
                @foreach($works as $work)
                @if($work->competition==1)
                <div class="work">
                    <h5>{{$work->category}}</h5>
                    <img src="{{asset($work->thumbnail)}}" alt="miniature">
                    <h3>{{$work->name}}</h3>
                    @if($work->result==0 and !is_null($work->result))
                    <h4>Refusé</h4>
                    @elseif($work->result==1)
                    <h4>Validé</h4>
                    @else
                    <h4>En cours</h4>
                    @endif
                </div>
                @endif
                @endforeach
            </div>
        </section>
    </div>
</section>
<script>
    function exposition(){
        document.getElementById('participation').classList.add("hidden");
        document.getElementById('exposition').classList.remove("hidden");
        document.getElementById("select_exposition").classList.add("current");
        document.getElementById("select_competition").classList.remove("current");
        document.getElementById('count_exposition').classList.remove("hidden");
        document.getElementById('count_participation').classList.add("hidden");
    }
    function participation(){
        document.getElementById('participation').classList.remove("hidden");
        document.getElementById('exposition').classList.add("hidden");
        document.getElementById("select_competition").classList.add("current");
        document.getElementById("select_exposition").classList.remove("current");
        document.getElementById('count_exposition').classList.add("hidden");
        document.getElementById('count_participation').classList.remove("hidden");

    }
    var labels = document.getElementById("profil").getElementsByTagName("nav")[0].getElementsByTagName("label");
    for(i=0;i<labels.length;i++){
        labels[i].addEventListener("click",function(){
            for(i=0;i<labels.length;i++){
                labels[i].classList.remove("current");
            }
            this.classList.add("current");

        })
    }
    var loadFile = function(event) {
    var output = document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };


</script>
@endsection
