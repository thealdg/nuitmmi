@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/contact.css')}}">
@endsection
@section("content")
<section id="contact">
    <div class="container">
        <h1>Nous contacter</h1>
        <div class="contact_form">
            <form action="index.php?action=contactT" method="post">
                <div>
                    <div class="entry">
                        <label for="name">Nom</label>
                        <input type="text" name="name" placeholder="Votre nom" required id="name">
                    </div>
                    <div class="entry">
                        <label for="surname">Prénom</label>
                        <input type="text" name="surname" placeholder="Votre prénom" required id="surname">
                    </div>
                </div>
                <div class="entry">
                    <label for="email">Adresse mail</label>
                    <input type="email" name="email" placeholder="Votre email" required id="email">
                </div>
                <div class="entry">
                    <label for="message">Message</label>
                    <textarea name="message" placeholder="Votre message" rows="1" id="message"></textarea>
                </div>
                <button type="submit">Valider</button>
            </form>
            <div>
                <div class="contact_info">
                    <div>
                    <b>adresse</b>
                    <p>Département MMI - IUT de Lens<br>
                16 rue de l'Université<br>62300 Lens</p></div>
                    <div><b>email</b>
                    <p>contact@lanuitmmi.fr</p></div>

                </div>
                <div class="contact_info">
                    <div>
                    <b>téléphone</b>
                    <p>06 12 81 75 26</p></div>
                    <div>
                    <b><i class='bx bxl-facebook' ></i> <i class='bx bxl-tiktok' ></i> <i class='bx bxl-instagram' ></i></b>
                    <p style="margin-top: 0rem">lanuitmmi</p></div>
                </div>
                                
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
