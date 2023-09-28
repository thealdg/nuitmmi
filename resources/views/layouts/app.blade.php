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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    @yield("css")
</head>
<body>
    @if(session()->has("cart") and !empty(session("cart")))
    <a href="{{route('cart')}}" id="cart">
        <img src="{{asset('images/icons/market.png')}}" alt="panier" style="width: 40px">
        <div id="count">
            <?php $total = 0;
            foreach(session("cart") as $product){
                $total += $product->quantity;
            }
            echo $total;
            ?>
        </div></a>
    @endif
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
            <div class="account">
                    <a href="#" class="button">Réserver</a>
                        @if(session()->has('id'))
                        <a href="{{route('profil')}}">
                        @else
                        <a href="{{route('login')}}">
                        @endif
                            @if(session()->has("profilePicture"))
                            <img src="{{asset(session('profilePicture'))}}" alt="Photo de profil">

                            @else
                            <img src="{{asset('images/icons/profile.png')}}" alt="Photo de profil">
                           
                            @endif</a>
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
                        <a href="index.php?action=legal">Modalités</a>
                        <a href="#">Compétition</a>
                        <a href="#">Édition précédente</a>
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
                <div class="links"><a href="{{route('press')}}">Espace Presse</a><span>-</span><a href="{{route('legal')}}">Mentions légales</a></div>
                <p><i class='bx bx-copyright' ></i> La Nuit MMI 2023, Tous droits réservés</p>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        const navbar = document.querySelector('header');
    window.addEventListener('scroll', function (e) {
      const lastPosition = window.scrollY;
      if (lastPosition > 200) {
        navbar.classList.add('active');
      } else if (navbar.classList.contains('active')) {
        navbar.classList.remove('active');
      } else {
        navbar.classList.remove('active');
      }
    });
    </script>

</body>
</html>