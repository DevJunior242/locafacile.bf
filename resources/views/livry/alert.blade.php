@if (session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
    {{ session("success") }}
</div>
@endif

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
    @foreach ($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif
@if (!auth()->user()->livreur)
<div class="w-full max-w-3xl bg-white p-6 rounded-lg shadow-md mx-auto mb-4">
    <p class="text-sm text-center">
        Vous devrez avoir un compte livreur pour pouvoir accepter une livraison et obtenir votre paiement.
    </p>
    <a href="{{ route('livreurView') }}" class="text-blue-600 underline text-center block">Créer un compte</a>
</div>
@endif
