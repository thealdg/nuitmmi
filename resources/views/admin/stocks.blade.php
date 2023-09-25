@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/admin.css">
@endsection
@section("content")
<section id="preorders">
    <div class="container">
        <h1>Stocks</h1>
        <form action="index.php?action=admin&page=stocks" method="post">
            <div class="search"></div>
            <div>
            <label for="sort">Trier par:</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="alphabetical" <?php if(!isset($_POST["sort"]) or $_POST["sort"] == "alphabetical"){ echo "selected";}?>>Ordre alphabétique</option>
                <option value="increasing" <?php if( isset($_POST["sort"]) and $_POST["sort"] == "increasing"){ echo "selected";}?>>Croissant</option>
                <option value="decreasing" <?php if( isset($_POST["sort"]) and $_POST["sort"] == "decreasing"){ echo "selected";}?>>Décroissant</option>
            </select>
            </div>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Couleur</th>
                    <th>Taille</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks AS $stock)
                <tr>
                    <td>{{$stock["name"]}}</td>
                    <td style="text-transform: capitalize">{{$stock["color"]}}</td>
                    <td>{{$stock["size"]}}</td>
                    <td>{{$stock["sold"]}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection