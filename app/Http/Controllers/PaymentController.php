<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Donation $donation)
    {
        $request->validate([
            'nominal' => 'required|numeric|integer|min:10000'
        ]);

        $params = [
            'transaction_details' => [
                // 'order_id' => 'donation-' . explode('@', Auth::user()->email)[0] . '-' . now(),
                'order_id' => 'donation-' . explode('@', Auth::user()->email)[0] . '-' . Str::uuid(),
                'gross_amount' => $request->nominal
            ],
            'item_details' => [
                [
                    'price' => $request->nominal,
                    'quantity' => 1,
                    'name' => $donation->title
                ]
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'enabled_payments' => ['credit_card', 'bri_va', 'bni_va', 'bca_va', "gopay", "indomaret", "danamon_online", "akulaku", "shopeepay", "kredivo", "uob_ezpay", "other_qris"],

            'callbacks' => [
            'finish' => env('APP_URL') . '/payment/finish',
            'unfinish' => env('APP_URL') . '/payment/unfinish',
            'error' => env('APP_URL') . '/payment/error',
    ]
        ];

        $auth = base64_encode(env('MIDTRANS_SERVER_KEY') . ':');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth"
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $response = json_decode($response->body());

        // dd($response);

        // save to db
        Payment::create([
            'user_id' => Auth::user()->id,
            'donation_id' => $donation->id,
            'order_id' => $params['transaction_details']['order_id'],
            'status' => 'pending',
            'nominal' => $request->nominal,
            'checkout_link' => $response->redirect_url
        ]);

        return redirect($response->redirect_url);
    }


    public function webhook(Request $request)
    {
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY') . ':');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/$request->order_id/status");

        $response = json_decode($response->body());

        $payment = Payment::where('order_id', $request->order_id)->firstOrFail();

        if ($payment->status == 'capture' || $payment->status == 'settlement') {
            return response()->json([
                'message' => 'payment has been already processed'
            ]);
        }

        if ($response->transaction_status == 'capture') {
            $payment->status = 'capture';
        } else if ($response->transaction_status == 'settlement') {
            $payment->status = 'settlement';
        } else if ($response->transaction_status == 'pending') {
            $payment->status = 'pending';
        } else if ($response->transaction_status == 'deny') {
            $payment->status = 'deny';
        } else if ($response->transaction_status == 'expire') {
            $payment->status = 'expire';
        } else if ($response->transaction_status == 'cancel') {
            $payment->status = 'cancel';
        }
        $payment->save();
        return response()->json(['message' => 'success']);
    }

    public function finishTransaction(Request $request)
    {
        // return view('transactions.finish');

        $order_id = $request->order_id;
        $status = $request->transaction_status;
        
        return view('transactions.finish', compact('order_id', 'status'));
    }
    public function unfinishTransaction(Request $request)
    {
        return view('transactions.unfinish');
    }
    public function errorTransaction(Request $request)
    {
        return view('transactions.error');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
