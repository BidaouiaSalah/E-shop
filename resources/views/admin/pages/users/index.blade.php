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
         <div class="card mb-4">
            <div class="card-header">
               <!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
               DataTable
            </div>
            <div class="card-body">
               <div
                  class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                  <div class="dataTable-container">
                     <table id="datatablesSimple"
                        class="dataTable-table">
                        <thead>
                           <tr>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Name</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Mail</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Admin</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">New Admin</a></th>
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
                                    <form
                                       action="{{ route('admin.users.update', ['user' => $user->id]) }}"
                                       method="post">
                                       @csrf
                                       @method('put')
                                       <button type="submit"
                                          class="btn btn-outline-info">New Admin</button>
                                    </form>
                                    <form
                                    action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                       class="btn btn-outline-info">Remove</button>
                                 </form>
                                 </td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="dataTable-bottom">
                     <div class="dataTable-info">Showing 1 to 10 of 57 entries</div>
                     <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list">
                           {{ $users->links() }}
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
@endsection
