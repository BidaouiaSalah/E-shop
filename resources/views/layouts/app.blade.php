@include('includes.head')

@include('includes.topbar')

@include('includes.nav', $categories)

   @yield('content')

@include('includes.footer')
