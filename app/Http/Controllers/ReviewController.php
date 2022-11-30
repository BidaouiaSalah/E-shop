<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            "review" => "required",
            "id" => "required"
        ]);

        $product = Product::find($request->id);

        $review = new Review;
        $review->review = $request->review;
        $review->user_id = Auth()->user()->id;
        $review->product_id = $request->id;
        $review->save();

        return redirect()->route("shop.show", $product->id);
    }
}
