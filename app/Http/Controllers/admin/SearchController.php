<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query("query");

        $productsSearch = Product::where("slug", "LIKE", "%$query%")->with("user")->get();

        return view("admin.pages.search")->with([
            "productsSearch" => $productsSearch,
            "categories" => Category::all(),
            "brands" => Brand::all()
        ]);
    }
}
