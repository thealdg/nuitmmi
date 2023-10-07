@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/categories.css')}}">
@endsection
@section("content")
<section id="categories">

    <div class="container">
        <div class="switch">
            <h3 class="current" onclick="exposition()" id="select_exposition">En exposition</h3>
            <h3 onclick="participation()" id="select_competition">En compétition</h3>
        </div>
        <div id="exposition">
            @foreach($categories as $category => $works)
            <div class="category">
                <div class="categoryName">
                <a href="{{route('category',$category)}}"><h1>{{$category}}  <span> - <?php echo count($works);?> œuvre(s)</span></h1></a>
                </div>
                <div class="works">
                    @foreach($works as $work)
                    <div class="work">
                        <a href="{{route('work',[$category,$work->id])}}">
                            <img src="{{asset($work->thumbnail)}}" alt="Miniature">
                        </a>
                        <div>
                        <h3>{{$work->name}}</h3>
                        <h4>{{$work->authors}} - MMI {{$work->year}}</h4></div>
                    </div>

                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        <div id="participation" class="hidden">
            @foreach($competitions as $category => $works)
            <div class="category">
                <div class="categoryName">
                <a href="{{route('category',$category)}}"><h1>{{$category}}  <span> - <?php echo count($works);?> œuvre(s)</span></h1></a>
                </div>
                <div class="works">
                    @foreach($works as $work)
                    <div class="work">
                        <a href="{{route('work',[$category,$work->id])}}">
                            <img src="{{asset($work->thumbnail)}}" alt="Miniature">
                        </a>
                        <div>
                        <h3>{{$work->name}}</h3>
                        <h4>{{$work->authors}} - MMI {{$work->year}}</h4></div>
                    </div>

                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script src="{{asset('js/changeCategory.js')}}"></script>
@endsection