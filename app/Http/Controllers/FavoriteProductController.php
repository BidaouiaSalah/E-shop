<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class FavoriteProductController extends Controller
{
    public function addTofavoriteProducts(Request $request)
    {
        $duplicates = Cart::instance("favorites")->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });
        if ($duplicates->isNotEmpty()) {
            return  redirect()->route("favorites.index")
                ->with(
                    ["warning_message" => "Product is already in your favorites",]
                );
        }

        $item = Cart::instance("default")->get($request->rowId);
        Cart::instance("default")->remove($item->rowId);

        Cart::instance("favorites")->add([
            "id" => $item->id,
            "name" => $item->name,
            "price" => $item->price,
            "qty" => $item->qty
        ])
            ->associate('App\Models\Product');

        return redirect()->route("favorites.index")->with([
            "success_message" => "Item has been added to your favorites"
        ]);
    }
    public function favoriteProducts()
    {
        $favoriteProducts = Cart::instance("favorites")->content();
        $relatedProducts = Product::relatedProducts()->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view("partials.favorites")->with([
            "relatedProducts" => $relatedProducts,
            "favoriteProducts" => $favoriteProducts,
            "categories" => $categories,
            "brands" => $brands,
            "success_message" => "Product has been saved for later",
        ]);
    }
    public function deletefavoriteProduct($rowId)
    {
        Cart::instance("favorites")->remove($rowId);

        return redirect()->route("favorites.index")->with([
            "warning_message" => "Item deleted from Your Favorites successfully"
        ]);
    }
}
