@extends('layout.app')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">


    <div
        class="w-full max-w-2xl p-12 mx-4 text-center transition-all transform bg-white shadow-lg rounded-xl hover:shadow-xl">
        @if (session('success'))
        <div class="alert alert-success" role="alert">

            <span>{{ session("success") }}</span>

        </div>
        @endif

        @if ($errors->any())
        <div class="abg-red-100 text-red-700">
            @foreach ($errors->all() as $error)
            <span>{{ $error }}</span>
            @endforeach
        </div>
        @endif

        <!-- Main Content -->
        <h1 class="mb-6 text-4xl font-extrabold text-green-600">
            Payment link!
        </h1>

        <p class="mb-8 text-xl text-gray-700">
            veuillez proceder au paiement avec paydunya ou fedapay
        </p>
        <div
            class="p-6 sm:p-10 md:p-12 lg:p-16 xl:p-24 mb-8 rounded-2xl bg-blue-50 shadow-sm text-xs  sm:text-sm xl:text-xl md:text-md  lg:text-lg  font-semibold text-blue-800 leading-relaxed">
            <p class="">
                Cette maison est proposée à la vente au prix de
                <strong class="text-blue-900">{{ number_format($sum, 0, ',', ' ') }}&nbsp;F&nbsp;CFA</strong>,
                comprenant un loyer mensuel de
                <strong class="text-blue-900">{{ number_format($publish->prix, 0, ',', ' ') }}&nbsp;F&nbsp;CFA</strong>,
                {{$publish->caution}} mois de caution + {{ $publish->avance }} mois d'avance , ainsi qu'une commission
                équivalente à
                <strong>50&nbsp;%</strong> d’un mois de loyer pour
                <strong class="text-blue-900">Locafacile</strong>.
            </p>

            <p class="">
                Vous bénéficiez ainsi d’un tarif exceptionnel de
                <strong class="text-green-700">{{ number_format($sum, 0, ',', ' ') }}&nbsp;F&nbsp;CFA</strong>
                au lieu de
                <strong class="text-red-600">{{ number_format($getsum, 0, ',', ' ') }}&nbsp;F&nbsp;CFA</strong>.
            </p>

            <p class="mt-4 text-sm sm:text-base text-blue-700">
                En résumé, vous réalisez une économie de
                <strong class="text-green-700">{{ number_format($win, 0, ',', ' ') }}&nbsp;F&nbsp;CFA</strong>
                grâce à <strong>Locafacile</strong>.

            </p>
            <p>La livraison se fera dans les meilleurs delais.</p>

        </div>





        <!-- Back to Home Button -->
        <div class="mt-12">
            <form action="{{ url('payInit/'.$publish->id) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                    class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                    paydunya ({{ number_format($sum, 0, ',', ' ') }}&nbsp;F&nbsp;CFA)

                </button>
            </form>
            <form action="{{ route('FedaPay.pay', $publish) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition">
                    fedapay({{ number_format($sum, 0, ',', ' ') }}&nbsp;F&nbsp;CFA)

                </button>
            </form>
        </div>
    </div>
</div>
@endsection