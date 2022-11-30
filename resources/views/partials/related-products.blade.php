<!-- Related items section-->
<section class="py-3 bg-light">
   <div class="container px-4 px-lg-5 mt-5">
      <h2 class="fw-bolder mb-4">Related products</h2>
      <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
         @foreach ($relatedProducts as $relatedProduct)
            <div class="col mb-5">
               <div class="card h-100">
                  <a href="{{ route('shop.show', [$relatedProduct->id]) }}">
                     <!-- Product image-->
                     @if ($product->media[0])
                        {{ $product->media[0] }}
                     @else
                        <img src="{{ asset('/storage/default.png') }}">
                     @endif
                  </a>
                  <!-- Product details-->
                  <div class="card-body p-4">
                     <div class="text-center">
                        <!-- Product name-->
                        <a class="list-group-item-secondary"
                           href="{{ route('shop.show', [$relatedProduct->id]) }}">
                           <h5 class="fw-bolder">{{ $relatedProduct->name }}</h5>
                        </a>
                        <!-- Product price-->
                        ${{ $relatedProduct->price }}
                     </div>
                  </div>
                  <!-- Product actions-->
                  @include('partials.add-product-to-cart-form', [
                      'id' => $relatedProduct->id,
                      'name' => $relatedProduct->name,
                      'price' => $relatedProduct->price,
                      'description' => $relatedProduct->description,
                  ])
               </div>
            </div>
         @endforeach
      </div>
   </div>
</section>
