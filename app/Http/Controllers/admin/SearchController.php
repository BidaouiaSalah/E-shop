<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required'
        ]);

        $query = $request->input("query");

        $searchedProducts = Product::search($query)->paginate(4);

        return view("admin.pages.search")->with([
            "searchedProducts" => $searchedProducts,
            "categories" => Category::all(),
            "brands" => Brand::all()
        ]);
    }
}
