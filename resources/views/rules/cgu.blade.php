@extends('layout.app')

@section('content')
<x-nav />
<div class="max-w-4xl mx-auto py-12 px-4 mt-12">
    <h1 class="text-xl font-extrabold text-gray-700 mb-2.5">Conditions Générales d’Utilisation</h1>
    <p class="text-zinc-800 font-black text-sm">Bienvenue sur notre plateforme de location de maisons. En utilisant
        notre site, vous acceptez pleinement et entièrement les présentes conditions générales d’utilisation.</p>

 

    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2">1. Objet du site</h1>
        <p>Notre site permet aux utilisateurs de trouver, consulter et réserver des maisons disponibles à la location,
            tout en facilitant la mise en relation avec les propriétaires.</p>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2">2. Accès et inscription</h1>
        <li>Le site est accessible à toute personne souhaitant louer, publier ou livrer un logement.</li>
        <li>Certaines fonctionnalités (publication, réservation, livraison) nécessitent la création d’un compte.</li>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2">3. Accès au site</h1>
        <p>L’accès à certaines fonctionnalités nécessite la création d’un compte. L’utilisateur s’engage à fournir des
            informations exactes.</p>

    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2">4. Publication de maisons (propriétaires)</h1>
        <li>Toute maison publiée est d’abord marquée comme “en attente de vérification”.</li>
        <li>L’équipe se déplace physiquement pour vérifier que le logement existe réellement et est conforme aux informations.</li>
        <li>Tant qu’une maison n’a pas été vérifiée, le propriétaire peut modifier sa publication librement.</li>
        <li>Après vérification, la maison devient disponible à la location.</li>
        <li>En cas de départ du locataire, le propriétaire peut republier la maison directement via son tableau de bord.</li>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2"> 5. Rôle et fonctionnement des livreurs</h1>
        <li>Tout utilisateur inscrit peut devenir livreur via son tableau de bord.</li>
        <li>Lorsqu’un locataire paie pour obtenir les coordonnées d’un logement, celui-ci est ajouté à la liste des livraisons disponibles dans la même ville.</li>
        <li>Les livreurs reçoivent alors une notification (e-mail, notification système ou SMS).</li>
        <li>Une fois la livraison effectuée, le livreur est automatiquement rémunéré.</li>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2"> 6. Sécurité</h1>
        <p>Vos données sont stockées de manière sécurisée et ne sont accessibles qu'aux personnes autorisées.
        </p>

    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2"> 7. Obligations des utilisateurs</h1>
        
            <li>
              Ne pas publier de fausses annonces.
            </li>
            <li>
                 Respecter les lois en vigueur.
            </li>
            <li>
                 Ne pas contourner le système de contact et de paiement du site.
            </li>
        

    </div>
    <div>
        <h1  class="text-xl font-semibold mt-8 mb-2">8. Responsabilités des utilisateurs</h1>
        <li>Les propriétaires sont responsables des informations fournies sur leur maison.</li>
        <li>Les locataires doivent fournir des informations exactes lors de la réservation.</li>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2"> 9. Paiement et services</h1>
        <li>
            Les paiements se font en ligne via PayDunya.
        </li>
        <li> 
            Aucune garantie n’est fournie sur la disponibilité réelle si l’utilisateur ne suit pas le processus complet.
        </li>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2"> 10. Responsabilités</h1>
        <p> Nous ne sommes pas responsables des litiges entre utilisateurs. Le site agit uniquement en tant
            qu’intermédiaire.
        </p>

    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2"> 11. Suspension de compte</h1>
        <p>En cas de non-respect des présentes conditions, nous nous réservons le droit de suspendre ou supprimer un
            compte sans préavis.
        </p>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2">12. Modification</h1>
        <p>
            Ces conditions peuvent être mises à jour à tout moment. L’utilisateur sera informé en cas de changements
            majeurs.
        </p>

    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2">13. Contact</h1>
        <p>Pour toute question, vous pouvez nous contacter <span><a class="text-blue-600 underline" href="{{route('contact') }}">ici</a></span></p>
    </div>


<div class="mt-8">
     <p class="text-lg font-bold">En utilisant notre site, vous acceptez pleinnement et entiérement les présents conditions generales d'utilisation. </p>
</div>

</div>

<div>
    <x-footer />
</div>
@endsection