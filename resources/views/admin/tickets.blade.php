@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection
@section("content")
<section id="tickets">
    <div class="container">
        <h1>Tickets</h1>
        <h2><span>{{$active->total}}</span> personne(s) sur place</h2>
        <form action="{{route('tickets')}}" method="get">
            <div class="search">
            <input type="search" name="search" id="search" placeholder="Rechercher" value="<?php if(isset($_POST["search"])){ echo $_POST["search"];}?>">
        <label for="search"><i class='bx bx-search-alt-2'></i></label></div>
            <div>
            <label for="sort">Trier par:</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="alphabetical" <?php if(!isset($_GET["sort"]) or $_GET["sort"] == "alphabetical"){ echo "selected";}?>>Ordre alphabétique</option>
                <option value="active" <?php if( isset($_GET["sort"]) and $_GET["sort"] == "active"){ echo "selected";}?>>Personnes présentes</option>
                <option value="inactive" <?php if( isset($_GET["sort"]) and $_GET["sort"] == "inactive"){ echo "selected";}?>>Personnes absentes</option>
            </select>
            </div>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nom Prénom</th>
                    <th>Présence</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets AS $ticket)
                <tr>
                    <td>{{$ticket->name}} {{$ticket->surname}}</td>
                    @if($ticket->activated==1)
                    <td><span>Oui</span></td>
                    @else
                    <td>Non</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection