<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\FilterTrait;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopController extends Controller
{
    use FilterTrait;

    public function home()
    {
        $products =  $products = Product::with('media')
            ->orderBy('price', 'desc')->limit(8)->get();

        $newProducts = Product::with('media')->inRandomOrder()->take(4)->get();

        return view('pages.home')->with([
            'products' => $products,
            'newProducts' => $newProducts,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('media')->findOrFail($id);

        $relatedProducts = Product::with('media')->where('id', '!=', $id)
            ->where('slug', 'like', '%$product->slug%')
            ->relatedProducts()->get();

        $reviews = Review::where('product_id', '=', $product->id)
            ->where('status', true)->get();

        return view('pages.show', [
            'product' => $product,
            'reviews' => $reviews,
            'relatedProducts' => $relatedProducts,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    public function profile()
    {
        $orders = Order::where('user_id', '=', auth()->user()->id)->with('product')->get();
        $favorites = Cart::instance('favorites')->content();
        return view('pages.profile')->with([
            'orders' => $orders,
            'favorites' => $favorites,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }
}
