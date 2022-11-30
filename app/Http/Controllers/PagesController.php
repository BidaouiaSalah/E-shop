<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PagesController extends Controller
{
    public function landingPage()
    {
        $products = Product::with("media")->take(8)->get();

        return view("pages.landing-page", compact("products"));
    }

}
