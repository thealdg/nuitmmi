
@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/adminPage.css">
@endsection
@section("content")
<section id="validations">
    <div class="container">
        <h1>Administration</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom du participant</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Compétition</th>
                    <th>Accéder à l'oeuvre</th>
                    <th>Décision</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($validations))
                @foreach($validations as $validation)
                <tr>
                    <td>{{$validation["name"]}}</td>
                    <td>{{$validation["workName"]}}</td>
                    <td>{{$validation["categoryName"]}}</td>
                    <td>{{$validation["email"]}}</td>
                    <td>{{$validation["phone"]}}</td>
                    @if($validation["competition"] == "1")
                    <td>Oui</td>
                    @else
                    <td>Non</td>
                    @endif
                    <td><a href="index.php?action=work&id={{$validation['workId']}}">Voir</a></td>
                    <td><div class="decision">
                                <label for="deny">X</label>
                                <input type="checkbox" id="deny">
                                <div class="deny_form">
                                    <div>
                                        <label for="deny">X</label>
                                        <h2>Rejeter une oeuvre</h2>
                                        <form action="index.php?action=deny&id={{$validation['workId']}}" method="post">
                                            <div class="reasons">
                                                <div>
                                                    <input type="checkbox" name="reasons" id="plagiat" value="Atteinte aux droits d'auteurs">
                                                    <label for="plagiat">Atteinte aux droits d'auteurs</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="reasons" id="respect" value="Non respect des conditions de participation">
                                                    <label for="respect">Non respect des conditions de participation</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="reasons" id="neutral" value="Oeuvre non neutre">
                                                    <label for="neutral">Oeuvre non neutre</label>
                                                </div>
                                            </div>
                                            <textarea name="more_reasons" rows="5" placeholder="Autres raisons"></textarea>
                                            <button type="submit">Rejeter la participation</button>
                                        </form>
                                    </div>
                                </div>
                            <a href="index.php?action=validate&id={{$validation['workId']}}"><i class='bx bx-check'></i></a>
                        </div></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection