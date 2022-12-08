@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Users</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
         </ol>

         @include('partials.alert-message')

         <table id="myTable"
            class="display">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Change Role</th>
                  <th>Remove</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
                  <tr>
                     <td>{{ $user->name ?? 'No Infos' }}</td>
                     <td>{{ $user->email ?? 'No Infos' }}</td>
                     <td>
                        @if ($user->is_admin == true)
                           <span class="badge badge-danger bg-danger">Admin</span>
                        @else
                           <span class="badge badge-success bg-success">User</span>
                        @endif
                     </td>
                     <td>
                        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}"
                           method="post">
                           @csrf
                           @method('put')
                           <button type="submit"
                              class="{{ $user->is_admin ? 'btn btn-outline-success btn-sm' : 'btn btn-outline-danger btn-sm' }}">
                              {{ $user->is_admin ? 'User' : 'admin' }}</button>
                        </form>
                     </td>
                     <td>
                        <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                           method="post">
                           @csrf
                           @method('delete')
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
                  <th>Email</th>
                  <th>Role</th>
                  <th>Change Role</th>
                  <th>Remove</th>
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
