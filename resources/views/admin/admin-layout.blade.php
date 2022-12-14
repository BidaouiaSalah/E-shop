<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible"
      content="IE=edge" />
   <meta name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description"
      content="" />
   <meta name="author"
      content="" />
   <title>Dashboard - SB Admin</title>
   <link rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
   <script type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
   <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"
      crossorigin="anonymous"></script>
   @vite(['resources/css/admin-app.css', 'resources/js/admin-app.js'])

</head>

<body class="sb-nav-fixed">
   <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3"
         href="{{ route('shop.index') }}">E-commerce Start</a>
      <!-- Sidebar Toggle-->
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
         id="sidebarToggle"
         href="#!"><i class="fas fa-bars"></i></button>
      <!-- Navbar Search-->

      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
         action="{{ route('admin.search') }}"
         method="GET">
         @csrf
         <div class="input-group">
            <input class="form-control"
               type="text"name="query"
               placeholder="Search for ..."
               aria-label="Search for..."
               name="query"
               aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary"
               id="btnNavbarSearch"
               type="submit"><i class="fas fa-search"></i></button>
         </div>
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle show"
               id="navbarDropdown"
               href="#"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end show"
               aria-labelledby="navbarDropdown">
               <li> <a class="dropdown-item"
                     href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                  </a>
                  <form id="logout-form"
                     action="{{ route('logout') }}"
                     method="POST"
                     class="d-none">
                     @csrf
                  </form>
               </li>
            </ul>
         </li>
      </ul>
   </nav>
   <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
         <nav class="sb-sidenav accordion sb-sidenav-light"
            id="sidenavAccordion">
            <div class="sb-sidenav-menu">
               <div class="nav">
                  <div class="sb-sidenav-menu-heading">Core</div>
                  <a class="nav-link"
                     href="{{ route('admin.dashboard') }}">
                     <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                     Dashboard
                  </a>
                  <div class="sb-sidenav-menu-heading">Store</div>
                  <a class="nav-link collapsed"
                     href="#"
                     data-bs-toggle="collapse"
                     data-bs-target="#collapseLayoutsCategories"
                     aria-expanded="false"
                     aria-controls="collapseLayoutsCategories">
                     <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                     Store Managment
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse"
                     id="collapseLayoutsCategories"
                     aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link"
                           href="{{ route('admin.products.index') }}">Products</a>
                        <a class="nav-link"
                           href="{{ route('admin.categories.index') }}">Categories</a>
                        <a class="nav-link"
                           href="{{ route('admin.brands.index') }}">Brands</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed"
                     href="#"
                     data-bs-toggle="collapse"
                     data-bs-target="#collapseLayoutsOrders"
                     aria-expanded="false"
                     aria-controls="collapseLayoutsOrders">
                     <div class="sb-nav-link-icon"><i class="fa fa-table"></i></div>
                     Orders
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i>
                     </div>
                  </a>
                  <div class="collapse"
                     id="collapseLayoutsOrders"
                     aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link"
                           href="{{ route('admin.orders.index') }}">List</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed"
                     href="#"
                     data-bs-toggle="collapse"
                     data-bs-target="#collapseLayoutsReviews"
                     aria-expanded="false"
                     aria-controls="collapseLayoutsReviews">
                     <div class="sb-nav-link-icon"><i class="fa fa-comment"></i></div>
                     Reviews
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i>
                     </div>
                  </a>
                  <div class="collapse"
                     id="collapseLayoutsReviews"
                     aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link"
                           href="{{ route('admin.reviews.index') }}">List</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed"
                     href="#"
                     data-bs-toggle="collapse"
                     data-bs-target="#collapseLayoutsUsers"
                     aria-expanded="false"
                     aria-controls="collapseLayoutsUsers">
                     <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                     Users
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i>
                     </div>
                  </a>
                  <div class="collapse"
                     id="collapseLayoutsUsers"
                     aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link"
                           href="{{ route('admin.users.index') }}">List</a>
                     </nav>
                  </div>
               </div>
            </div>
            <div class="sb-sidenav-footer">
               <div class="small">Logged in as:</div>
               Start Bootstrap
            </div>
         </nav>
      </div>
      <div id="layoutSidenav_content">
         @yield('content')
         <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
               <div class="d-flex align-items-center justify-content-between small">
                  <div class="text-muted">Copyright &copy; Your Website 2022</div>
                  <div>
                     <a href="#">Privacy Policy</a>
                     &middot;
                     <a href="#">Terms &amp; Conditions</a>
                  </div>
               </div>
            </div>
         </footer>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
      integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"></script>
   <script src="js/scripts.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
      integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"></script>
   @yield('extra-js')
</body>

</html>
