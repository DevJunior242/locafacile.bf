<?php

namespace App\Http\Controllers;


use Exception;
use Paydunya\Setup;
use App\Models\Livry;
use App\Jobs\NotifJob;
use App\Models\Livreur;
use App\Models\Payment;

use App\Models\Publish;

use Illuminate\Http\Request;
use Paydunya\Checkout\Store;
use Illuminate\Support\Facades\Log;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LivraisonNotification;

class PayDunyaController extends Controller
{


    public function __construct()
    {
        Setup::setMasterKey('8b7RbIG7-NeZH-g2T9-ioNZ-oIzDTnP4LsYA');
        Setup::setPrivateKey('test_private_ZCqh1niSBNi8odnC7odyLgnpDqU');
        Setup::setPublicKey('test_public_rhMnoHxseCCoHZJIyENVtZLfLId');
        Setup::setToken('sTCWVwXJHqedvp7WNQCd');
        Setup::setMode('test');


        Store::setName(config('paydunya.store.name'));
        Store::setTagline(config('paydunya.store.tagline'));
        Store::setPhoneNumber(config('paydunya.store.phone'));
        Store::setPostalAddress(config('paydunya.store.address'));
        Store::setWebsiteUrl(config('paydunya.store.website'));
        Store::setLogoUrl(config('paydunya.store.logo_url'));
    }



    public function createInvoice(Publish $publish)
    {


        $user = auth()->user();
        if (!($user->isAdmin() || $user->isLocataire())) {
            return redirect()->back()->withErrors([
                'error' => 'Reservé aux utilisateurs locataires.'
            ]);
        }
        try {

            $amount = $publish->montantTotal();

            $invoice = new \Paydunya\Checkout\CheckoutInvoice();


            $invoice->addItem($publish->titre, 1, $amount, $amount, $publish->description);
            $invoice->setTotalAmount($amount);
            $invoice->setCancelUrl(route('paydunya.cancel', ['publish' => $publish]));
            $invoice->setCallbackUrl('https://0c2d2fbd12c1.ngrok-free.app/pay/callback');
            $invoice->setReturnUrl(route('paydunya.success'));

            $userId = Auth::id();
            $pubId =  $publish->id;


            $invoice->addCustomData('user_id', $userId);
            $invoice->addCustomData('publish_id', $pubId);

            Log::info('paydunya invoice create', [
                'user_id' => $userId,
                'publish_id' => $pubId,

            ]);


            if (!$invoice->create()) {

                //log the error
                Log::error('paydunya invoice creation failed', [
                    'user_id' => $userId,
                    'publish_id' => $pubId,
                    'code' => $invoice->response_code,
                    'message' => $invoice->response_text,
                ]);

                return back()->withErrors(
                    [
                        'error' => $invoice->response_text,
                    ]
                );
            }

            $publish->update(['status' => 'in_progress']);

            return redirect()->away($invoice->getInvoiceUrl());
        } catch (\Exception $e) {
            Log::error('paydunya error:' . $e->getMessage());
            return to_route('paydunya.cancel');
        }
    }

    //ipn callback
    public function handleIpn(Request $request)
    {


        try {

            Log::info('Callback PayDunya reçu', $request->all());
            $data = $request->data;
            //verifier la signature du paiement
            if (!is_array($data)) {
                Log::error(
                    'invalid array json',
                    [
                        'raw' => $request->getContent(),
                    ]
                );
                return response()->json([
                    'error' => 'invalid json format'
                ], 400);
            }

            if (!isset($data['hash']) || !isset($data['invoice']['token'])) {
                Log::error(
                    'missing token or hash',
                    [
                        'data' => $data,
                    ]
                );
                return response()->json(['error' => 'Missing token or hash'], 400);
            }





            $myhash = hash('sha512', '8b7RbIG7-NeZH-g2T9-ioNZ-oIzDTnP4LsYA');





            if ($data['hash'] !== $myhash) {
                Log::error(
                    'paydunya callback error: invalide hash',
                    [
                        'hash' => $data['hash'],
                        'myhash' => $myhash,
                        'data' => $data,
                    ]
                );
                return response()->json(['error' => 'unauthorized'], 403);
            }

            //verifier le statut de la transaction 

            if (!isset($data['status']) || $data['status'] !== 'completed') {
                Log::error(
                    'transaction not completed',
                    [
                        'data' => $data,
                    ]
                );
                return response()->json(['error' => 'transaction not completed'], 400);
            }


            $invoice = new \Paydunya\Checkout\CheckoutInvoice();


            if ($invoice->confirm($data['invoice']['token'])) {

                $paiement = Payment::updateOrcreate(

                    [
                        'user_id' => $data['custom_data']['user_id'],
                        'publish_id' => $data['custom_data']['publish_id'],
                        'payment_status' => $data['status'],
                        'amount' => $data['invoice']['total_amount'],
                        'customer_name' => $data['customer']['name'],
                        'customer_email' => $data['customer']['email'],
                        'customer_phone' => $data['customer']['phone'],
                        'receipt_url' => $data['receipt_url'],
                    ]
                );
                Log::info(
                    'paiement created',
                    ['paiement' => $paiement->toArray()]
                );
                $publish = $paiement->publish;
                $publish->update([
                    'status' => 'occupee'
                ]);
                //creer des livraisons

                Livry::create([
                    'user_id' => $data['custom_data']['user_id'],
                    'publish_id' => $paiement->publish->id,
                    'status' => 'en attente',
                    'ville' => $paiement->publish->ville,
                    'phone' => $paiement->user->phone,
                    'quartier' => $paiement->publish->quartier

                ]);

                //envoyer une notif  aux livreurs
                NotifJob::dispatch($publish);
          
            }
        } catch (Exception $e) {
            Log::error('paydunya ipn erro:' . $e->getMessage());
            return response()->json(['error' => 'Internal serveur error']);
        }
    }



    //success payment

    public function paymentSuccess(Request $request)
    {


        $token = $request->get('token');

        if (!$token) return abort(404);

        $invoice = new \Paydunya\Checkout\CheckoutInvoice();


        if ($invoice->confirm($token)) {

            return view('paydunya.success');
        }

        return to_route('paydunya.cancel')
            ->withErrors([
                'error' => 'erreur lors de la confirmation du paiement. veuillez reessayer plus tard.',
            ]);
    }

    //cancel payment
    public function paymentCancel(Publish $publish)
    {
        //update the status publish  with data reques
        if (!$publish->isDisponible()) return abort(403);
        $publish->update([
            'status' => 'disponible'
        ]);
        return view('paydunya.cancel');
    }

    
}
