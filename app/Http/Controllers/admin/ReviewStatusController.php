<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with(["product", "user"])->paginate(5);

        return view("admin.pages.reviews.index", compact("reviews"));
    }

    public function update(Review $review)
    {
        $review->status = !$review->status;
        $review->save();

        return back()->with([
            "success_message" => "Review status updated Successfully"
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();

        return redirect()->route("admin.reviews.index")->with([
            "success_message" => "review deleted successfully"
        ]);;
    }
}
