@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Products</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
         </ol>
         @include('partials.alert-message')
         <div class="card mb-4">
            <div class="card-header">
               <!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
               DataTable
            </div>
            <div class="card-body">
               <div
                  class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                  <div class="dataTable-top">
                     <div>
                        <a href="{{ route('admin.products.create') }}"
                           class="btn btn-outline-primary">Create +</a>
                     </div>
                     <div class="dataTable-search"><input class="dataTable-input"
                           placeholder="Search..."
                           type="text"></div>
                  </div>
                  <div class="dataTable-container">
                     <table id="datatablesSimple"
                        class="dataTable-table">
                        <thead>
                           <tr>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">User</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Email</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Name</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Address</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">City</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Province</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Postalcode</a></th>
                              <th data-sortable=""
                                 style="width: 29.1159%;"
                                 class=""><a href="#"
                                    class="dataTable-sorter">Name_on_card</a></th>
                              <th data-sortable=""
                                 style="width: 29.1159%;"
                                 class=""><a href="#"
                                    class="dataTable-sorter">Discount</a></th>
                              <th data-sortable=""
                                 style="width: 15.2439%;"><a href="#"
                                    class="dataTable-sorter">Discount code</a></th>
                              <th data-sortable=""
                                 style="width: 29.1159%;"
                                 class=""><a href="#"
                                    class="dataTable-sorter">Total</a></th>
                              <th data-sortable=""
                                 style="width: 29.1159%;"
                                 class=""><a href="#"
                                    class="dataTable-sorter">Payment Gateway</a></th>
                              <th data-sortable=""
                                 style="width: 29.1159%;"
                                 class=""><a href="#"
                                    class="dataTable-sorter">Shipped</a></th>
                              <th data-sortable=""
                                 style="width: 29.1159%;"
                                 class=""><a href="#"
                                    class="dataTable-sorter">Error</a></th>
                           </tr>
                        </thead>
                        <tbody>
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
                  <div class="dataTable-bottom">
                     <div class="dataTable-info">Showing 1 to 10 of 57 entries</div>
                     <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list">

                           {{ $orders->links() }}
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
@endsection
