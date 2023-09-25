@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/category.css')}}">
@endsection
@section("content")
@if(empty($category))
<section id="title" class="empty">
    <div class="container">
        <h1>Aucune œuvre n'est pour l'instant exposée.</h1>
        <h2>Revenez plus tard, ou <span><a href="index.php?action=participate">tentez d'exposer la vôtre</a></span>.</h2>
    </div>
</section>
@else
<section id="title">
    <div class="container">
        <div class="category_title">
        <h1>{{$category[0]->categoryName}}</h1>
        <h2 id="count_exposition"><span>{{count($category)}}</span> œuvre(s)</h2>
        <h2 id="count_participation" class="hidden"><span>{{count($participation)}}</span> œuvre(s)</h2></div>
        <div class="switch">
            <h3 class="current" onclick="exposition()" id="select_exposition">En exposition</h3>
            <h3 onclick="participation()" id="select_competition">En compétition</h3>
        </div>
    </div>
</section>
<section id="works">
    
    <div class="container" id="exposition">
        
        @foreach($category as $work)
        <div class="work">
            <a href="{{route('work',[$work->categoryName,$work->id])}}"><img src="{{asset($work->thumbnail)}}" alt="Miniature"></a>
            <div>
                <h4>{{$work->workName}}</h4>
                <div>
                    <p class="name">{{$work->authors}} - MMI {{$work->year}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container hidden" id="participation">
        @foreach($participation as $work)
        <div class="work">
            <a href="{{route('work',[$work->categoryName,$work->id])}}"><img src="{{asset($work->thumbnail)}}" alt="Miniature"></a>
            <div>
                <h4>{{$work->workName}}</h4>
                <div>
                    <p class="name">{{$work->authors}} - MMI {{$work->year}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<script src="{{asset('js/changeCategory.js')}}"></script>
@endif
@endsection