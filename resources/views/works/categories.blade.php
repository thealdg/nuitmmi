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
                <a href="{{route('category',$category)}}" class="more">Voir tout</a>
                </div>
                @if(count($works) > 1)<button class="leftArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
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
                @if(count($works) > 1)<button class="rightArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
            </div>
            @endforeach
        </div>
        <div id="participation" class="hidden">
            @foreach($competitions as $category => $works)
            <div class="category">
                <div class="categoryName">
                <a href="{{route('category',$category)}}"><h1>{{$category}}  <span> - <?php echo count($works);?> œuvre(s)</span></h1></a>
                <a href="{{route('category',$category)}}" class="more">Voir tout</a>
                </div>
                @if(count($works) > 1)<button class="leftArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
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
                @if(count($works) > 1)<button class="rightArrow"><img src="{{asset('images/shapes/fleche.png')}}" alt="Flèche"></button>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>
<script src="{{asset('js/changeCategory.js')}}"></script>
<script src="{{asset('js/caroussel.js')}}"></script>
<script>
    window.addEventListener("DOMContentLoaded",()=>{
    if(window.innerWidth <= 900){
        carousselStaff(".category .works",".work");
    } else {
        removeCaroussel(".works");
    }
    window.addEventListener("resize",()=>{
        if(window.innerWidth <= 900){
            carousselStaff(".category .works",".work");
        } else {
            removeCaroussel(".works");
    
        }
    })
})
</script>

@endsection