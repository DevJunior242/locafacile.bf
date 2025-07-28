<?php

namespace App\Http\Controllers;

use FedaPay\FedaPay;
use FedaPay\Webhook;
use App\Models\Livry;
use FedaPay\Customer;
use App\Models\Payment;
use App\Models\Publish;
use FedaPay\Transaction;
use Illuminate\Http\Request;
use App\Jobs\UpdatePublishJob;
use Illuminate\Support\Facades\Log;

class FedaPayController extends Controller
{

    /**
     * Handle the FedaPay payment process.
     */

    public function fedaPay(Publish $publish, Request $request)
    {

        Log::info('fedap', $request->all());


        FedaPay::setApiKey('sk_sandbox_trJCwDaE2zFQV7e591sz-SQ2');
        FedaPay::setEnvironment('sandbox');
        /* Créer un client */

        $user  = auth()->user();
        Log::info(
            'user',
            ['user' => $user]
        );

        if (!$user->fedapay_customer_id) {
            $customer = Customer::create(array(
                "firstname" => $user->firstname,
                "lastname" => $user->lastname,
                "email" => $user->email,
                "phone_number" => [
                    "number" => $user->phone,
                    "country" => 'BF'
                ],
            ));
            $user->fedapay_customer_id = $customer->id;
            $user->save();
        } else {
            $customer = Customer::retrieve($user->fedapay_customer_id);
            $customer->firstname =  $user->firstname;
            $customer->lastname  =  $user->lastname;
            $customer->email =  $user->email;
            $customer->phone_number = [
                "number" =>  $user->phone,
                "country" => 'BF'
            ];
            $customer->save();
        }


        //creer un paiement 
        $transaction = Transaction::create([
            'description' => $publish->titre,
            'amount' => $publish->montantTotal(),
            'currency' => ['iso' => 'XOF'],

            'callback_url' => 'https://c7d5fd5ab5e9.ngrok-free.app/fedapay/callback',
            'customer' => ['id' => $customer->id],
            "metadata" => [
                "publish_id" => $publish->id,
                "user_id" => $user->id

            ],
        ]);

        $token = $transaction->generateToken();
        return redirect()->away($token->url);
    }

    //callback 


    public function webhook(Request $request)
    {
        Log::info('webhook', ['raw' => $request->getContent()]);
        // You can find your endpoint's secret key in your webhook settings
        $endpoint_secret = 'wh_sandbox_jf_vRY2FZPN3sEu_izG5Kea6';

        $payload = $request->getContent();
        $data = json_decode($payload, true);
        Log::info('payload', $data);

        $sig_header = $request->header('X-FEDAPAY-SIGNATURE');
        $event = null;
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
            Log::info(
                'event',
                ['raw' => $event]
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload

            return response()->json(['error' => 'invalid json format'], 400);
        } catch (\FedaPay\Error\SignatureVerification $e) {
            // Invalid signature

            return response()->json(['error' => 'invalid signature'], 400);
        }

        // Handle the event
        //$transaction = event->data->object;
        switch ($event->name) {
            case 'transaction.created':
  
                UpdatePublishJob::dispatch($event, 'in_progress');
                break;
            case 'transaction.approved':
                UpdatePublishJob::dispatch($event, 'occupé');
                 
               
                break;
            case 'transaction.canceled':
                UpdatePublishJob::dispatch($event, 'disponible');
                break;
            default:
                return response()->json(['error' => 'error webhook'], 400);
        }

        return response()->json(['success' => true], 200);
    }

    public function callback(request $request)
    {
        $status = $request->query('status');
        if ($status == 'approved') {
            return view('fedapay.success');
        } elseif ($status == 'canceled') {
            return view('fedapay.canceled');
        }
        return view('fedapay.error');
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
