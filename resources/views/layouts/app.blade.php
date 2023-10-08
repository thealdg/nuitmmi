<?php
$headerCategories = DB::select("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuit MMI</title>
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/shapes.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    @yield("css")
</head>
<body>
    <header>
        <nav>
            <a href="/">
                <img src="{{asset('images/logo_white.png')}}" alt="Logo Nuit MMI">
            </a>
            <div class="menu" id="menu">
                <a href="/">Accueil</a>
                @if(session()->has("admin") and session("admin")==true)
                <a href="{{route('admin')}}">Administration</a>
                @endif
                <a href="{{route('about')}}">À propos</a>
                <a href="{{route('shop')}}">Boutique</a>
                <a href="{{route('participate')}}">Participer</a>
                <div class="deroulant">
                    <a href="{{route('works')}}">Vos œuvres <i class='bx bx-chevron-down' ></i></a>
                    <div class="menu_deroulant">
                        @foreach($headerCategories as $headerCategory)
                        <a href="{{route('category',$headerCategory->name)}}">{{$headerCategory->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="menu" id="phoneMenu">
                <div class="deroulant">
                    <a href="{{route('works')}}">Vos œuvres <i class='bx bx-chevron-down' ></i></a>
                    <script>window.addEventListener("DOMContentLoaded",()=>{
                        document.querySelector("#phoneMenu .deroulant > a").addEventListener("click",(e)=>{
                            e.preventDefault();
                            document.querySelector("#phoneMenu .deroulant > a").parentElement.classList.toggle("active");
                        })
                    });</script>
                    <div class="menu_deroulant">
                        @foreach($headerCategories as $headerCategory)
                        <a href="{{route('category',$headerCategory->name)}}">{{$headerCategory->name}}</a>
                        @endforeach
                    </div>
                </div>
                <a href="{{route('shop')}}">Boutique</a>
                <a href="{{route('about')}}">À propos</a>
                <div class="main_links">
                    <a href="{{route('participate')}}">Participer</a>
                    <a href="#">Réserver</a>
                </div>
                <div>
                    <a href="{{route('profil')}}">Mon compte</a>
                </div>
            </div>
            <div class="account">
                 @if(session()->has("cart") and !empty(session("cart")))
                <a href="{{route('cart')}}" id="cart">
                    <img src="{{asset('images/icons/market.png')}}" alt="panier">
                    <div id="count">
                        <?php $total = 0;
                        foreach(session("cart") as $product){
                            $total += $product->quantity;
                        }
                        echo $total;
                        ?>
                    </div></a>
                    @endif
                    <a href="#" class="button">Réserver</a>
                        @if(session()->has('id'))
                        <a href="{{route('profil')}}">
                        @else
                        <a href="{{route('login')}}">
                        @endif
                            @if(session()->has("profilePicture"))
                            <img src="{{asset(session('profilePicture'))}}" alt="Photo de profil">

                            @else
                            <img src="{{asset('images/icons/profile.png')}}" alt="Photo de profil" style="border-radius: 0">
                           
                            @endif</a>
                            <div id="burger" onclick="document.querySelector('header').classList.toggle('active')">
                                <div></div>
                            </div>
            </div>
        </nav>
    </header>
    <main>
      @yield("content")
    </main>
    <footer>
        <div class="container">
            <div class="footer_top">
                <div class="footer_part">
                    <div class="footer_title">
                        <h3>La Nuit MMI</h3>
                        <div class="underline"></div>
                        <a href="{{route('participate')}}?modalites">Modalités</a>
                        <a href="{{route('competition')}}">Compétition</a>
                        <a href="https://www.youtube.com/watch?v=BOHiQL9b2UY">Édition précédente</a>
                    </div>
                </div>
                <div class="footer_part">
                    <div>
                    <div class="footer_title">
                        <h3>Contact</h3>
                        <div class="underline"></div>
                    </div>
                    <div><p><a href="tel:+33612817526"> 06 12 81 75 26  </a></p>
                    <p><a href="mailto:contact@lanuitmmi.fr"> contact@lanuitmmi.fr  </a></p></div>
                    <p><a href="{{route('contact')}}">Contactez-nous</a></p>
                   </div>
                </div>
                <div class="footer_part">
                        <div class="footer_title">
                            <h3>Adresse</h3>
                            <div class="underline"></div>
                            <div>
                                <p>Département MMI - IUT de Lens</p>
                                <p>16 rue de l'Université</p>
                                <p>62300 Lens</p>
                            </div>
                        </div>
</div>
</div>
          <div class="footer_bottom">
                <div class="rs"><a href="#"><i class='bx bxl-facebook'></i></a><a href="#"><i class='bx bxl-instagram' ></i></a><a href="#"><i class='bx bxl-tiktok' ></i></a></div>
                <div class="links"><a href="{{route('press')}}">Espace Presse</a><span>-</span><a href="{{route('legal')}}">Mentions légales</a><span>-</span><a href="{{route('conditions')}}">Conditions d'utilisation</a></div>
                <p><i class='bx bx-copyright' ></i> La Nuit MMI 2023, Tous droits réservés</p>
            </div>
        </div>
    </footer>
</body>
</html>