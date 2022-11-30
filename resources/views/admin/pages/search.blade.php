@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Search</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Search</li>
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
                                    class="dataTable-sorter">Price</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Desciption</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">stock</a></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($searchedProducts as $product)
                              <tr>
                                 <td>{{ Auth()->user()->name }}</td>
                                 <td>{{ $product->name ?? 'No Infos' }}</td>
                                 <td>{{ $product->price ?? 'No Infos' }}</td>
                                 <td>{{ $product->description ?? 'No Infos' }}</td>
                                 <td>{{ $product->stock ?? 'No Infos' }}</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="dataTable-bottom">
                     <div class="dataTable-info">Showing 1 to 10 of 57 entries</div>
                     <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list">

                           {{ $searchedProducts->links() }}
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
@endsection
