<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class UpdateCartQuantity extends Component
{
    public $qty;
    public $rowId;
    public $price;

    public function render()
    {
        return view('livewire.update-cart-quantity');
    }

    public function increment($rowId)
    {
        $product = Cart::get($rowId);
        $updatedQty = $product->qty + 1;
        $updatedPrice = $product->price * $updatedQty;

        Cart::update($rowId, [
            'qty' => $updatedQty,
            'price' => $updatedPrice
        ]);

        return redirect()->route("cart.index");
    }

    public function decrement($rowId)
    {
        $product = Cart::get($rowId);
        $updatedQty = $product->qty - 1;
        $updatedPrice = $product->price / $product->qty;

        Cart::update($rowId, [
            'qty' => $updatedQty,
            'price' => $updatedPrice
        ]);

        return redirect()->route("cart.index");
    }
}
