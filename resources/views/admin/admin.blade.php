@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="css/admin.css">
@endsection
@section("content")
<section id="admin">
    <div class="container">
        <h1>Administration</h1>
        <div class="links">
            <a href="index.php?action=admin&page=moderation">Modération</a><a href="index.php?action=admin&page=precommandes">Précommandes</a><a href="index.php?action=admin&page=stocks">Stocks</a>
        </div>
    </div>
</section>
@endsection