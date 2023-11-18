<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function merchantcoin()
    {
        $apiKey = 'RPXQYRB-993M5J9-HAAVYF0-5PKRTGV';
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
        ])->get('https://api.nowpayments.io/v1/merchant/coins');

        // Assuming you want to get the response body as a string
        dd($response->body());
    }

    public function createpayement()
    {
        $apiKey = 'RPXQYRB-993M5J9-HAAVYF0-5PKRTGV';
        // create payement

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.nowpayments.io/v1/payment', [
            'price_amount' => 3.5,
            'price_currency' => 'usd',
            'pay_currency' => 'usdttrc20',
            'ipn_callback_url' => 'https://nowpayments.io',
            'order_id' => 'RGDBP-21314',
            'order_description' => 'Apple Macbook Pro 2019 x 1',
        ]);

        // Assuming you want to get the response body as a string
        dd($response->body());
    }



    public function createaninvoice()
    {
        $apiKey = 'RPXQYRB-993M5J9-HAAVYF0-5PKRTGV';

        // create an invoice
        // use this one is the best
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.nowpayments.io/v1/invoice', [
            'price_amount' => 3.5,
            'price_currency' => 'usd',
            'order_id' => 'RGDBP-21314',
            'order_description' => 'Apple Macbook Pro 2019 x 1',
            'ipn_callback_url' => 'https://nowpayments.io',
            'success_url' => 'https://nowpayments.io',
            'cancel_url' => 'https://nowpayments.io',
        ]);
        $responseData = $response->json();

        // Check if the response indicates success
        if ($response->successful()) {
            $invoiceUrl = $responseData['invoice_url'];
            return Redirect::to($invoiceUrl);
        } else {
            // Handle the error, e.g., display a message to the user
            $errorMessage = $responseData['message'] ?? 'Unknown error';
            return response()->json(['error' => $errorMessage], $response->status());
        }

        // Assuming you want to get the response body as a string

        dd($response->body());
    }



    public function getinvoicebyinvoiceIdandpurchaseId()
    {
        $apiKey = 'RPXQYRB-993M5J9-HAAVYF0-5PKRTGV';

        //get invoice by invoiceId and purchaseId
        $invoiceId = '5933041451'; //get from the invoice id
        $purchaseId = '5933041451';  //once the payment is made

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.nowpayments.io/v1/invoice-payment', [
            'iid' => $invoiceId,
            'pay_currency' => 'btc',
            'purchase_id' => $purchaseId,
            'order_description' => 'Apple Macbook Pro 2019 x 1',
            'customer_email' => 'test@gmail.com',
            'payout_address' => '3Pj5k1NVyYTmXuqie61DnXaoLkH7jF6aAF',
            'payout_extra_id' => null,
            'payout_currency' => 'usdttrc20',
        ]);

        // Assuming you want to get the response body as a string

        dd($response->body());
    }




    public function getpaymentstatus()
    {
        $apiKey = 'RPXQYRB-993M5J9-HAAVYF0-5PKRTGV';

        // get payment status
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
        ])->get('https://api.nowpayments.io/v1/payment/5226310824');

        // Assuming you want to get the response body as a string

        dd($response->body());
    }




    public function minamount()
    {
        $headers = [
            'x-api-key' => 'RPXQYRB-993M5J9-HAAVYF0-5PKRTGV',

        ];
        $response = Http::withHeaders($headers)->get('https://api.nowpayments.io/v1/min-amount', [
            'currency_from' => 'btc',
            'currency_to' => 'eth',
            'fiat_equivalent' => 'usd',
        ]);

        // Output the entire response for debugging
        dd($response->json());

        // Assuming you want to get the response body as a JSON array
        $responseData = $response->json();

        // Access the necessary data from the response
        $minAmount = $responseData['min_amount'] ?? null;
        echo $minAmount;
    }
}
