
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection
@section("content")
<section id="validations">
    <div class="container">
        <h1>Modération</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Compétition</th>
                    <th>Accéder</th>
                    <th>Archive</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($validations))
                @foreach($validations as $validation)
                <tr>
                    <td>{{$validation->name}} {{$validation->surname}}</td>
                    <td>{{$validation->workName}}</td>
                    <td>{{$validation->categoryName}}</td>
                    <td>{{$validation->email}}</td>
                    <td>{{$validation->phone}}</td>
                    @if($validation->competition == "1")
                    <td>Oui</td>
                    @else
                    <td>Non</td>
                    @endif
                    <td><a href="{{route('work',[$validation->categoryName,$validation->workId])}}">Voir</a></td>
                    <td><a href="{{url($validation->proof)}}">Télécharger</a></td>
                    <td>@if($validation->result == 1) Validée @elseif($validation->result == 0 && $validation->result != null) Refusée @else En cours @endif</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection