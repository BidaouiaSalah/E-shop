@extends('admin.admin-layout')
@section('content')

   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Brands</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">brands</li>
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
                        <a href="{{ route('admin.brands.create') }}"
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
                                    class="dataTable-sorter">Name</a></th>
                              <th data-sortable=""
                                 style="width: 29.1159%;"
                                 class=""><a href="#"
                                    class="dataTable-sorter">Created_at</a></th>
                              <th data-sortable=""
                                 style="width: 15.2439%;"><a href="#"
                                    class="dataTable-sorter">Actions</a></th>
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
                     </table>
                  </div>
                  <div class="dataTable-bottom">
                     <div class="dataTable-info">Showing 1 to 10 of 57 entries</div>
                     <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list">

                           {{ $brands->links() }}
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
@endsection
