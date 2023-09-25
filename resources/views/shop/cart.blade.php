@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection
@section("content")
<section id="cart">
    <div class="container">
        <div class="total">
            <div>
                <h1>Panier</h1>
                <h2>
                    <?php
                    $sum = 0;
                        foreach(session("cart") as $article){
                            $sum += $article->quantity*$article->price;
                        }
                    echo $sum;
                    ?>
                    €
                </h2>
            </div>
        </div>
        <div class="products">
            @foreach(session("cart") as $article)
            <div class="product">
                <div class="picture">
                    <?php
                    $image = glob($article->images.'/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE)[0];
                    ?>
                    <img src="{{asset($image)}}" alt="{{$article->name}}">
                </div>
                <div class="infos">
                    <div>
                        <h3>{{$article->name}}</h3>
                        @if(property_exists($article,"size"))
                        <h4>Taille: {{$article->size}}</h4>
                        @endif
                        <h4>Couleur: <span style="text-transform: capitalize">{{$article->color}}</span></h4>
                    </div>
                    <div class="quantity">
                        <a href="">-</a>
                        <h4>Quantité {{$article->quantity}}</h4>
                        <a href="">+</a>
                    </div>
                </div>
                <div class="amount">
                    <div>
                        <h4>Total</h4>
                        <h3>
                            <?php
                            echo $article->quantity*$article->price;
                            ?>
                            €
                        </h3>
                    </div>
                    <a href="">Supprimer</a>
                </div>
            </div>

            @endforeach
        </div>
        <a href="{{route('preorder')}}" class="cta">Précommander</a>
    </div>
</section>
@endsection