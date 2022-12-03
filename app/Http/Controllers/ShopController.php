<?php

namespace App\Http\Controllers;

use App\Http\Traits\FilterTrait;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required'
        ]);

        $query = $request->input("query");

        $searchedProducts = Product::search($query)->paginate(4);

        return view("pages.search")->with([
            "searchedProducts" => $searchedProducts,
            "categories" => Category::all(),
            "brands" => Brand::all()
        ]);
    }
}
