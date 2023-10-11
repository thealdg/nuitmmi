@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/ticketing.css')}}">
@endsection
@section("content")
<section id="ticket">
    <h1>{{$ticket->name}} {{$ticket->surname}}</h1>
</section>
@endsection