   <!-- Header-->
   <header class="bg-dark py-5">
      <div class="container px-5 px-lg-5 my-5">
         <div class="text-center text-white">
            <h1 class="display-5 fw-bolder text-success">{{ $currentPageTitle }}</h1>
            <div class="d-flex justify-content-center">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="/"
                           class="link-dark">Home</a></li>
                     <li class="breadcrumb-item text-dark"
                        aria-current="page">{{ $currentPageTitle }}</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </header>
