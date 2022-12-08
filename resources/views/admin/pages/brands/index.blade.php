@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Brands
            <a href="{{ route('admin.brands.create') }}"
               type="submit"
               class="btn btn-outline-success btn-sm">
               New Brand</a></h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">brands</li>
         </ol>
         @include('partials.alert-message')
         <table id="myTable"
            class="display">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Created_at</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($brands as $brand)
                  <tr>
                     <td>{{ $brand->name }}</td>
                     <td>{{ $brand->created_at }}</td>
                     <td>
                        <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                           method="post">
                           @method('delete')
                           @csrf
                           <button type="submit"
                              class="btn btn-outline-danger btn-sm">
                              <i class="fa fa-trash"></i></button>
                        </form>
                     </td>
                  </tr>
               @endforeach
            </tbody>
            <tfoot>
               <tr>
                  <th>Name</th>
                  <th>Created_at</th>
                  <th>Actions</th>
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
