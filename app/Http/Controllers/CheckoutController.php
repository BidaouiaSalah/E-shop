<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use App\Mail\OrderShipped;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutsRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.checkout")->with([
            "cartContent" => Cart::instance("default")->content(),
            "discount" => $this->getNumbers()->get("discount"),
            "newSubtotal" => $this->getNumbers()->get("newSubtotal"),
            "newTax" => $this->getNumbers()->get("newTax"),
            "newTotal" => $this->getNumbers()->get("newTotal"),
            "categories" => Category::all(),
            "brands" => Brand::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutsRequest $request)
    {

        $contents = Cart::instance("default")->content()->map(function ($item) {
            return $item->model->slug . ',' . $item->qty;
        })->values()->toJson();

        try {
            Stripe::charges()->create([
                'amount' =>  (int)$this->getNumbers()->get("newTotal") / 100,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            $order = $this->addToOrdersTables($request, null);

            Mail::to('bidaouiasalah@gmail.com')->send(new OrderShipped($order));

            Cart::instance('default')->destroy();
            session()->forget("coupon");

            return redirect()->route("thanks")
                ->with("success_message", "Your Order Is Paid Seccessfully");
        } catch (CardErrorException $e) {
            return redirect()->route("shop.index")->withErrors('Error!',  $this->$e->getMessage());
        }
    }

    public function getNumbers()
    {
        $tax = config("cart.tax") / 100;
        $discount = session()->get("coupon")["discount"] ?? 0;
        $newSubtotal =  ((int)Cart::subtotal() -  $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
            "tax" => $tax,
            "dicsount" => $discount,
            "newSubtotal" => $newSubtotal,
            "newTax" => $newTax,
            "newTotal" => $newTotal
        ]);
    }

    public function guestCheckout()
    {
        return view("pages.checkout")->with([
            "cartContent" => Cart::instance("default")->content(),
            "discount" => $this->getNumbers()->get("discount"),
            "newSubtotal" => $this->getNumbers()->get("newSubtotal"),
            "newTax" => $this->getNumbers()->get("newTax"),
            "newTotal" => $this->getNumbers()->get("newTotal"),
            "categories" => Category::all(),
            "brands" => Brand::all(),
        ]);
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $this->getNumbers()->get('discount'),
            'billing_discount_code' => $this->getNumbers()->get('code'),
            'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'billing_tax' => $this->getNumbers()->get('newTax'),
            'billing_total' => $this->getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }
}
