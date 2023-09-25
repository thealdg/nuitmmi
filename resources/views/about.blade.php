
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/staff.css')}}">
@endsection
@section("content")
<section id="about">
    <div class="container">
        <h1>Qui sommes-nous ?</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus nihil amet quos eaque beatae praesentium officiis incidunt id at veniam qui illo deserunt consequuntur vero, quis dicta. Blanditiis, rem porro!</p>
        <h2>Partie 1</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis tenetur dolor mollitia quis blanditiis quia, recusandae modi cumque ipsum assumenda, voluptas libero ea dolorem, neque asperiores vero nulla harum distinctio dolores eaque nostrum delectus at. Exercitationem cum ipsa maiores iusto!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto eaque doloremque veritatis natus vel dolorem nobis, placeat ad autem maxime quibusdam labore saepe, nostrum numquam!</p>
        <h2>Partie2</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed natus at iusto accusantium, ipsam dolore non debitis doloribus quis consectetur quaerat vel. Aspernatur ipsa tempora quasi ratione iusto ullam nisi eligendi.</p>
    </div>
</section>
<section id="staff">
    <div class="container">
        <div class="category">
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
