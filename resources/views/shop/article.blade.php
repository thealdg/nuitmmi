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
            <div id={{$color}} class="imagesGrid">
                @foreach($images as $image)
                <div>
                    <img src="{{asset($image)}}" alt="image">
                </div>
                @endforeach
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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, iusto?</p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sapiente qui repellendus, est velit id voluptatum facere numquam esse, blanditiis ab, incidunt dignissimos. Eius magnam neque sapiente error eum iure earum laborum vel voluptatibus perspiciatis. Ipsum, accusantium! Exercitationem aliquid nihil, nam maiores ipsam laboriosam consequatur neque impedit, consequuntur repudiandae culpa eveniet, rem voluptates natus magni. Vitae commodi aut sequi ut?</p>
            </div>
        </div>
        <div class="question_block hidden">
            <div class="question">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, iusto?</p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sapiente qui repellendus, est velit id voluptatum facere numquam esse, blanditiis ab, incidunt dignissimos. Eius magnam neque sapiente error eum iure earum laborum vel voluptatibus perspiciatis. Ipsum, accusantium! Exercitationem aliquid nihil, nam maiores ipsam laboriosam consequatur neque impedit, consequuntur repudiandae culpa eveniet, rem voluptates natus magni. Vitae commodi aut sequi ut?</p>
            </div>
        </div>
        <div class="question_block hidden">
            <div class="question">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, iusto?</p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sapiente qui repellendus, est velit id voluptatum facere numquam esse, blanditiis ab, incidunt dignissimos. Eius magnam neque sapiente error eum iure earum laborum vel voluptatibus perspiciatis. Ipsum, accusantium! Exercitationem aliquid nihil, nam maiores ipsam laboriosam consequatur neque impedit, consequuntur repudiandae culpa eveniet, rem voluptates natus magni. Vitae commodi aut sequi ut?</p>
            </div>
        </div>
        <div class="question_block hidden">
            <div class="question">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, iusto?</p>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sapiente qui repellendus, est velit id voluptatum facere numquam esse, blanditiis ab, incidunt dignissimos. Eius magnam neque sapiente error eum iure earum laborum vel voluptatibus perspiciatis. Ipsum, accusantium! Exercitationem aliquid nihil, nam maiores ipsam laboriosam consequatur neque impedit, consequuntur repudiandae culpa eveniet, rem voluptates natus magni. Vitae commodi aut sequi ut?</p>
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
                test[i].checked = true;
            }
        }
        var images = document.getElementById("product").getElementsByClassName("pictures")[0].getElementsByClassName("imagesGrid");
        for(i=0;i<images.length;i++){
            if(images[i].id==color){
                images[i].style.display="grid";
            } else {
                images[i].style.display="none";
            }
        }

    }
    window.onload = showImages("{{$merch['colors'][0]}}");
</script>
@endsection
