<?php

namespace App\Http\Controllers;

use Mail;

use Session;

use Stripe\Charge;

use Stripe\Stripe;

use Cart;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {

        if(Cart::content()->count() == 0)
        {
            Session::flash('info', 'Your cart is still empty, do some shopping');

            return redirect()->back();
        }
        return view('checkout');
    }

    public function pay()
    {
        // dd(request()->all());

        Stripe::setApiKey("sk_test_owvtdEEr0MlDt6Bv48sMGuqL");

        $token = request()->stripeToken;

        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'udemy course practice selling books',
            'source' => request()->stripeToken
        ]);

       // dd('your card was charged successfully.');

        Session::flash('success', 'Purchase successful, wait for our email');

        Cart::destroy();

        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);

        return redirect('/');

    }

}
