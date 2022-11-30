<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('media')->paginate(8);

        return view("admin.pages.products.index")->with([
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view("admin.pages.products.create")->with([
            "categories" => $categories,
            "brands" => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {

        if ($request->hasfile('images')) {
            $newProduct = Product::create($request->validated());

            foreach ($request->file('images') as $image) {
                $newProduct->addMedia($image)->toMediaCollection('product');
            }
        }

        return redirect()->route("admin.products.index")->with([
            "success_message" => "Product created successfully"
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view("admin.pages.products.edit")->with([
            "categories" => $categories,
            "brands" => $brands,
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, $id)
    {
        $updatedProduct = Product::find($id);

        $updatedProduct->name = $request->name;
        $updatedProduct->slug = $request->slug;
        $updatedProduct->description = $request->description;
        $updatedProduct->price = $request->price;
        $updatedProduct->stock = $request->stock;
        $updatedProduct->category_id = $request->category_id;
        $updatedProduct->brand_id = $request->brand_id;
        $updatedProduct->save();

        if ($request->hasFile("images")) {
            foreach ($request->file('images') as $image) {
                $updatedProduct->addMedia($image)
                    ->toMediaCollection('products');
            }
        }
        return redirect()->route("admin.products.index")->with([
            "success_message" => "Product updated successfully"
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
        $product = Product::find($id);
        $product->delete();

        return redirect()->route("admin.products.index")->with([
            "success_message" => "Product deleted successfully"
        ]);;
    }
}
