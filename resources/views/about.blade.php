
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/staff.css')}}">
@endsection
@section("content")
<section id="about">
    <div class="container">
        <h1>Qui sommes-nous ?</h1>
        <p>C’est avec un immense honneur que nous vous présentons la deuxième édition de La Nuit MMI. Cet événement est destiné à toutes les personnes intéressés par le multimédia et l’internet ou ayant un lien avec ce dernier. Fruit d’une réflexion étudiante poussée pour connecter des dizaines de promotions d’étudiants, nous sommes la relève en charge de reprendre ce projet novateur dans le monde étudiant. </p>
        <h2>La soirée du comeback</h2>
        <p>Repassez vos plus beaux habits, bouclez votre agenda car la Nuit MMI est de retour ! Plus ambitieuse, plus innovante, l’événement à ne pas rater revient sur le devant de la scène en s’appuyant sur ses fondations très solides instaurées par la première édition ! Préparez-vous à vivre une expérience renouvelée, de nouvelles opportunités, de nouvelles rencontres, de nouvelles découvertes et de nouvelles activités vous attendent.</p>
        <h2>Notre ambition, votre participation</h2>
        <p>Votre talent est notre priorité ! Cette soirée a pour but de mettre en lumière le talent et le travail des étudiants MMI de Lens. Nous sommes persuadés qu’au fond de chaque étudiant se cache un talent qui ne demande qu’à être exprimé et nous vous en offrons l’opportunité ! Alors n’hésitez plus et déposez votre oeuvre sur notre pour l’exposer et pouvoir échanger dessus avec des professionnels et d’autres étudiants dans un contexte bienveillant.</p>
    </div>
</section>
<section id="staff">

    <div class="container">
        <h1>Notre équipe</h1>
        <div class="category">
        <div id="arrow">
            <img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche">
        </div>
            <h2>Événementiel</h2>
            <div class="cards">
                <div class="card">
                    <img src="{{asset('images/staff/Dos/Logan.png')}}" alt="" class="back">
                    <img src="{{asset('images/staff/Face/Logan.png')}}" alt="" class="front">
                    <div class="infos">
    
                        <h4>Chef de projet et graphiste</h4>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/staff/Dos/Yanis.png')}}" alt="" class="back">
                    <img src="{{asset('images/staff/Face/Yanis.png')}}" alt="" class="front">
                    <div class="infos">
                        
                        <h4>Animateur et chargé de communication</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="category">
            <h2>Administration</h2>
            <div class="cards">
                <div class="card">
                    <img src="{{asset('images/staff/Dos/Thea.png')}}" alt="" class="back">
                    <img src="{{asset('images/staff/Face/Thea.png')}}" alt="" class="front">
                    <div class="infos">
                        
                        <h4>Responsable administratif</h4>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/staff/Dos/Logan.png')}}" alt="" class="back">
                    <img src="{{asset('images/staff/Face/Logan.png')}}" alt="" class="front">
                    <div class="infos">
                        
                        <h4>Trésorier</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="category">
            <h2>Développement</h2>
            <div class="cards">
                <div class="card">
                    <img src="{{asset('images/staff/Dos/May.png')}}" alt="" class="back">
                    <img src="{{asset('images/staff/Face/May.png')}}" alt="" class="front">
                    <div class="infos">
                        
                        <h4>Responsable développement web</h4>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/staff/Dos/Lucas.png')}}" alt="" class="back">
                    <img src="{{asset('images/staff/Face/Lucas.png')}}" alt="" class="front">
                    <div class="infos">
                        
                        <h4>Développeur</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
