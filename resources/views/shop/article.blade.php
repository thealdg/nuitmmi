@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/article.css')}}">
@endsection
@section("content")
<section id="product">
    <div class="container">
    <div class="name">
    <h1>{{$merch["infos"]->name}}</h1>
    <h2>{{number_format($merch["infos"]->price,2,".","")}} EUR</h2></div>
        <div class="pictures">
            @foreach($merch["images"] as $color => $images)
            <div>
                <button class="leftArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>
                <div id={{$color}} class="imagesGrid">
                    @foreach($images as $image)
                    <div>
                        <img src="{{asset($image)}}" alt="image">
                    </div>
                    @endforeach
                </div>
                <button class="rightArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>
            </div>
            @endforeach
            
        </div>
        <div class="infos">
            <form action="{{route('addCart')}}" method="post">
                @csrf
                <div id="colors">
                    <h3>Couleur</h3><div>
                    @foreach($merch["colors"] as $color)
                    @if($color == $merch["colors"][0])
                    <input type="radio" name="color" id="{{$color}}" value={{$color}} checked >
                    @else
                    <input type="radio" name="color" id="{{$color}}" value={{$color}}>
                    @endif
                    <label for="{{$color}}" class="color" style="background-color: {{$color}}" onclick="showImages('{{$color}}')"></label>
                    @endforeach
                </div></div>
                @if(!is_null($merch["sizes"][0]))
                <div id="sizes">
                    <h3>Taille</h3>
                    @foreach($merch["sizes"] as $size)
                    @if($size == $merch["sizes"][0])
                    <input type="radio" name="size" id="{{$size}}" value="{{$size}}" checked>
                    @else
                    <input type="radio" name="size" id="{{$size}}" value="{{$size}}">
                    @endif

                    <label for="{{$size}}">{{$size}}</label>
                    @endforeach
                </div>
                @else
                <div id="sizes">
                    <h3>Taille</h3>
                    <input type="radio" name="size" value="unique" id="unique" checked>
                    <label for="unique" id="uniqueLabel">Taille Unique</label>
                </div>
                @endif
                <div id="quantity">
                    <h3>Quantité</h3>
                    <input type="number" name="quantity" min="1" max="5" value="1">
                </div>
                <input type="hidden" name="id" value="{{$id}}">
                <button type="submit">Ajouter au panier</button>
            </form>
        </div>
        
    </div>
</section>
<section id="faq">
    <div class="container">
        <div id="arrow">
            <img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche">
        </div>
        <h4>FAQ</h4>
        <div class="question_block hidden">
            <div class="question">
                <p>Que faire si le produit n’est pas à ma taille ?</p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Si vous vous rendez compte d’une erreur sur votre taille lors de votre précommande, n’hésitez pas à nous contacter à merch@lanuitmmi.fr avec la nouvelle taille que vous souhaitez précommander. En cas de constat le jour de l’événement, nous pourrons, sous réserve des stocks disponibles, procéder à un échange de taille.</p>
            </div>
        </div>
        <div class="question_block hidden">
            <div class="question">
                <p>Quelles sont les méthodes de paiement ? </p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Lorsque vous passez une précommande, vous vous engagez à payer cette dernière. Pour cela, il suffit de vous rendre au stand le jour de l’événement et vous pourrez régler votre commande par espèces, carte ou virement bancaire.</p>
            </div>
        </div>
        <div class="question_block hidden">
            <div class="question">
                <p>Comment récupérer ma commande si je suis absent le jour de l’événement ? </p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Si un imprévu vous empêche d’assister à notre soirée, contactez notre équipe pour nous prévenir. Nous mettrons votre commande de côté et vous pourrez la retirer au Bureau des Étudiants après l’avoir payé.</p>
            </div>
        </div>
        <div class="question_block hidden">
            <div class="question">
                <p>Puis-je changer d’avis après avoir passer une commande ? </p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Oui, vous changez d’avis après avoir payé votre t-shirt, vous disposez de 14jours pour retourner le produit. Nous vous rembourserons au prix d’achat uniquement si le produit est de même qualité qu’à l’achat. </p>
            </div>
        </div>
        <div class="question_block hidden">
            <div class="question">
                <p>Pourrais-je acheter des produits directement sur place ?  </p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Oui tout à fait. Si vous ne pouvez ou voulez pas précommander directement sur le site, vous pourrez acheter des produits directement sur place ! Attention, les quantités seront cependant limitées. </p>
            </div>
        </div>
    </div>
</section>
<script>
    var questions = document.getElementsByClassName("question");
    for(i=0;i<questions.length;i++){
        questions[i].addEventListener("click",function(){
            var question = this.parentElement;
            if(question.classList.contains("hidden")){
                question.classList.remove("hidden");
            } else {
                question.classList.add("hidden");
            }
        });
    }
    
    function showImages(color){
        var test = document.getElementById("colors").getElementsByTagName("input");
        for(i=0;i<test.length;i++){
            if(test[i].id==color){
                actualColor = test[i].id;
                test[i].checked = true;
            }
        }
        var images = document.getElementById("product").getElementsByClassName("pictures")[0].getElementsByClassName("imagesGrid");
        for(i=0;i<images.length;i++){
            if(images[i].id==color){
                images[i].parentElement.style.display = "block";
                if(window.innerWidth <= 900){
                    images[i].style.display="flex";
                } else {
                    images[i].style.display="grid";
                }
            } else {
                console.log(images[i].parentElement);
                images[i].parentElement.style.display="none";
            }
        }

    }
    let actualColor = "{{$merch['colors'][0]}}";
    window.onload = showImages(actualColor);
</script>
<script src="{{asset('js/caroussel.js')}}"></script>
<script>
    let responsive = false;
    window.addEventListener("DOMContentLoaded",()=>{
    if(window.innerWidth <= 900){
        carousselStaff(".imagesGrid","div");
        if(!responsive){
            showImages(actualColor);
        }
        responsive = true;
    } else {
        removeCaroussel(".imagesGrid");
        if(responsive){
            showImages(actualColor);
        }
        responsive = false;
    }
    window.addEventListener("resize",()=>{
        if(window.innerWidth <= 900){
            carousselStaff(".imagesGrid","div");
            showImages(actualColor);
            if(!responsive){
            showImages(actualColor);
            }
            responsive = true;
        } else {
            removeCaroussel(".imagesGrid");
            showImages(actualColor);
            if(responsive){
            showImages(actualColor);
            }
            responsive = false;
        }
    })
})
</script>
@endsection
