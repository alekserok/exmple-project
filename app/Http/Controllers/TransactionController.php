<?php

namespace App\Http\Controllers;

use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class TransactionController extends Controller
{
    public function show($order_id)
    {
        $order = Order::findOrFail($order_id);

        if ($order->stripe_client_secret) return view('transactions.show', compact('order'));

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = PaymentIntent::create([
            'amount' => $order->total * 100,
            'currency' => 'USD'
        ]);

        $order->stripe_client_secret = $intent->client_secret;
        $order->save();

        return view('transactions.show', compact('order'));
    }

    public function purchase(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::find($request->get('order_id'));

        if ($order->paid) return redirect()->back()->withErrors(trans('This order is already paid!'));

        $transaction = Transaction::create([
            'order_id' => $order->id,
            'gateway' => 'PayPal_Rest',
            'currency' => 'USD',
            'amount' => $order->total
        ]);

        $gateway = Omnipay::create('PayPal_Rest'); //todo: select gateway dependent from order
        $gateway->initialize(config('services.' . 'PayPal_Rest')); //todo: select gateway dependent from order

        $purchaseRequest = [
            'amount' => $transaction->amount,
            'currency' => $transaction->currency,
            'cancelUrl' => route('purchase.cancelled', $transaction->id),
            'returnUrl' => route('purchase.completed', $transaction->id),
        ];

        try {
            $response = $gateway->purchase($purchaseRequest)->send();
        } catch (\Throwable $e) {
            $transaction->status = Transaction::STATUS_ERROR;
            $transaction->data = $e->getMessage();
            $transaction->save();

            return redirect()->back()->withErrors($e->getMessage());
        }

        if ($response->isRedirect()) {

            $transaction->status = Transaction::STATUS_PENDING;
            $transaction->save();

            $response->redirect();

        } else if ($response->isSuccessful()) {

            $transaction->status = Transaction::STATUS_COMPLETED;
            $transaction->reference = $response->getTransactionReference();
            $transaction->data = $response->getData();
            $transaction->save();

            return redirect()->back()->with('flash_message', trans('Payment completed successfully!'));
        } else {

            $transaction->status = Transaction::STATUS_ERROR;
            $transaction->data = $response->getData();
            $transaction->save();

            return redirect()->back()->withErrors($response->getMessage());
        }
    }

    public function cancelled(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = Transaction::STATUS_CANCELLED;
        $transaction->data = $request->all();
        $transaction->save();

        return redirect('/transactions/' . $transaction->order_id)->withErrors(trans('Payment has been cancelled'));
    }

    public function completed(Request $request, $id)
    {
        $transaction = Transaction::where([
            ['status', Transaction::STATUS_PENDING], ['id', $id]
        ])->firstOrFail();

        $gateway = Omnipay::create($transaction->gateway);
        $gateway->initialize(config('services.' . $transaction->gateway));

        $response = $gateway->completePurchase([
            'payerId' => $request->get('PayerID'),
            'transactionReference' => $request->get('paymentId'),
        ])->send();

        if ($response->isSuccessful()) {
            $transaction->status = Transaction::STATUS_COMPLETED;
            $transaction->reference = $response->getTransactionReference();
            $transaction->data = $response->getData();
            $transaction->save();

            return redirect('/transactions/' . $transaction->order_id)->with('flash_message', trans('Transaction completed successfully'));
        }

        $transaction->status = Transaction::STATUS_ERROR;
        $transaction->data = $response->getData();
        $transaction->save();

        return redirect('/transactions/' . $transaction->order_id)->withErrors($response->getMessage());
    }

    public function stripeConfirm($order_id, $payment_intent_id)
    {
        $order = Order::findOrFail($order_id);
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $intent = PaymentIntent::retrieve($payment_intent_id);
            $transaction = Transaction::create([
                'order_id' => $order->id,
                'gateway' => 'Stripe',
                'currency' => 'USD',
                'amount' => $order->total,
                'reference' => $intent->id,
                'data' => $intent,
            ]);

        } catch (\Throwable $e) {
            return redirect('/transactions/' . $order_id)->withErrors($e->getMessage());
        }

        if ($intent->status == 'succeeded' && $intent->amount == $order->total * 100) {
            $transaction->status = Transaction::STATUS_COMPLETED;
            $transaction->save();
            return redirect('/transactions/' . $transaction->order_id)->with('flash_message', trans('Transaction completed successfully'));
        } else {
            $transaction->status = Transaction::STATUS_ERROR;
            return redirect('/transactions/' . $order_id)->withErrors('Invalid PaymentIntent Status');
        }

    }
}
