<?php

namespace App\Http\Controllers;

use App\Models\Publish;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
       public function paymentLink(Publish $publish)
    {
         $sum = $publish->montantTotal();
        $getsum = $publish->getSum();
        $win = $this->win($publish->prix);

        return view('payment.payment', compact(
            'publish',
            'sum',
            'getsum',
            'win',

        ));
     }


    protected function getSum(Request $request, $prix)
    {
        if (!is_numeric($prix)) {
            abort(404);
        }
        $avance = (int) $request->avance;
        $caution = (int) $request->caution;
        $frais = ($prix * 1);
        $total = ($avance + $caution) * ($prix + $frais);
        return  $total;
    }
    protected function win($prix)
    {
        if (!is_numeric($prix)) {
            abort(404);
        }

        return ($prix / 2);
    }
}
