<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\FilterTrait;

class ShopController extends Controller
{
    use FilterTrait;

    public function home()
    {
        $products =  $products = Product::with('media')
            ->orderBy('price', 'desc')->limit(8)->get();

        $newProducts = Product::with("media")->inRandomOrder()->take(4)->get();

        return view('pages.home')->with([
            "products" => $products,
            "newProducts" => $newProducts,
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
        $product = Product::with("media")->findOrFail($id);

        $relatedProducts = Product::with('media')->where('id', '!=', $id)
            ->where("slug", "like", "%$product->slug%")
            ->relatedProducts()->get();

        $reviews = Review::where("product_id", "=", $product->id)
            ->where("status", true)->get();

        return view('pages.show', [
            'product' => $product,
            'reviews' => $reviews,
            'relatedProducts' => $relatedProducts,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }
}
