@extends('layouts.app')
@section('content')
   @include('includes.header', ['pageTitle' => 'Favorites'])
   </div>
   </div>
   </div>
   @include('partials.alert-message')
   <div class="col-lg-12 table-responsive mb-5">
      <table class="table table-bordered text-center mb-0">
         <thead class="bg-secondary text-dark">
            <tr>
               <th>Products</th>
               <th>Price</th>
               <th>Remove</th>
               <th>Add to Cart</th>
            </tr>
         </thead>
         <tbody class="align-middle">
            @if ($favoriteProducts->count() > 0)
               @foreach ($favoriteProducts as $item)
                  <tr>
                     <td class="align-middle"><img src="img/product-1.jpg"
                           alt=""
                           style="width: 50px;"> Colorful Stylish Shirt</td>
                     <td class="align-middle">${{ $item->price }}</td>
                     <td class="align-middle">
                        <form action="{{ route('favorites.destroy', ['favorite' => $item->rowId]) }}"
                           method="post">
                           @csrf
                           @method('delete')
                           <input type="hidden"
                              name="rowId"
                              value="{{ $item->rowId }}">
                           <button type="submit"
                              class="btn btn-outline-primary">
                              <i class="fa fa-trash"
                                 aria-hidden="true"></i></button>
                        </form>
                     </td>
                     <td>
                        <form action="{{ route('cart.store') }}"
                           method="post">
                           @csrf
                           <input type="hidden"
                              name="rowId"
                              value="{{ $item->rowId }}">
                           <input type="hidden"
                              name="id"
                              value="{{ $item->id }}">
                           <input type="hidden"
                              name="qty"
                              value="{{ $item->qty }}">
                           <input type="hidden"
                              name="name"
                              value="{{ $item->name }}">
                           <input type="hidden"
                              name="price"
                              value="{{ $item->price }}">
                           <input type="hidden"
                              name="description"
                              value="{{ $item->description }}">
                           <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                              <div class="text-center">
                                 <button type="submit"
                                    class="btn btn-outline-primary"
                                    href="#"> <i class="fas fa-shopping-cart"></i>
                                 </button>
                              </div>
                           </div>
                        </form>
                     </td>
                  </tr>
               @endforeach
            @endif
         </tbody>
      </table>
   </div>
   </div>
   </div>
   </div>
@endsection
