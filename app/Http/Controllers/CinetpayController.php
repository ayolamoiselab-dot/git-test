<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CinetpayController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Remplacez l'URL ci-dessous par votre URL publique Ngrok
    $ngrokUrl = 'https://6ff8-102-176-254-40.ngrok-free.app'; // Remplacez par votre URL Ngrok

        $data = [
            "amount" => $request->amount, // Le montant à payer
            "currency" => "XOF", // La devise utilisée (FCFA)
            "transaction_id" => uniqid(), // ID de transaction unique
            "description" => "Paiement test avec CinetPay",
            "return_url" => $ngrokUrl . '/cinetpay/success', // URL de retour en cas de succès
            "cancel_url" => $ngrokUrl . '/cinetpay/cancel', // URL de retour en cas d'annulation
            "notify_url" => $ngrokUrl . '/cinetpay/notify', // URL de notification pour les webhooks
            "customer_name" => $request->name, // Le nom du client
            "customer_email" => $request->email, // L'email du client
            "customer_phone_number" => $request->phone, // Le numéro de téléphone du client
            "channels" => "MOBILE_MONEY", // Le canal de paiement utilisé
            "metadata" => json_encode(["user_id" => $request->user()->id]),
            "site_id" => config('services.cinetpay.site_id'), // Ajoutez cette ligne avec votre site_id
        ];

        // Effectuer l'appel API vers CinetPay
        $response = Http::withHeaders([
            'Authorization' => config('services.cinetpay.api_key'),
        ])->post('https://api-checkout.cinetpay.com/v2/payment', $data);
        //dd(config('services.cinetpay.api_key'));
     

        // Récupérer la réponse de l'API
        $result = $response->json();

        // Vérifier si la réponse contient une URL de paiement
        if (isset($result['payment_url'])) {
            return redirect($result['payment_url']); // Redirection vers la page de paiement
        }

        return back()->withErrors('Erreur lors de l’initiation du paiement.');
    }

    // Méthode appelée après succès
    public function paymentSuccess(Request $request)
    {
        // Traitement après succès
        return view('cinetpay.success');
    }

    // Méthode appelée après annulation
    public function paymentCancel(Request $request)
    {
        // Traitement après annulation
        return view('cinetpay.cancel');
    }

    // Méthode appelée par le webhook
    public function paymentNotify(Request $request)
    {
        // Obtenez les données reçues du webhook
        $data = $request->all();
    
        // Vérifier si la notification est authentique avec la clé secrète
        $signature = hash_hmac('sha256', json_encode($data), config('services.cinetpay.secret_key'));
    
        if ($signature === $request->header('Cinetpay-Signature')) {
            // Si la signature est correcte, traiter la transaction
            $transaction_id = $data['transaction_id'];
            $status = $data['status'];
            // Mettre à jour le statut de la transaction dans la base de données
        } else {
            // Si la signature est incorrecte, ignorer la notification
            return response()->json(['error' => 'Signature non valide'], 403);
        }
    }
    

    
}
