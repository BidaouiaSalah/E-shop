<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            "review" => "required",
            "product_id" => "required",
        ]);

        if (auth()) {
            $review = new Review;
            $review->review = $request->review;
            $review->user_id = Auth()->user()->id;
            $review->product_id = $request->product_id;
            $review->save();

            return redirect()->route("shop.show", ["shop" => $request->product_id]);
        }

        return redirect()->route("login");
    }
}
