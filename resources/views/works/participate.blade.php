
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/participate.css">
@endsection
@section("content")

<div id="popup" style="display: none">
    <div class="box">
        <h2>Compétition</h2>
        <p>Vous venez de sélectionner votre oeuvre dans la catégorie “compétition”. Pour rappel, ce domaine vise à élire la meilleure production dans chaque catégorie, aux yeux du jury et du public. De fait, il y aura des vainqueurs et des vaincus ! Mais avant tout, il y aura des personnes qui auront pu saisir l’opportunité de confronter son projet à d’autres afin de voir où ils en sont dans une compétition de niveau pouvant être professionnelle. </p>
        <p>Une fois votre oeuvre inscrite en compétition, elle sera visible dans l’exposition et dans la compétition mais vous ne pourrez la retirer d’une seule catégorie à la fois.</p>
        <a href="{{route('competition')}}">En savoir plus</a>
        <button onclick="document.getElementById('popup').style.display='none'">fermer</button>
    </div>
</div>
<section id="participate">
<div id="arrow">
    <img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche">
</div>
    <div class="container">
        <h1>Participer à La Nuit MMI</h1>
        <h2>Dépot d'une oeuvre</h2>
        <p>Les champs marqués d'un <span> * </span> sont obligatoires.</p>
        <form action="{{route('participateT')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input">
                <label for="title">Titre</label>
                <input placeholder="Titre de l'oeuvre" type="text" name="title" id="title" required @if(session()->has("participate") && isset(session("participate")["title"])) value="{{session('participate')['title']}}" @endif>
            </div>
            <div class="input">
                <label for="context">Contexte de réalisation</label>
                <select name="context" id="context">
                    <option value="SAE" @if(session()->has("participate") && isset(session("participate")["context"]) && session("participate")["context"] == "SAE") selected  @endif>SAE</option>
                    <option value="Projet personnel" @if(session()->has("participate") && isset(session("participate")["context"]) && session("participate")["context"] == "Projet Personnel") selected  @endif>Projet personnel</option>
                    <option value="Projet scolaire" @if(session()->has("participate") && isset(session("participate")["context"]) && session("participate")["context"] == "Projet scolaire") selected  @endif>Projet scolaire</option>
                    <option value="Projet professionel" @if(session()->has("participate") && isset(session("participate")["context"]) && session("participate")["context"] == "Projet professionel") selected  @endif>Projet professionel</option>
                </select>
            </div>
            <div class="description">
                <label for="description">Description</label>
                <div>
                @if(session()->has("participate") && isset(session("participate")["description"])) 
                    <textarea placeholder="Description de l'oeuvre" name="description" id="description" rows="1" required maxlength="600">{{session('participate')['description']}}</textarea>
                @else
                    <textarea placeholder="Description de l'oeuvre" name="description" id="description" rows="1" required maxlength="600"></textarea>
                @endif
                    <span class="count">0 / 600</span>
                </div>
                <div class="files">
                    <div>
                        <label for="thumbnail" id="thumbnail_label"><i class='bx bx-image-add'></i> Ajouter une miniature</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/png,image/jpg,image/jpeg" onchange="loadFile(event)" required>
                        <img src="#" alt="preview" class="hidden" id="preview">
                    </div>
                    <div>
                        <label for="proof" id="proof_label"><i class='bx bxs-file-archive'></i> Ajouter une archive</label>
                        <input type="file" name="proof" id="proof" accept=".zip,.rar" onchange="loadProof()">
                    </div>
                </div>
                <p>Une <span>miniature</span> est obligatoire afin de participer. Celle-ci doit être en format <span>png</span> ou <span>jpg</span> de dimensions <span>1920x1080</span>.
                Pareillement, une archive au format <span>zip</span> ou <span>rar</span> peut vous être demandée pour prouver l'authenticité de votre réalisation. Les fichiers ne peuvent excéder une taille de
                <span>300 Mo</span>.</p>
            </div>
            <div class="input">
                <label for="category">Catégorie</label>
                <select placeholder= "Sélectionnez une catégorie" name="category" id="category" required>
                    <option value="1" @if(session()->has("participate") && isset(session("participate")["category"]) && session("participate")["category"] == "1") selected  @endif>Audiovisuel</option>
                    <option value="2" @if(session()->has("participate") && isset(session("participate")["category"]) && session("participate")["category"] == "2") selected  @endif>Campagne de communication</option>
                    <option value="3" @if(session()->has("participate") && isset(session("participate")["category"]) && session("participate")["category"] == "3") selected  @endif>Production graphique</option>
                    <option value="4" @if(session()->has("participate") && isset(session("participate")["category"]) && session("participate")["category"] == "4") selected  @endif>Développement web</option>
                </select>
                <p>Selon la catégorie sélectionnée, plusieurs champs ci-dessous deviendront <span>obligatoires</span>. Pour relire les conditions de participation, référez vous à <a href="{{route('modalites')}}"><span>ce lien</span></a>.</p>
            </div>
            <div class="input">
                <label for="date">Date de réalisation</label>
                <input type="date" name="date" id="date" required @if(session()->has("participate") && isset(session("participate")["date"])) value="{{session('participate')['date']}}" @else value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}" @endif>
            </div>
            <div class="input">
                <label for="authors">Auteur(s)</label>
                <input placeholder="Séparés par des virgules pour une oeuvre de groupe" type="text" name="authors" id="authors" required @if(session()->has("participate") && isset(session("participate")["authors"])) value="{{session('participate')['authors']}}" @endif>
            </div>
            <div class="input">
                <label for="video" class="not_required">Lien vidéo <br>(YouTube)</label>
                <input placeholder="https://www.youtube.com/" type="text" name="video" id="video" @if(session()->has("participate") && isset(session("participate")["video"])) value="{{session('participate')['video']}}" @endif>
            </div>
            <div class="input">
                <label for="link" class="not_required">Lien externe <br>(site web)</label>
                <input placeholder="https://exemple.com/" type="text" name="link" id="link" @if(session()->has("participate") && isset(session("participate")["link"])) value="{{session('participate')['link']}}" @endif>
            </div>
            <div class="input">
                <label for="tools">Logiciels utilisés</label>
                <input placeholder="Séparés par des virgules: Photoshop, Illustrator..." type="text" name="tools" id="tools" required @if(session()->has("participate") && isset(session("participate")["tools"])) value="{{session('participate')['tools']}}" @endif>
            </div>
            <div class="validate">
                <div class="conditions">
                    <div><input type="checkbox" name="conditions" id="conditions" value="true" @if(session()->has("participate") && isset(session("participate")["conditions"])) checked @endif> <label for="conditons">J'accepte les conditions générales de publication.</label></div>
                    <div><input type="checkbox" name="competition" id="competition" value="true"> <label for="competition" class="not_required">Je souhaite participer à la <span onclick="document.getElementById('popup').style.display='flex';">compétition.</span></label></div>
                </div>
                <button>Participer</button>
            </div>
            
        </form>
        @if(session()->has("error"))
            <p id="error">{{session("error")}}</p>
            {{session()->forget("error")}}
        @endif
    </div>
</section>
<script>
  var loadFile = function(event) {
    document.getElementById('preview').classList.remove("hidden");
    document.getElementById("thumbnail_label").innerHTML = "<i class='bx bx-image-add'></i> Changer la miniature";
    var output = document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  function loadProof(){
    document.getElementById("proof_label").innerHTML = "<i class='bx bxs-file-archive'></i> Changer l'archive";
  }
</script>
<script>
    document.querySelector(".description .count").innerText = document.querySelector("#description").value.length + " / 600";
    document.querySelector("#description").addEventListener("input",()=>{
        document.querySelector(".description .count").innerText = document.querySelector("#description").value.length + " / 600";
    })
</script>
<script>
    let category = document.querySelector("#category");
    function changeRequired(){
        if(category.value == "1"){
            document.getElementById("proof").required = false;
            document.getElementById("video").required = true;
            document.getElementById("video").previousElementSibling.classList.remove("not_required");
            document.getElementById("link").required = false;
            document.getElementById("link").previousElementSibling.classList.add("not_required");
        }
        if(category.value == "2"){
            document.getElementById("proof").required = true;
            document.getElementById("video").required = false;
            document.getElementById("video").previousElementSibling.classList.add("not_required");
            document.getElementById("link").required = false;
            document.getElementById("link").previousElementSibling.classList.add("not_required");
        }
        if(category.value == "3"){
            document.getElementById("proof").required = true;
            document.getElementById("video").required = false;
            document.getElementById("video").previousElementSibling.classList.add("not_required");
            document.getElementById("link").required = false;
            document.getElementById("link").previousElementSibling.classList.add("not_required");
        }
        if(category.value == "4"){
            document.getElementById("proof").required = true;
            document.getElementById("video").required = false;
            document.getElementById("video").previousElementSibling.classList.add("not_required");
            document.getElementById("link").required = true;
            document.getElementById("link").previousElementSibling.classList.remove("not_required");
        }
    }
    category.onchange = changeRequired;
    changeRequired();
</script>
@endsection


