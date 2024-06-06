<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $existing_cart = Cart::where('user_id',auth()->user()->id)->first();
        if ($existing_cart) {
            $shoppingCartItems = Cart_Item::with(['product' => function ($query) {
                $query->withTrashed();
            }, 'cart' => function ($query) {
                $query->withTrashed();
            }])
                ->withTrashed()
                ->where('cart_id', $existing_cart->id)
                ->get()
                ->sortByDesc('created_at');
            return view('shoppingcart', compact('shoppingCartItems'));

        }
        else{
            return redirect()->route('dashboard')->with('message', 'Shopping cart is empty');

        }


    }
    public function add(Request $request){
        $existing_cart = Cart::where('user_id',auth()->user()->id)->first();
        //check if cart exists
       if ($existing_cart){
           //check if product is already added to the cart
           $existing_cart_product = Cart_Item::where('product_id', $request->input('product_id'))
               ->where('cart_id', $existing_cart->id)
               ->first();
            if ($existing_cart_product) {
                $existing_cart_product->update([
                    'amount' => $existing_cart_product->amount + $request->input('amount'),

                ]);
            }else {
                //add the new products to the same cart

                $cart_item = new Cart_Item();
                $cart_item->cart_id = $existing_cart->id;
                $cart_item->product_id = $request->input('product_id');
                $cart_item->amount = $request->input('amount');
                $cart_item->save();
            }
       }else{
           // make a new cart and add new product
           $cart = new Cart();
           $cart->user_id = auth()->user()->id;
           $cart->save();

           $cart_item = new Cart_Item();
           $cart_item->cart_id = $cart->id;
           $cart_item->product_id = $request->input('product_id');
           $cart_item->amount = $request->input('amount');
           $cart_item->save();
       }
        return redirect()->route('dashboard')->with('message', 'Succesfully addded to shoppingcart');

    }
    public function update(Request $request)
    {
        dd($request->all());
        $request->validate([
            'amount' => 'required|integer|min=1',
        ]);

        $cartItem = Cart_Item::findOrFail($id);
        $cartItem->amount = $request->input('amount');
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart item updated successfully.');
    }
}
