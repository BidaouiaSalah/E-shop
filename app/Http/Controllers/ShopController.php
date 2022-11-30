<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
    public function home()
    {
        $products =  $products = Product::with('media')
            ->orderBy('price', 'desc')->limit(8)->get();
        $newProducts = Product::with("media")->inRandomOrder()->take(4)->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('pages.home')->with([
            "products" => $products,
            "newProducts" => $newProducts,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slug = request()->query('slug');
        $brand = request()->query('brand');
        $sort = request()->query('sort');

        if ($slug) {
            $products = Product::with('media')->where('slug', $slug)->paginate(8);
        } elseif ($brand) {
            $products = Product::with('media')->where('brand_id', '=', $brand)->paginate(8);
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
            'products' => $products,
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
        dd($reviews);
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

    public function contact()
    {
        return view("pages.contact", [
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    public function contactus(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "name" => "required|max:50",
            "subject" => "required",
            "message" => "required"
        ]);

        $mailData = $request->all();

        Mail::to("bidaouiasalah@gmail.com")->send(new ContactUs($mailData));

        return back()->with([
            "success_message" => "Thank You for your email, We will get back to you ASAP"
        ]);
    }
}
