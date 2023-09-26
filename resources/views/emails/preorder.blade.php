@extends("emails.template")
@section("content")
<h2 style='font-size: 14px; margin: 30px 0;'>Bonjour {{$infos['name']}} {{$infos["surname"]}}</h2>
    <p style='font-size: 12px; text-align: justify;'>Merci d’avoir précommandé des articles et ainsi soutenir la nouvelle édition de La Nuit MMI !</p>
    <p style='font-size: 12px; text-align: justify;'>Voici les détails de votre commande :</p>
    <div style='margin: 30px 5px; border-top: solid white 1px;'>
    @foreach($cart as $product)
    <div style='display: flex; padding: 10px 0; border-bottom: solid white 1px;'>
        <img src='http://localhost/NuitMMI/<?php echo asset(glob($product["images"].'/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE)[0])?>' alt="{{$product['name']}}" style='width: 25%; height: auto;'>
        <div style='width: 75%; padding: 10px 10px 10px 0;'>
            <div style='display: flex;'>
                <h3 style='font-size: 12px; margin-top: 0; margin-bottom: 5px; width: 60%;'>{{$product["name"]}}</h3>
                <h3 style='font-size: 12px; width: 40%; color: #DAC469; margin: 0; text-align: right; white-space: nowrap;'><?php echo number_format($product["quantity"]*$product["price"],2,".","");?> EUR</h3>
            </div>
            <p style='font-size: 10px; margin: 0;'>Taille: <?php if(isset($product["size"])): echo $product["size"]; else :echo "Unique"; endif;?></p>
            <p style='font-size: 10px; margin: 0;'>Couleur: <span style='text-transform: capitalize'>{{$product["color"]}}</span></p>
            <h4 style='font-size: 11px; text-align: right; margin-bottom: 0; margin-top: 5px;'>Quantité: {{$product["quantity"]}}</h4>
        </div>
    </div>
    @endforeach
    <div style='display: flex; margin: 10px 0;'>
    <h3 style='font-size: 12px; margin: 0; width: 50%;'>Montant total: </h3>
    <h3 style='font-size: 12px; margin: 0; width: 50%; color: #DAC469; text-align: right; white-space: nowrap;'><?php echo number_format($total,2,".","");?> EUR </3>
</div>
</div>
<p style='text-align: justify; font-size: 12px;'>Le retrait des précommandes se fera le jour de l’événement le 8 janvier 2024, un stand sera dédié  aux goodies présents sur le site mais aussi des exclusivités !</p>
<p style='text-align: justify; font-size: 12px;'>Si vous souhaitez annuler votre précommande ou pour tout autre information, écrivez-nous à l’adresse mail <a href='mailto:contact@lanuitmmi.fr' style='color: #DAC469; text-decoration: none'>contact@lanuitmmi.fr</a>.</p>

@endsection