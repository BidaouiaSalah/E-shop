@if (session()->has('success_message'))
   <div class="alert alert-success alert-dismissible fade show"
      role="alert">
      <strong>Seccess</strong> {{ session()->get('success_message') }}.
      <button type="button"
         class="btn-close"
         data-bs-dismiss="alert"
         aria-label="Close"></button>
   </div>
@endif

@if (session()->has('warning_message'))
   <div class="alert alert-warning alert-dismissible fade show"
      role="alert">
      <strong>Warning</strong> {{ session()->get('warning_message') }}.
      <button type="button"
         class="btn-close"
         data-bs-dismiss="alert"
         aria-label="Close"></button>
   </div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show"
role="alert">
@foreach ($errors->all() as $error)
         <strong>Error</strong> {{ $error }} <br>
         <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"></button>
            @endforeach
      </div>
   @endif
