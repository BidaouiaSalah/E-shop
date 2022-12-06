@extends('layouts.app')
@section('content')
   @include('includes.header', ['pageTitle' => 'Profile'])
   </div>
   </div>
   </div>

   <!-- Contact Start -->
   <div class="container-fluid pt-2">
      <div class="text-center mb-5">
         <h2 class="section-title px-5"><span class="px-2">Your Order</span></h2>
      </div>
      <div class="row px-xl-5">
         <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
               <a class="nav-item nav-link active"
                  data-toggle="tab"
                  href="#tab-pane-1">Your Orders</a>
               <a class="nav-item nav-link"
                  data-toggle="tab"
                  href="#tab-pane-2">Products Saved for later</a>
            </div>
            <div class="tab-content">
               <div class="tab-pane fade show active"
                  id="tab-pane-1">
                  <div class="col-lg-12 table-responsive mb-5">
                     <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                           <tr>
                              <th>User</th>
                              <th>Email</th>
                              <th>Name</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>Provinc</th>
                              <th>Postalcode</th>
                              <th><a>Name_on_card</th>
                              <th><a>Discount</th>
                              <th>Discount code</th>
                              <th><a>Total</th>
                              <th><a>Payment Gateway</a></th>
                              <th><a>Shipped</th>
                              <th><a>Error</th>
                           </tr>
                        </thead>
                        <tbody class="align-middle">
                           @foreach ($orders as $order)
                              <tr
                                 class="{{ $order->shipped ? 'order-shipped' : '' }}
                          {{ $order->error ? 'order-error' : '' }}">
                                 <td>{{ Auth()->user()->name }}</td>
                                 <td>{{ $order->billing_email ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_name ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_address ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_city ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_province ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_postalcode ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_name_on_card ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_discount ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_discount_code ?? 'No Infos' }}</td>
                                 <td>{{ $order->billing_total ?? 'No Infos' }}</td>
                                 <td>{{ $order->payment_gateway ?? 'No Infos' }}</td>
                                 <td> {{ $order->shipped }}</td>
                                 <td>{{ $order->error }}</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane fade"
                  id="tab-pane-2">
                  <div class="row">
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
                              @if ($favorites->count() > 0)
                                 @foreach ($favorites as $item)
                                    <tr>
                                       <td class="align-middle"><img src="img/product-1.jpg"
                                             alt=""
                                             style="width: 50px;"> Colorful Stylish Shirt</td>
                                       <td class="align-middle">${{ $item->price }}</td>
                                       <td class="align-middle">
                                          <form
                                             action="{{ route('favorites.destroy', ['favorite' => $item->rowId]) }}"
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
                                             <div
                                                class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center">
                                                   <button type="submit"
                                                      class="btn btn-outline-primary"
                                                      href="#"> <i
                                                         class="fas fa-shopping-cart"></i>
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
         </div>
      </div>
   </div>
   <!-- Contact End -->
@endsection
