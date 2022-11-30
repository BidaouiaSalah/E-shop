@extends('layouts.app')
@section('content')
   @include('includes.header', ['pageTitle' => 'Search Results'])
   </div>
   </div>
   </div>
   <!-- Cart Start -->
   <div class="container-fluid pt-5">
      @include('partials.alert-message')

      @if ($searchedProducts->isEmpty())
         <h4 class="mb-3 display-5 text-bold text-center ">No Results Avalible, Sorry :)!
         <a href="{{route('home')}}" class="btn btn-lg btn-outline-primary">Continue Shopping</a></h4>
      @else
         {
         <div class="row px-xl-12">
            <div class="col-lg-12 table-responsive mb-5">
               <table class="table table-bordered text-center mb-0">
                  <thead class="bg-secondary text-dark">
                     <tr>
                        <th>Name </th>
                        <th>Price</th>
                        <th>Slug</th>
                        <th>Description</th>
                     </tr>
                  </thead>
                  <tbody class="align-middle">
                     @if (request()->has('query'))
                        @foreach ($searchedProducts as $item)
                           <tr>
                              <td class="align-middle"><a
                                    href="{{ route('shop.show', ['shop' => $item->id]) }}">
                                    {{ $item->name }}</a>
                              </td>
                              <td class="align-middle">${{ $item->price }}</td>
                              <td class="align-middle">{{ $item->slug }}</td>
                              <td class="align-middle">{{ $item->description }}</td>
                           </tr>
                        @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
         </div>
         }
      @endif

   </div>
   <!-- Cart End -->
@endsection
