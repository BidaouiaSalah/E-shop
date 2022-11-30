@extends('admin.admin-layout')
@section('content')
   <main>

      <div class="container-fluid px-4">
         <h1 class="mt-4">New Brand</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Create</li>
         </ol>
      @include('partials.alert-message')
         <div class="mb-4">
            <form action="{{ route('admin.brands.store') }}"
               method="post">
               @csrf
               <div class="form-floating mb-3">
                  <input class="form-control"
                     id="name"
                     name="name"
                     type="text"
                     placeholder="Computers">
                  <label for="name">Name</label>
               </div>
               <div class="mt-4 mb-0">
                  <div class="d-grid"><button type="submit"
                        class="btn btn-primary btn-block">Create </button></div>
               </div>
            </form>
         </div>
      </div>
   </main>
@endsection
