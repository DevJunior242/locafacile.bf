@extends('layout.app')

@section('content')
<x-nav />

<div class="w-full max-w-4xl mx-auto space-y-4 mt-10 " x-data="{open:null}">
    @foreach ([
    'Comment publier une maison sur le site ?' => 'Connectez-vous, allez dans votre tableau de bord, puis cliquez sur
    "Publier une maison". Remplissez les informations et soumettez.',
    'Est-ce que je peux modifier ma maison après publication ?' => 'oui, vous pouvez modifier les informations de votre
    maison avant qu\'elle ne soit reservée .vous trouverez un button "modifier ma maisondans" votre tableau de bord',
    'Puis-je publier plusieurs maisons ?' => 'oui, vous pouvez publier autant de maison que vous le souhaitez, il n\'ya
    pas de limite.',
    'dois-je payer pour publier ma maison ?' => 'non, la publication est gratuite',
    'Puis-je supprimer ma publication ?' => 'oui, vous pouvez supprimez votre maison avant sa disponibilité.Allez dans
    votre tableau de bord,cliquez sur supprimier',
    'Comment republier une maison si le locataire est parti ?' => 'Allez dans votre tableau de bord, trouvez la maison
    que vous souhaitez republier et cliquez sur "Republier".',
    ' Quand est-ce que je reçois mon argent après le paiement du locataire ?' =>'Le paiement effectué par le locataire
    via PayDunya ne va pas directement au bailleur. Il est d\'abord retenu par la plateforme jusqu\'à la confirmation de
    la livraison et la vérification que la maison est bien occupée. Ensuite, le montant est reversé au propriétaire
    selon les modalités prévues (Mobile Money, virement, etc.).',
    'Pourquoi je ne reçois pas l’argent immédiatement ?' => 'Pour protéger le locataire contre les fausses annonces et garantir que la transaction est réelle. Cela évite les abus et permet une expérience fiable pour tous.',
    ' Qui garde l’argent entre-temps ?' => 'La plateforme reçoit l’argent sur son compte sécurisé PayDunya, en attente de validation (preuve de livraison + confirmation d’occupation de la maison). Le bailleur est payé après validation du processus.',
    'Suis-je averti lorsqu’un locataire réserve ma maison ?' => 'oui, vous serez averti par contact telephonique et par
    mail',
    'Comment suis-je informé que mon paiement est prêt ?' => 'Vous recevez une notification (e-mail/SMS) dès que le locataire a payé, puis une autre quand le paiement vous est transféré.',
    'Comment est effectué le paiement au bailleur ?' => '    Le propriétaire reçoit l’argent via :

    Mobile Money (Orange Money, Moov, etc.)',
    'Et si le locataire annule ou disparaît après paiement ?' =>'Si la livraison n’aboutit pas ou que la maison est inoccupée, la somme peut être remboursée au locataire. Le bailleur ne reçoit rien dans ce cas. Cela évite les fraudes et renforce la confiance.',
    'Est-ce que la plateforme prend une commission ?' => 'La plateforme prélève une commission équivalente à 50% du montant du loyer mensuel lors de la première location.',
    'Et si la maison n’existe pas ou ne correspond pas aux photos ?' => 'Toutes les maisons publiées sont vérifiées sur le terrain par nos agents. Si une anomalie est détectée, vous pouvez demander un remboursement.',
    ' Puis-je annuler ma réservation ?' => 'L’annulation est possible avant la confirmation de la livraison. Si la maison a été validée sur place, le remboursement dépend du cas.',
    'Combien coûte le service ?' => 'Le service est inclus dans le paiement. Aucun frais supplémentaire n’est demandé après. Vous bénéficiez de la livraison gratuite et du support sécurisé.',
    ' Comment payer ?' => 'Vous pouvez payer via paydunya  (Orange Money, Moov).',
    'Est-ce que mes informations sont protégées ?' => 'Oui, toutes vos données personnelles et vos paiements sont sécurisés et jamais partagés sans votre accord.',
    'Comment contacter le service client ?' => 'Vous pouvez nous écrire via WhatsApp, e-mail ou utiliser le formulaire de contact dans l’application.',
    'Combien coûte le service ?' => 'Le service est inclus dans le paiement. Aucun frais supplémentaire n’est demandé après. Vous bénéficiez de la livraison gratuite et du support sécurisé.',
    'Comment devenir livreur ?' => 'Allez dans votre profil et activez l’option "Devenir livreur". Vous commencerez à
    recevoir des missions dans votre ville.',
    'comment obtient-on les frais de livraison ?' => 'vous serez payé par les administrateurs du site une fois la',
    'puise-je accepter une livraison qui n\'est pas dans ma ville ?' => 'non, vous ne pouvez accepter que les livraisons
    dans votre ville.',
    'que se passe-t-il aprés le paiement ? ' => 'vous recevez automatiquement les coordonnées du propriétaire et un
    livreur est notifié pour valider la maison sur le terrain',

    ] as $q => $res)
    <div class="border border-gray-200 rounded">
        <button @click="open === {{ $loop->index }} ? open = null :open = {{ $loop->index }}"
            class="w-full px-4 py-3 text-left font-semibold flex justify-between items-center">
            {{ $q }}
            <svg :class="open === {{ $loop->index }} ? 'rotate-180' : ''" class="w-5 h-5 transition-transform"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open === {{ $loop->index }}" x-collapse class="px-4 py-2 text-gray-700 border-t ">
            {{ $res }}
        </div>
    </div>
    @endforeach
</div>
<div>



    <x-footer />
</div>
@endsection