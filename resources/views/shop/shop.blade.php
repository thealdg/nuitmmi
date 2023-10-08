@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/shop.css')}}">
@endsection
@section("content")
<section id="shop">
    <div class="container">
        <h1>Boutique</h1>
        <button class="leftArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>
        <div class="articles">
                <div class="article">
                    <a href="{{route('article',$merch[0]->id)}}">
                        <img src="{{asset('images/products/tshirts/black/3.webp')}}" alt="Avant" class="front">
                        <img src="{{asset('images/products/tshirts/black/2.webp')}}" alt="Avant" class="back">
                    </a>
                </div>
                <div class="article">
                    <a href="{{route('article',$merch[1]->id)}}">
                        <img src="{{asset('images/products/totebags/1.jpg')}}" alt="Avant" class="front">
                        <img src="{{asset('images/products/totebags/3.jpg')}}" alt="Avant" class="back">
                    </a>
                </div>
                <div class="article">
                    <a href="{{route('article',$merch[2]->id)}}">
                        <img src="{{asset('images/products/totebags/1.jpg')}}" alt="Avant" class="front">
                        <img src="{{asset('images/products/totebags/3.jpg')}}" alt="Avant" class="back">
                    </a>
                </div>
        </div>
        <button class="rightArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>
    </div>
</section>
<script src="{{asset('js/caroussel.js')}}"></script>
<script>
    window.addEventListener("DOMContentLoaded",()=>{
    if(window.innerWidth <= 900){
        carousselStaff(".articles",".article");
    } else {
        removeCaroussel(".articles");
    }
    window.addEventListener("resize",()=>{
        if(window.innerWidth <= 900){
            carousselStaff(".articles",".article");
        } else {
            removeCaroussel(".articles");
    
        }
    })
})
</script>
@endsection