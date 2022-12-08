@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Products
            <a href="{{ route('admin.products.create') }}"
               type="submit"
               class="btn btn-outline-success btn-sm">
               New Product</a>
         </h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
         </ol>
         @include('partials.alert-message')
         <table id="myTable">
            <thead>
               <tr>
                  <th>images</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Brand</th>
                  <th>price</th>
                  <th>stock</th>
                  <th>Create At</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($products as $product)
                  <tr>
                     <td>
                        @foreach ($product->media as $media)
                           {{ $media('thumb') }}
                        @endforeach
                     </td>
                     <td>{{ $product->name }}</td>
                     <td>{{ $product->slug }}</td>
                     <td>{{ $product->description }}</td>
                     <td>{{ $product->brand->name }}</td>
                     <td>{{ $product->price }}</td>
                     <td>{{ $product->stock }}</td>
                     <td>{{ $product->created_at }}</td>
                     <td class="d-flex">
                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                           method="post"
                           class="px-1">
                           @method('delete')
                           @csrf
                           <button type="submit"
                              class="btn btn-outline-danger btn-sm">
                              <i class="fa fa-trash"></i></button>
                        </form>
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           type="submit"
                           class="btn btn-outline-primary btn-sm">
                           <i class="fa fa-edit"></i></a>
                     </td>
                  </tr>
               @endforeach
            </tbody>
            <tfoot>
               <tr>
                  <th>images</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Brand</th>
                  <th>price</th>
                  <th>stock</th>
                  <th>Create At</th>
                  <th>Actions</th>
                  <th>New Product</th>
               </tr>
            </tfoot>
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
