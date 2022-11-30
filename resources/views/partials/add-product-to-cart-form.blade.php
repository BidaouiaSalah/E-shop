   <!-- Product actions-->
   <form action="{{ route('cart.store') }}"
      method="post">
      @csrf
      <input type="hidden"
         name="id"
         value="{{ $id }}">
      <input type="hidden"
         name="qty"
         value="{{1}}">
      <input type="hidden"
         name="name"
         value="{{ $name }}">
      <input type="hidden"
         name="description"
         value="{{ $description }}">
      <input type="hidden"
         name="price"
         value="{{ $price }}">
      <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
         <div class="text-center">
            <button type="submit"
               class="btn btn-outline-dark mt-auto"
               href="#">Add to cart</button>
         </div>
      </div>
   </form>
