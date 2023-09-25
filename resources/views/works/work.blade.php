
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/work.css')}}">
@endsection
@section("content")
<section id="work">
    <div class="container">
        <div class="category">
            <h1>{{$work->category}}</h1>
            @if($work->competition==1)
            <h2>En compétition</h2>
            @else
            <h2>En exposition</h2>
            @endif
        </div>
        <div class="work">
            <div class="thumbnail">
                <img src="{{asset($work->thumbnail)}}" alt="Miniature">
            </div>
            <div class="infos">
                <h3>{{$work->name}}</h3>
                <h4>par <span>{{$work->authors}}</span> - <span>MMI {{$work->year}}</span> </h4>
                <p>Réalisé en <strong><?php setlocale(LC_TIME, 'fr_FR', "French"); echo strftime("%B %Y",strtotime($work->date));?></strong></p>
                <p><strong>Conditions:</strong> {{$work->context}}</p>
                <p><strong>Logiciels:</strong> {{$work->tools}}</p>
                <p><strong>Démarche:</strong> {{$work->description}}</p>
            </div>
        </div>
    </div>
</section>
<section id="userWorks">
    <div class="container">
        <h1>Découvrez les autres travaux de <span>@if(property_exists($userWorks[0], 'linkedin')) <a href="{{$userWorks[0]->linkedin}}">{{$userWorks[0]->userName}} {{$userWorks[0]->userSurname}}</a>@else {{$userWorks[0]->userName}} {{$userWorks[0]->userSurname}} @endif</span></h1>
        <div class="works">
            @foreach($userWorks as $work)
            <div class="work">
                <h2>{{$work->categoryName}}</h2>
                <a href="{{route('work',[$work->categoryName,$work->id])}}">
                    <img src="{{asset($work->thumbnail)}}" alt="Miniature">
                </a>
                <h3>{{$work->name}}</h3>
                <h4>{{$work->authors}} - MMI {{$work->year}}</h4>
            </div>

            @endforeach

        </div>
    </div>
</section>
<section id="categoryWorks">
    <div class="container">
        <h1>Dans la même catégorie</h1>
        <div class="works">
        @foreach($categoryWorks as $work)
            <div class="work">
            <a href="{{route('work',[$work->categoryName,$work->id])}}">
                    <img src="{{asset($work->thumbnail)}}" alt="Miniature">
                </a>
                <h3>{{$work->name}}</h3>
                <h4>{{$work->authors}} - MMI {{$work->year}}</h4>
            </div>

            @endforeach

        </div>
    </div>
</section>
@endsection
