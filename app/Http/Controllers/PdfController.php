<?php

namespace App\Http\Controllers;

 
 
use App\Models\Payment;
 

class PdfController extends Controller
{
    public function paymentDunya()
    {

        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $paydunya = Payment::latest()->paginate(8);
        } else {
            $paydunya = Payment::where('user_id', $user->id)

                ->latest()
                ->paginate(8);
        }

        return view('paydunya.dunyaPdf', compact('paydunya'));
    }
    public function facture(Payment $payment)

    {
        $user = auth()->user();
        if (!$payment && (!$user->isOwner() || !$user->isAdmin())) {
            abort(404);
        } else {
            return redirect()->to($payment->receipt_url);
        }
    }
}
