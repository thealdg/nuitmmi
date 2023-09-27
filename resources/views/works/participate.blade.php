
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/participate.css">
@endsection
@section("content")
<div id="popup" style="display: none">
    <div class="box">
        <h2>Compétition</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero eum quos quam doloribus cumque fugiat libero itaque nostrum necessitatibus quidem!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus dicta nisi nemo.</p>
        <a href="">En savoir plus</a>
        <button onclick="document.getElementById('popup').style.display='none'">fermer</button>
    </div>
</div>
<section id="participate">
    <div class="container">
        <h1>Participer à La Nuit MMI</h1>
        <p>Les champs marqués d'un <span> * </span> sont obligatoires.</p>
        <form action="{{route('participateT')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input">
                <label for="title">Titre</label>
                <input placeholder="Titre de l'oeuvre" type="text" name="title" id="title" required>
            </div>
            <div class="input">
                <label for="context">Contexte de réalisation</label>
                <select name="context" id="context">
                    <option value="SAE">SAE</option>
                    <option value="Projet personnel">Projet personnel</option>
                    <option value="Projet scolaire">Projet scolaire</option>
                </select>
            </div>
            <div class="description">
            <label for="description">Description</label>
            <textarea placeholder="Description de l'oeuvre" name="description" id="description" rows="1" required></textarea>
            <div class="files">
                <label for="thumbnail" id="thumbnail_label"><i class='bx bx-image-add'></i> Ajouter une miniature</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" onchange="loadFile(event)" required>
                <img src="#" alt="preview" class="hidden" id="preview">
            </div>
            <p>Une <span>miniature</span> est obligatoire afin de participer. Celle-ci doit être en format <span>png</span> ou <span>jpg</span> de dimensions <span>1920x1080</span>.</p>
            </div>
            <div class="input">
                <label for="category">Catégorie</label>
                <select placeholder= "Sélectionnez une catégorie" name="category" id="category" required>
                    <option value="1">Audiovisuel</option>
                    <option value="2">Campagne de communication</option>
                    <option value="3">Production graphique</option>
                    <option value="4">Site Web</option>
                </select>
                <p>Selon la catégorie sélectionnée, plusieurs champs ci-dessous deviendront <span>obligatoires</span>. Nous vous invitons à vous référer à <a href="{{route('participate')}}?modalite"><span>ce lien</span></a> pour plus d'informations.</p>
            </div>
            <div class="input">
                <label for="date">Date de réalisation</label>
                <input type="date" name="date" id="date" required value="<?php echo date("Y-m-d")?>" max="<?php echo date("Y-m-d")?>">
            </div>
            <div class="input">
                <label for="authors">Auteur(s)</label>
                <input placeholder="Séparés par des virgules si plusieurs auteurs" type="text" name="authors" id="authors" required>
            </div>
            <div class="input">
                <label for="video" class="not_required">Lien vidéo <br>(YouTube)</label>
                <input placeholder="https://www.youtube.com/" type="text" name="video" id="video">
            </div>
            <div class="input">
                <label for="link" class="not_required">Lien externe <br>(site web)</label>
                <input placeholder="http://www.iut-lens.univ-artois.fr/" type="text" name="link" id="link">
            </div>
            <div class="input">
                <label for="tools">Logiciels utilisés</label>
                <input placeholder="Séparés par des virgules: Photoshop, Illustrator..." type="text" name="tools" id="tools" required>
            </div>
            <div class="validate">
                <div class="conditions">
                    <div><input type="checkbox" name="conditions" id="conditions" value="true"> <label for="conditons">J'accepte les conditions générales de publication.</label></div>
                    <div><input type="checkbox" name="competition" id="competition" value="true"> <label for="competition" class="not_required">Je souhaite participer à la <span onclick="document.getElementById('popup').style.display='flex';">compétition.</span></label></div>
                </div>
                <button>Envoyer</button>
            </div>
            
        </form>
        @if(session()->has("error"))
            <p id="error">{{session("error")}}</p>
            @unset($_SESSION["error"])
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
</script>
@endsection