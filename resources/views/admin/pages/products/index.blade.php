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
                                    class="dataTable-sorter">images</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Name</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Slug</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Description</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">Brand</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">price</a></th>
                              <th data-sortable=""
                                 style="width: 19.0549%;"
                                 class="asc"><a href="#"
                                    class="dataTable-sorter">stock</a></th>
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
                                 <td>{{ $product->brand_id }}</td>
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
                                       class="btn btn-outline-success btn-sm">
                                       <i class="fa fa-edit"></i></a>
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

                           {{ $products->links() }}
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
@endsection
