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
         <table id="myTable"
         class="display">
         <thead>
            <tr>
               <th>User</th>
               <th>Email</th>
               <th>Name</th>
               <th>Address</th>
               <th>City</th>
               <th>Province</th>
               <th>Postalcode</th>
               <th>Card Holder Name</th>
               <th>Discount</th>
               <th>Discount code</th>
               <th>Total</th>
               <th>Payment Gateway</th>
               <th>Shipped</th>
               <th>Error</th>
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
   </main>
@endsection
@section('extra-js')
   <script>
      $(document).ready(function() {
         $('#myTable').DataTable({
            pagingType: 'full_numbers',
         });
      });
   </script>
@endsection
