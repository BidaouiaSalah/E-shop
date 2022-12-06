 <!-- Navbar Start -->
 <div class="container-fluid">
    <div class="row border-top px-xl-5">
       <div class="col-lg-3 d-none d-lg-block">
          <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
             data-toggle="collapse"
             href="#navbar-vertical"
             style="height: 65px; margin-top: -1px; padding: 0 30px;">
             <h6 class="m-0">Categories</h6>
             <i class="fa fa-angle-down text-dark"></i>
          </a>
          <nav
             class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
             id="navbar-vertical"
             style="width: calc(100% - 30px); z-index: 1;">
             <div class="navbar-nav w-100 overflow-hidden"
                style="height: 410px">
                <div class="nav-item dropdown">
                   <a href="#"
                      class="nav-link active"
                      data-toggle="dropdown">Major Brands <i
                         class="fa fa-angle-down float-right mt-1"></i></a>
                   <div
                      class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                      @foreach ($brands as $brand)
                         <a href="{{ route('shop.index', ['brand' => $brand->id]) }}"
                            class="dropdown-item">{{ $brand->name }}</a>
                      @endforeach
                   </div>
                </div>
                @foreach ($categories as $category)
                   <a href="{{ route('shop.index', ['category' => $category->id]) }}"
                      class="nav-item nav-link">{{ $category->name }}</a>
                @endforeach
             </div>
          </nav>
       </div>
       <div class="col-lg-9">
          <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
             <a href=""
                class="text-decoration-none d-block d-lg-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                      class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
             </a>
             <button type="button"
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse justify-content-between"
                id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                   <a href="{{ route('home') }}"
                      class="nav-item nav-link active">Home</a>
                   <a href="{{ route('shop.index') }}"
                      class="nav-item nav-link">Shop</a>
                   <a href="{{ route('contact') }}"
                      class="nav-item nav-link">Contact</a>
                </div>
                <div class="navbar-nav ml-auto py-0">
                   @guest
                      @if (Route::has('login'))
                         <a href="{{ route('login') }}"
                            class="nav-item nav-link">{{ __('Login') }}</a>
                      @endif
                      @if (Route::has('register'))
                         <a href="{{ route('register') }}"
                            class="nav-item nav-link">{{ __('Register') }}</a>
                      @endif
                   @else
                      <div class="nav-item dropdown">
                         <a href="#"
                            class="nav-link dropdown-toggle"
                            data-toggle="dropdown">Pages</a>
                         <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                               class="dropdown-item">
                               {{ __('Logout') }}</a>
                            <form id="logout-form"
                               action="{{ route('logout') }}"
                               method="POST"
                               class="d-none">
                               @csrf
                            </form>
                            @if (auth()->user()->is_admin == true)
                               <a href="{{ route('admin.dashboard') }}"
                                  class="dropdown-item">Admin</a>
                            @else
                               <a href="{{ route('profile') }}"
                                  class="dropdown-item">Profile</a>
                            @endif
                         </div>
                      </div>
                   @endguest
                </div>
             </div>
          </nav>
       </div>
    </div>
 </div>
 <!-- Navbar End -->
