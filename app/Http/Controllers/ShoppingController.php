<?php

namespace App\Http\Controllers;

use Session;

use App\Product;

use Cart;

use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function add_to_cart()
    {
       // dd(request()->all());

        $pdt = Product::find(request()->pdt_id);

        $cartItem = Cart::add([

            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => request()->qty,
            'price' => $pdt->price

        ]);

        //associating the cart with a model-database

        Cart::associate($cartItem->rowId, 'App\Product');

        //dd(Cart::content());

        Session::flash('success', 'Item added');

        return redirect()->route('cart');

    }

    public function cart()
    {
        //Cart::destroy();

        return view('cart');

    }
    public function cart_delete($id)
    {
        Cart::remove($id);

        Session::flash('success', 'Item deleted');

        return redirect()->back();

    }

    public function decr($id, $qty)
    {
        Cart::update($id, $qty - 1);

        Session::flash('success', 'Product quantity updated');

        return redirect()->back();
    }

    public function incr($id, $qty)
    {
        Cart::update($id, $qty + 1);

        Session::flash('success', 'Product quantity updated');

        return redirect()->back();
    }

    public function rapid_add($id)
    {
        $pdt = Product::find($id);

        $cartItem = Cart::add([

            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => 1,
            'price' => $pdt->price

        ]);

        Cart::associate($cartItem->rowId, 'App\Product');

        Session::flash('success', 'Item added');

        return redirect()->route('cart');

    }

}
