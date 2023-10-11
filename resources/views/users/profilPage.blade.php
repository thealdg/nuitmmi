
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
<div id="big_ticket" style="display: none">

</div>
<section id="profil">
    <div class="container">
        <nav>
            <label for="account" class="current">Mon compte</label>
            <label for="security">Sécurité</label>
            <label for="works" onclick="startCaroussel('div:not(.hidden) > .works','.work');">Mes œuvres</label>
            <label for="tickets" onclick="startCaroussel('.tickets','.ticket')">Mes billets</label>
            <span onclick="document.getElementById('logout').style.display='flex'">Déconnexion</span>
        </nav>
        <input type="radio" id="account" name="section">
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
                    @if(property_exists($data,"profilePicture") && $data->profilePicture != null)
                    <img src="{{$data->profilePicture}}" alt="Photo de profil" id="preview">
                    @else
                    <img src="{{asset('images/icons/profile.png')}}" alt="Photo de profil" id="preview" style="object-fit: contain; border-radius: 0">
                    @endif
                    <input type="file" name="profilePic" id="profilePic" accept="image/png,image/jpg,image/jpeg,image/gif" onchange="loadFile(event)">
                    <label for="profilePic">Modifier</label>

                </div>
            </div>
            <button type="submit">Mettre à jour</button>
            </form>
            @if(session()->has("error"))
            <p id="error">{{session("error")}}</p>
            {{session()->forget("error")}}
            @endif
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
            @if(session()->has("error"))
            <p id="error">{{session("error")}}</p>
            {{session()->forget("error")}}
            @endif
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
        <div id="exposition">
            @if(count($works)>1)<button class="leftArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
                <div class="works">
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
                @if(count($works)>1)<button class="rightArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
        </div>
        <div id="participation" class="hidden">
            @if(count($competitionWorks)>1)<button class="leftArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
                <div class="works">
                    @foreach($competitionWorks as $work)
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
            @if(count($competitionWorks)>1)<button class="rightArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
        </div>
        </section>
        <input type="radio" name="section" id="tickets">
        <section class="tickets_section">
            <h1>Mes billets</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum aut asperiores aperiam officia cum at!</p>
            <div>
            <button class="leftArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>
                <div class="tickets">
                    @foreach($tickets as $ticket)
                    <div class="ticket">
                        <div>
                            <img src="{{asset($ticket->qrCode)}}" alt="QRCode">
                            <h2>{{$ticket->name}} {{$ticket->surname}}</h2>
                            <h2>Entrée unique</h2>
                            <button onclick="displayTicket(this.parentElement);"></button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="rightArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>
            </div>
        </section>
    </div>
</section>
<script>
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
        output.style.objectFit = "";
        output.style.borderRadius = "100%";
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
<script>
    function firstSection(sectionId){
        document.getElementById(sectionId).checked = true;
        document.getElementById(sectionId).labels[0].click();
    }
    @if(isset($_GET["compte"]))
    firstSection("account")
    @elseif(isset($_GET["securite"]))
    firstSection("security")
    @elseif(isset($_GET["oeuvres"]))
    firstSection("works")
    @elseif(isset($_GET["billets"]))
    firstSection("tickets")
    @else
    firstSection("account")
    @endif

</script>
<script src="{{asset('js/changeCategory.js')}}"></script>
<script src="{{asset('js/caroussel.js')}}"></script>
<script>

    function startCaroussel(rowClass,cardClass){
        
        if(initialRows.length > 0){
            if(initialRows[0].className.includes("works")){
                removeCaroussel("div:not(.hidden) > .works");
            } else {
                removeCaroussel("."+initialRows[0].className);
            }
            
        }
        if(rowClass.includes(".works")){
            
            if(window.innerWidth < 900){
                carousselStaff(rowClass,cardClass);
            }
        } else {
            carousselStaff(rowClass,cardClass);
        }
    }

    window.addEventListener("resize",()=>{
        if(document.querySelector(".works_section")!=null && getComputedStyle(document.querySelector(".works_section")).getPropertyValue("display") == "block"){
            console.log("test");
            startCaroussel("div:not(.hidden) > .works",".work");
        }
    })
</script>
<script>
    function displayTicket(ticket){
        let container = document.getElementById("big_ticket");
        container.style.display = "flex";
        let bigTicket = ticket.cloneNode(true);
        container.appendChild(bigTicket);
        bigTicket.querySelector("button").onclick = ()=>{
            bigTicket.remove();
            container.style.display="none";
        }
    }
</script>
    




@endsection
