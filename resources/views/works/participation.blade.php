@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/legal.css')}}">
<link rel="stylesheet" href="{{asset('css/participation.css')}}">
@endsection
@section("content")
<div class="container" id="participation">
<div id="arrow">
    <img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche">
</div>
    <h1>Participer à La Nuit MMI</h1>
    <div id="general">
        <h2>Conditions générales</h2>
        <p>Pour participer à La Nuit MMI 2 et exposer son oeuvre, vous devrez respecter certaines conditions générales de participation. En effet, notre équipe souhaite mettre en avant le travail étudiant mais pas celui d’autres personnes ! Ainsi, tous les travaux seront déposés dans un logiciel anti-plagiat afin de s’assurer que ces derniers soient bien issus de votre créativité ! Egalement, tout travaux ne respectant pas l’esprit MMI sera immédiatement supprimée. En cas d’abus, nous nous réservons le droit de donner les informations auprès des responsables de formation. Si votre projet respecte l’ensemble de ces valeurs, c’est avec grand plaisir que nous le publierons sur notre site !</p>
        <p>Enfin, selon les catégories dans lesquelles vous décidez de participer, nous vous invitons à vous référer aux conditions spécifiques de la catégorie indiquée. Les conditions de participation pour l’exposition et la compétition peuvent différer, référez-vous à la bonne catégorie !</p>
    </div>
    <fieldset id="audiovisuel">
        <legend>Audiovisuel</legend>
        <p>Chaque projet audiovisuel devra être accompagné d’une vidéo bande-annonce de 2minutes maximum. Ainsi, chaque bande-annonce pourra être diffusée de façon permanente avec votre contact pour tous les curieux souhaitant voir votre oeuvre en entier. Cette dernière sera cependant visible entièrement sur notre site. </p>
        <p>Toutes les productions audiovisuelles devront nous être fournies par l’intermédiaire d’un lien externe. Cette pratique se justifie par le fait de ne pas surcharger le poids du site et de pouvoir continuer à vous fournir une excellente expérience utilisateur.</p>
    </fieldset>
    <fieldset id="communication">
        <legend>Campagne de communication</legend>
        <p>Vous visez facilement votre cible et de façon efficace ? N’attendez plus et déposer vos oeuvres de communication. Nous acceptons les campagnes de communication, la réflexion sur une stratégie complète, les rétro-planning, les plans marketing, les audits ainsi que les autres supports ! Du projet fictif à une commande externe, la nature nous importe peu lorsque la réflexion est présente !</p>
        <p>Vous pouvez déposer un dossier en ligne regroupant l’ensemble de votre projet de communication. Nous vous invitons également à faire une vidéo explicative et qui contextualise votre projet et justification vos actions en 5 minutes !</p>
    </fieldset>
    <fieldset id="web">
        <legend>Développement web</legend>
        <p>JS, CMS, HTML, CSS, WORDPRESS et autres ! Peu importe la nature de votre site, application ou maquette, vous pouvez déposer votre oeuvre ! De l’analyse UX/UI au développement back en passant par le front, l’ensemble de vos projets sont les bienvenus ! </p>
        <p>Chaque projet devra être déposé sur la forme d’un lien direct vers le site, l’application ou la maquette (en visionnage uniquement). Vous pouvez accompagner votre production d’une courte vidéo explicative ou illustrant le parcours sur le site, au choix !</p>
    </fieldset>
    <fieldset id="graphique">
        <legend>Production Graphique</legend>
        <p>Laissez votre âme créative s’exprimer ! Emmenez nous dans votre univers graphique en partageant vos productions ! Identité visuelle, simple logo, refonte graphique, infographies diverses et variés, nous acceptons bon nombre de supports pour montrer à quel point les MMI sont talentueux !</p>
        <p>Chaque production devra être accompagnée de visuels ainsi que des fichiers de nature (.psd, .ai …) afin de prouver que les travaux vous appartiennent bien ! Vous pouvez également si vous le souhaitez, faire une vidéo pour expliquer votre production, illustrer ses étapes de construction …</p>
    </fieldset>
    <form action="{{route('participateRead')}}" method="post">
        @csrf
        <div>
            <input type="checkbox" name="read" id="read" value="true" required <?php if(Cookie::has("participate")){ echo "checked";}?>>
            <label for="read">J'ai lu et accepté les modalités de participation.</label>
        </div>
        <button type="submit">participer</button>
    </form>


</div>
@endsection