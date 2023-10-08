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
    <h1>Compétition</h1>
    <div id="general">
        <h2>Conditions générales</h2>
        <p>Challengez-vous entre MMI ou anciens pour tenter de remporter un prix ! Notre compétition a pour but d’élire la meilleure production dans chaque catégorie, aux yeux du jury et du public. De fait, il y aura des vainqueurs et des vaincus ! Mais avant tout, il y aura des personnes qui auront pu saisir l’opportunité de confronter son projet à d’autres afin de voir où ils en sont dans une compétition de niveau pouvant être professionnelle. </p>
        <p>Vous pouvez déposer votre oeuvre et sélectionner la case compétition pour l’inscrire. Chaque catégorie fera l’objet d’une compétition et vous pourrez participer dans toutes les catégories. Néanmoins, vous ne pouvez déposer qu’une oeuvre par personne et par catégorie.</p>
    </div>
    <fieldset id="actuel">
        <legend>MMI actuel</legend>
        <p>Nous organisons une compétition entre l’ensemble des MMI, de la première à la troisième année. Ce challenge, réalisé dans un contexte bienveillant peut se poser un petit défi tant individuel qu’inter-personnel. L’oeuvre vainqueur dans chaque catégorie sera mise en opposition avec les oeuvres vainqueurs des anciens MMI afin d’élire les grands gagnants de la soirée. C’est pour vous, une sympathique opportunité de vous frotter au travail de professionnels actifs.  </p>
        
    </fieldset>
    <fieldset id="anciens">
        <legend>Anciens MMI </legend>
        <p>De retour dans votre IUT après des années, vous retrouvez d’anciens camarades de classe et l’envie de les défier est trop forte pour vous ? Déposez une production dans la catégorie de votre choix pour tenter d’être élu meilleure production des anciens mmi, dans nos quatre catégories ! Les meilleures oeuvres entreront en compétition avec celles de MMI en formation, qui auront envie de vous détrôner !</p>
    </fieldset>
    <fieldset id="anciens_nouveaux">
        <legend>Anciens vs nouveaux</legend>
        <p>C’est l’heure du défi final ! Chaque oeuvre élue se rencontrent pour la dernière fois pour essayer d’être élue comme la plus belle oeuvre de la soirée. Il ne restera que deux oeuvres dans chaque catégorie, qui feront l’objet d’un vote du jury et du public pour élire la plus belle production. </p>
    
    </fieldset>
    <p>N’oubliez jamais que la compétition se déroule dans un contexte bienveillant et respectueux. Voyez la comme un défi sympathique entre groupe d’étudiants et d’anciens. Puisque vous n’avez rien à perdre mais tout à gagner, n’hésitez plus et tenter votre chance !</p>
    @if(url()->previous() == route('participate'))
    <a href="{{route('participate')}}">Revenir à ma participation</a>
    @endif

</div>
@endsection