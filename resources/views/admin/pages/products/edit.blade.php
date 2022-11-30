@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Edit Product</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Create</li>
         </ol>
         <div class="mb-4">
            <form action="{{ route('admin.products.update', ['product' => $product->id]) }}"
               method="post"
               enctype="multipart/form-data">
               @method('put')
               @csrf
               <div class="row">
                  <div class="form-floating mb-3 col-6">
                     <input class="form-control mb-3"
                        id="name"
                        name="name"
                        type="text"
                        value="{{ $product->name }}">
                     <label class="px-4"
                        for="name">Name</label>
                  </div>
                  <div class="form-floating mb-3 col-6">
                     <input class="form-control"
                        id="slug"
                        name="slug"
                        type="text"
                        value="{{ $product->slug }}">
                     <label class="px-4"
                        for="slug">slug</label>
                  </div>
               </div>
               <div class="row">
                  <div class="form-floating mb-3 col-12">
                     <textarea class="form-control"
                        id="desc"
                        name="description"
                        value="{{ $product->description }}"></textarea>
                     <label class="px-4"
                        for="desc">Description</label>
                  </div>
               </div>
               <div class="row">
                  <div class="form-floating mb-3 col-6">
                     <input class="form-control"
                        id="stock"
                        name="stock"
                        type="number"
                        value="{{ $product->stock }}">
                     <label class="px-4"
                        for="stock">stock</label>
                  </div>
                  <div class="form-floating mb-3 col-6">
                     <input class="form-control"
                        id="price"
                        name="price"
                        type="number"
                        value="{{ $product->price }}">
                     <label class="px-4"
                        for="price">Price</label>
                  </div>
               </div>
               <div class="row">
                  <div class="form-floating mb-3">
                     <select name="category_id"
                        class="dataTable-selector col-6">
                        @foreach ($categories as $category)
                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-floating mb-3">
                     <select name="brand_id"
                        class="dataTable-selector col-6">
                        @foreach ($brands as $brand)
                           <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-floating mb-3">
                     <input type="file"
                        name="images[]"
                        multiple
                        required>
                  </div>
               </div>
               <div class="mt-4 mb-0">
                  <div class="d-grid"><button type="submit"
                        class="btn btn-primary btn-block">Create</button></div>
               </div>
            </form>
         </div>
      </div>
   </main>
@endsection
