@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/ticketing.css')}}">
@endsection
@section("content")
<section id="tickets">
    <div class="container">
        <h1>Billeterie</h1>
        <div class="steps">
            <h2 data-step="reservation">Réservation</h2>
            <span><i class="bx bx-chevron-right"></i></span>
            <h2 data-step="informations">Informations</h2>
            <span><i class="bx bx-chevron-right"></i></span>
            <h2 data-step="validation">Validation</h2>
        </div>
        <form action="#">
            @csrf
            <section id="reservation">
                <p>La Nuit MMI revient pour une nouvelle édition ! La Nuit MMI c'est un événement unique qui regroupe, le temps d'une soirée, de nombreux étudiants en MMI à l'IUT de Lens. Cette soirée, prônant le partage, permet aux plus jeunes étudiants de rencontrer leurs ainés afin d'échanger autour de leurs productions ou encore des perspectives d'avenir dans les salles d'expositions et à travers des activités surprises. </p>
                <p>Rendez-vous à l'IUT de Lens côté département MMI pour passer une nuit inoubliable le 9 janvier 2024 !</p>
                <table>
                    <thead>
                        <tr class="split">
                            <th>Type</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Entrée solo</td>
                            <td>Gratuite</td>
                            <td>
                                <select name="quantity" id="solo_quantity">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="split">
                            <td colspan="3" class="description"><i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse asperiores ut sed totam necessitatibus repellendus?</i></td>
                        </tr>
                        <tr>
                            <td>Entrée duo</td>
                            <td>Gratuite</td>
                            <td>
                                <select name="quantity" id="solo_quantity">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="split">
                            <td colspan="3" class="description"><i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse asperiores ut sed totam necessitatibus repellendus?</i></td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section id="informations">
                <div class="form_section">
                    <h2>Informations personnelles</h2>
                    <label for="surname">Nom</label>
                    <input type="text" name="surname" required placeholder="Votre nom" id="surname">
                    <label for="surname">Prénom</label>
                    <input type="text" name="name" required placeholder="Votre prénom" id="name">
                </div>
                <div class="form_section">
                    <h2>Contact</h2>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required placeholder="Votre email">
                    <label for="phone">Numéro de téléphone <i>(optionnel)</i></label>
                    <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" placeholder="01 02 03 04 05">
                </div>
            </section>
            <section id="validation">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex explicabo rem voluptates! Ea cum aperiam atque esse quia fugit repellendus! Consectetur quisquam unde numquam deserunt? Dolores magnam quia nostrum, sed minus id incidunt cupiditate. Rerum quas doloribus similique cupiditate ullam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima doloribus temporibus consequuntur cumque deleniti consectetur pariatur nostrum quod earum in qui quam porro velit excepturi atque harum necessitatibus, dignissimos perferendis.</p>
                <div>
                    <input type="checkbox" name="conditions" id="conditions" value="true" required>
                    <label for="conditions">J'ai pris connaissance et accepte les conditions de réservation. <span>*</span></label>
                </div>
                <button type="submit">Valider ma réservation</button>
            </section>
            <div>
                <button id="next">Suivant</button>
            </div>
        </form>
        
    </div>
</section>
<script src="{{asset('js/ticketing.js')}}"></script>
@endsection