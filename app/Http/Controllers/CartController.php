<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relatedProducts = Product::relatedProducts()->get();
        $categories = Category::all();
        $brands = Brand::all();
        $cartItems = Cart::instance("default")->Content();

        return view("pages.cart", compact("relatedProducts", "cartItems", "categories", "brands"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::instance("default")->search(function ($cartItem) use ($request) {
            return $cartItem->id === $request->id;
        });
        if ($duplicates->isNotEmpty()) {
            return  redirect()->route("cart.index")
                ->with(
                    ["warning_message" => "Product is already in your cart",]
                );
        }

        if ($request->has("rowId")) {
            $item = Cart::instance("favorites")->get($request->rowId);
            Cart::instance("favorites")->remove($item->rowId);
        }

        Cart::instance("default")->add([
            "id" => $request->id,
            "name" => $request->name,
            "price" => $request->price,
            "qty" => 1,
            "options" => [
                "description" => $request->description
            ],
        ])->associate('App\Models\Product');

        return redirect()->route("cart.index")
            ->with(["success_message" => "Product Added to cart seccessfully",]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return redirect()->route("cart.index")->with([
            "success_message" => "Item deleted from Your cart successfully"
        ]);
    }
}
