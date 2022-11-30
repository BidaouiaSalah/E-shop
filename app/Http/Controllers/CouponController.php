<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{
    public function store(Request $request)
    {
        $coupon = Coupon::where("code", $request->coupon_code)->first();

        if (!$coupon) {
            return redirect()->route("checkout.index")->with([
                "errors" => ["Invelid Coupon code, Please Try Again"],
            ]);
        }

        session()->put('coupon', [
            "code" => $coupon->code,
            "discount" => $coupon->discount(Cart::subtotal()),
        ]);

        return redirect()->route("checkout.index")->with([
            "success_message" => "Coupon has ben applied",
        ]);
    }

    public function destroy()
    {

        session()->forget("coupon");

        return redirect()->route("checkout.index")->with([
            "warning_message" => "coupon has been removed"
        ]);
    }
}
