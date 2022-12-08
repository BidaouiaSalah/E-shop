@extends('admin.admin-layout')
@section('content')
   <main>
      <div class="container-fluid px-4">
         <h1 class="mt-4">Dashboard</h1>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
         </ol>
         <div class="row">
            <div class="col-xl-4 col-md-6">
               <div class="card bg-primary text-white mb-4">
                  <div class="card-body">Total Products</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                     <a class="small text-white stretched-link"
                        href="{{ route('admin.products.index') }}">View Details</a>
                     <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-md-6">
               <div class="card bg-warning text-white mb-4">
                  <div class="card-body">Total Categories</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                     <a class="small text-white stretched-link"
                        href="{{ route('admin.categories.index') }}">View Details</a>
                     <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-md-6">
               <div class="card bg-success text-white mb-4">
                  <div class="card-body">Total Brands</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                     <a class="small text-white stretched-link"
                        href="{{ route('admin.brands.index') }}">View Details</a>
                     <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
@endsection
