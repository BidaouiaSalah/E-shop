@extends('layouts.app')
@section('content')
   </div>
   </div>
   </div>
   @include('includes.header', ['pageTitle' => 'Shop'])
   @include('partials.alert-message',['warning_message'])
   <!-- Shop Start --->
   <div class="container-fluid pt-5">
      <!-- Shop Start -->
      <div class="row px-xl-5">
         <!-- Shop Sidebar Start -->
         <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
               <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
               <div
                  class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                  <a href="{{ route('shop.index') }}">
                     <label class="custom-control-label"
                        for="price-all">All Prices</label></a>
               </div>
               <div
                  class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                  <a href="{{ route('shop.index', ['sort' => 'asc']) }}">

                     <label class="custom-control-label"
                        for="price-1">Low - Hight</label></a>
               </div>
               <div
                  class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                  <a href="{{ route('shop.index', ['sort' => 'desc']) }}">
                     <label class="custom-control-label"
                        for="price-2">Hight - Low</label></a>
               </div>
            </div>
            <!-- Price End -->
         </div>
         <!-- Shop Sidebar End -->

         <!-- Shop Product Start -->
         <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
               @foreach ($products as $product)
                  <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                     <div class="card product-item border-0 mb-4">
                        <div
                           class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                           <!-- Product image-->
                           @if ($product->media->count() > 0)
                              {{ $product->media[0] }}
                           @else
                              <img src="{{ asset('/storage/default.png') }}">
                           @endif
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                           <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                           <div class="d-flex justify-content-center">
                              <h6>${{ $product->price }}</h6>
                              <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                           </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                           <a href="{{ route('shop.show', ['shop' => $product->id]) }}"
                              class="btn btn-sm text-dark p-0"><i
                                 class="fas fa-eye text-primary mr-1"></i>View
                              Detail</a>
                           <!-- add product to cart-->
                           <form action="{{ route('cart.store') }}"
                              method="post">
                              @csrf
                              <input type="hidden"
                                 name="id"
                                 value="{{ $product->id }}">
                              <input type="hidden"
                                 name="qty"
                                 value="{{ 1 }}">
                              <input type="hidden"
                                 name="name"
                                 value="{{ $product->name }}">
                              <input type="hidden"
                                 name="description"
                                 value="{{ $product->description }}">
                              <input type="hidden"
                                 name="price"
                                 value="{{ $product->price }}">
                              <button type="submit"
                                 class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To
                                 Cart</button>
                           </form>
                        </div>
                     </div>
                  </div>
               @endforeach
               <div class="col-12">
                  {{ $products->links() }}
               </div>
            </div>
         </div>
         <!-- Shop Product End -->
      </div>
      <!-- Shop End -->
   </div>
   <!-- Shop Start --->
@endsection
