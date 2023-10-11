
@extends('layouts.app')
@section("css")
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@section('content')

<section id="home">
    <div id="arrow">
        <img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche">
    </div>
    <div class="container">
        <div class="home_text">
            
            <h1>LA NUIT MMI</h1>
            <h2>Deuxième édition - Lundi 8 janvier 2024</h2>
            <h4>Cérémonie de mise à l'honneur des projets étudiants.</h4>
            <div id="countdown"></div>
            <div class="buttons">
                <a href="{{route('participate')}}" class="cta">participation &nbsp;&rarr;</a>
                <a href="{{route('ticketing')}}" class="cta">réserver &nbsp;&rarr;</a>
            </div>
            
        </div>
        
    </div>
</section>
<section id="door">
    <div></div>
    <div class="scalable">
        <div></div>
        <div><img src="{{asset('images/shapes/arche2.png')}}" alt="Arche">
        <h1>La Nuit MMI revient pour apporter la lumière !</h1></div>
    </div>
    <div></div>

</section>
<section id="about">
    <div class="container">
        <div class="text">
            <h2>L'occasion rêvée de briller !</h2>
            <p>La nuit MMI revient pour sa deuxième édition le mardi 09 janvier 2024. Cette soirée, placée sur le signe de la rencontre et du partage, est le moment parfait pour exposer son travail, développer son réseau de contacts, se retrouver entre passionnés, anciens étudiants… ou tout simplement pour passer un bon moment en profitant de nombreuses activités sur place ! </p>
            <p>Nous vous attendons nombreux pour cette nouvelle édition et nous sommes impatients de vous voir tous sur votre 31 pour illuminer de la plus belle des manières la formation MMI !</p>
            <a href="{{route('about')}}">En savoir plus &nbsp; &rarr;</a>
        </div>
    </div>
</section>
<section id="guests">
    <div class="container">
        <h2>Invités à l'honneur</h2>
        <div class="guests">
            <div class="guest">
                <div class="photo">
                    <img src="https://imgv3.fotor.com/images/slider-image/a-woman-in-a-suit-with-a-white-background.png" alt="">
                    <div class="social_networks">
                        <a href="#"><i class='bx bxl-instagram' ></i></a>
                        <a href="#"><i class='bx bxl-linkedin-square' ></i></a>
                        <a href="#"><i class='bx bx-globe'></i></a>
                    </div>
                </div>
                <h3>machin <br>truc</h3>
                <h4>Analyste financière pour l'entreprise Ubisoft</h4>
            </div>
            <div class="guest">
                <div class="photo">
                    <img src="https://st2.depositphotos.com/1054848/47994/i/450/depositphotos_479948560-stock-photo-portrait-of-handsome-middle-aged.jpg" alt="">
                    <div class="social_networks">
                        <a href="#"><i class='bx bxl-instagram' ></i></a>
                        <a href="#"><i class='bx bxl-linkedin-square' ></i></a>
                        <a href="#"><i class='bx bx-globe'></i></a>
                    </div>
                    <div class="shape"></div>
                </div>
                <h3>bidule <br>chose</h3>
                <h4>Développeur chez Infogrames</h4>
            </div>
            <div class="guest">
                <div class="photo">
                    <img src="https://img.freepik.com/photos-premium/photo-noir-blanc-portrait-profil-attrayant-jeune-femme-elegante-fond-blanc_246930-1775.jpg?w=2000" alt="">
                    <div class="social_networks">
                        <a href="#"><i class='bx bxl-instagram' ></i></a>
                        <a href="#"><i class='bx bxl-linkedin-square' ></i></a>
                        <a href="#"><i class='bx bx-globe'></i></a>
                    </div>
                    <div class="shape"></div>
                </div>
                <h3>Jean <br>Random</h3>
                <h4>Chargée de communication de la mairie de Roubaix</h4>
            </div>      
        </div>
    </div>
</section>
@endsection
<script src="{{asset('js/door.js')}}"></script>
<script>
    var countDownDate = new Date("January 8, 2024 19:00:00").getTime();
    function countDown() {

// Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="countdown"
        document.getElementById("countdown").innerHTML = "<div><h2>" + days + "</h2><h3>jours</h3></div>" + "<div><h2>" + hours + "</h2><h3>heures</h3></div>" + "<div><h2>" + minutes + "</h2><h3>minutes</h3></div>" + "<div><h2>" + seconds + "</h2><h3>secondes</h3></div>";

        // If the count down is finished, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }
    // Update the count down every 1 second
    setInterval(countDown, 1000);
</script>
<script>
    window.addEventListener("DOMContentLoaded",()=>{
        for(let guest of document.querySelectorAll("#guests .photo")){
        console.log("test");
        guest.addEventListener("click",()=>{
            guest.querySelector(".social_networks").style.display = "flex";
            
        })
    }
    })
</script>

