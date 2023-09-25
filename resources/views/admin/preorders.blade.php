@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/admin.css">
@endsection
@section("content")
<section id="preorders">
    <div class="container">
        <h1>Précommandes</h1>
        <form action="index.php?action=admin&page=precommandes" method="post">
            <div class="search">
            <input type="search" name="search" id="search" placeholder="Rechercher" value="<?php if(isset($_POST["search"])){ echo $_POST["search"];}?>">
        <label for="search"><i class='bx bx-search-alt-2'></i></label></div>
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
                    <th>Nom Prénom</th>
                    <th>Article</th>
                    <th>Couleur</th>
                    <th>Taille</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($preorders AS $preorder)
                <tr>
                    <td>{{$preorder["name"]}} {{$preorder["surname"]}}</td>
                    <td>{{$preorder["productName"]}}</td>
                    <td style="text-transform: capitalize">{{$preorder["color"]}}</td>
                    <td>{{$preorder["size"]}}</td>
                    <td>{{$preorder["quantity"]}}</td>
                    <td><?php echo number_format($preorder["amount"],2,".","");?> EUR</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection