<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\SearchController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\ReviewStatusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [ShopController::class, "home"])->name("home");
Route::get("shop", [ShopController::class, "index"])->name("shop.index");
Route::get("shop/{shop}", [ShopController::class, "show"])->name("shop.show");
Route::get("contact", [ShopController::class, "contact"])->name("contact");
Route::post("contactus", [ShopController::class, "contactus"])->name("contactUs");
Route::get("search", [ShopController::class, "search"])->name("search");

Route::get("guestcheckout", [CheckoutController::class, "guestCheckout"])->name("guestCheckout");
Route::get("checkout", [CheckoutController::class, "index"])->name("checkout.index")
    ->middleware("auth");
Route::post("checkout", [CheckoutController::class, "store"])->name("checkout.store");
Route::get("thanks", function () {
    return view("pages.thanks");
})->name("thanks");


Route::post("cart/favorites", [FavoriteProductController::class, "addTofavoriteProducts"])
    ->name("favorites.store");
Route::get("favorites", [FavoriteProductController::class, "favoriteProducts"])
    ->name("favorites.index");
Route::delete("favorites/{favorite}", [FavoriteProductController::class, "deletefavoriteProduct"])
    ->name("favorites.destroy");

Route::post("coupons", [CouponController::class, "store"])->name("coupon.store");
Route::delete("coupons", [CouponController::class, "destroy"])->name("coupon.destroy");

Route::resource("cart", CartController::class);

Route::post("review/{id}", [ReviewController::class, "store"])->middleware("auth")->name("review.store");

Route::middleware([isAdmin::class, "auth"])->name("admin.")->prefix("/admin")->group(function () {
    Route::resource("categories", CategoriesController::class);
    Route::resource("products", ProductsController::class);
    Route::resource("brands", BrandsController::class);
    Route::resource("orders", OrdersController::class)->except(['store', 'create']);
    Route::resource("reviews", ReviewStatusController::class);

    Route::get("dashboard", [AdminController::class, "index"])
        ->name("dashboard");

    Route::get("search", [SearchController::class, "search"])->name("search");
});

Auth::routes();
