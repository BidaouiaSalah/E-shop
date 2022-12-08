@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Reviews</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Reviews</li>
         </ol>

         @include('partials.alert-message')
         <table id="myTable"
            class="display">
            <thead>
               <tr>
                  <th>Content</th>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>Product Details</th>
                  <th>Created_at</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($reviews as $review)
                  <tr>
                     <td>{{ $review->review }}</td>
                     <td>{{ $review->user->name }}</td>
                     <td>{{ $review->user->email }}</td>
                     <td>{{ $review->product->name }}</td>
                     <td>{{ $review->created_at }}</td>
                     <td class="d-flex">
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}"
                           method="post"
                           class="px-1">
                           @method('delete')
                           @csrf
                           <button type="submit"
                              class="btn btn-outline-danger btn-sm">
                              <i class="fa fa-trash"></i></button>
                        </form>
                        <form action="{{ route('admin.reviews.update', ['review' => $review->id]) }}"
                           method="post">
                           @method('put')
                           @csrf

                           <button type="submit"
                              class="btn btn-outline-success btn-sm">Update Status</button>
                        </form>
                     </td>
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
