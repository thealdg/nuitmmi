@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/shop.css">
@endsection
@section("content")
<section id="shop">
    <div class="container">
        <div class="articles">
                <div class="article">
                    <a href="{{route('article',$merch[0]->id)}}">
                        <img src="{{asset('images/products/tshirts/black/3.webp')}}" alt="Avant" class="front">
                        <img src="{{asset('images/products/tshirts/black/2.webp')}}" alt="Avant" class="back">
                    </a>
                    <h1>15€</h1>
                </div>
                <div class="article">
                    <a href="{{route('article',$merch[1]->id)}}">
                        <img src="{{asset('images/products/totebags/1.jpg')}}" alt="Avant" class="front">
                        <img src="{{asset('images/products/totebags/3.jpg')}}" alt="Avant" class="back">
                    </a>
                    <h1>10€</h1>
                </div>
        </div>
    </div>
</section>
@endsection