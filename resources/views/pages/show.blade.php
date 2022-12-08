@extends('layouts.app')
@section('content')
   <!-- Shop Detail Start -->
   <div class="container-fluid py-5">
      <div class="row px-xl-5">
         <div class="col-lg-5 pb-5">
            <div id="product-carousel"
               class="carousel slide"
               data-ride="carousel">
               <div class="carousel-inner border">
                  <!-- Product image-->
                  @if ($product->media->count() > 0)
                     <div class="carousel-item active">
                        {{ $product->media[0] }}
                     </div>
                  @else
                     <div class="carousel-item active">
                        <img class="w-100 h-100"
                           src="{{ asset('/storage/default.png') }}"
                           alt="Image">
                     </div>
                  @endif
               </div>
               <a class="carousel-control-prev"
                  href="#product-carousel"
                  data-slide="prev">
                  <i class="fa fa-2x fa-angle-left text-dark"></i>
               </a>
               <a class="carousel-control-next"
                  href="#product-carousel"
                  data-slide="next">
                  <i class="fa fa-2x fa-angle-right text-dark"></i>
               </a>
            </div>
         </div>

         <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
            <div class="d-flex mb-3">
               <small class="pt-1">({{ $product->reviews->count() ?? '0' }}
                  Reviews)</small>
            </div>
            <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}</h3>
            <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam
               stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem
               duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at
               lorem et eirmod ipsum diam et rebum kasd rebum.</p>
            <div class="d-flex pt-2">
               <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
               <div class="d-inline-flex">
                  <a class="text-dark px-2"
                     href="">
                     <i class="fab fa-facebook-f"></i>
                  </a>
                  <a class="text-dark px-2"
                     href="">
                     <i class="fab fa-twitter"></i>
                  </a>
                  <a class="text-dark px-2"
                     href="">
                     <i class="fab fa-linkedin-in"></i>
                  </a>
                  <a class="text-dark px-2"
                     href="">
                     <i class="fab fa-pinterest"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="row px-xl-5">
         <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
               <a class="nav-item nav-link active"
                  data-toggle="tab"
                  href="#tab-pane-1">Description</a>
               <a class="nav-item nav-link"
                  data-toggle="tab"
                  href="#tab-pane-2">Reviews ({{ $product->reviews->count() }})</a>
            </div>
            <div class="tab-content">
               <div class="tab-pane fade show active"
                  id="tab-pane-1">
                  <h4 class="mb-3">Product Description</h4>
                  <p>{{ $product->description }}</p>
               </div>
               <div class="tab-pane fade"
                  id="tab-pane-2">
                  <div class="row">
                     <div class="col-md-6">
                        <h4 class="mb-4">Review(s)</h4>
                        @foreach ($product->reviews as $review)
                           @if ($review->status == 1)
                              <div class="media mb-4">
                                 <div class="media-body">
                                    <h6>{{ $review->user->name }}<small> -
                                          <i>{{ $review->created_at }}</i></small></h6>
                                    <p>{{ $review->review }}.
                                    </p>
                                 </div>
                              </div>
                           @endif
                        @endforeach
                     </div>
                     <div class="col-md-6">
                        <form action="{{ route('review.store') }}"
                           method="post">
                           @csrf
                           <h4 class="mb-4">Leave a review</h4>
                           <small>Your email address will not be published. Required fields are marked
                              *</small>
                           <div class="form-group">
                              <label for="message">Your Review *</label>
                              <textarea id="message"
                                 cols="30"
                                 rows="5"
                                 name="review"
                                 class="form-control"></textarea>
                              <input type="hidden"
                                 name="product_id"
                                 value="{{ $product->id }}">
                           </div>
                           <div class="form-group mb-0">
                              <input type="submit"
                                 value="Leave Your Review"
                                 class="btn btn-primary px-3">
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   @if ($relatedProducts->count() > 4)
      @include('partials.related-products', $relatedProducts);
   @endif
@endsection
