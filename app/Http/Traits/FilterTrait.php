<?php

namespace App\Http\Traits;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;

trait FilterTrait
{

    public function index()
    {
        $filteredBy = "All";

        $category = request()->query('category');
        $brand = request()->query('brand');
        $sort = request()->query('sort');

        if ($category) {
            $products = Product::with('media')->where('category_id', '=', $category)->paginate(8);
            $filteredBy =  Category::find($category);
        } elseif ($brand) {
            $products = Product::with('media')->where('brand_id', '=', $brand)->paginate(8);
            $filteredBy =   Brand::find($brand);
        } elseif ($sort == 'desc') {
            $products = Product::with('media')
                ->orderBy('price', 'desc')
                ->paginate(8);
        } elseif ($sort == 'asc') {
            $products = Product::with('media')
                ->orderBy('price', 'asc')
                ->paginate(8);
        } else {
            $products = Product::with("media")->paginate(8);
        }

        return view('pages.shop')->with([
            'filteredBy' => $filteredBy,
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    public function productsSearch()
    {
        $query = request()->query("query");

        $searchedProducts = Product::where("slug", "LIKE", "%$query%")
            ->orWhere("name", "LIKE", "%$query%")
            ->orWhere("description", "LIKE", "%$query%")
            ->get();

        if ($searchedProducts) {
            return view("pages.search")->with([
                "searchedProducts" => $searchedProducts,
                "categories" => Category::all(),
                "brands" => Brand::all()
            ]);
        }
        return   back()->with(306);
    }
}
