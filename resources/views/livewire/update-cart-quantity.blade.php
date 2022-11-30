{{-- <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
   <button class="btn btn-link px-2"
      wire:click.prevent="decrement('{{ $rowId }}')">
      <i class="fas fa-minus"></i>
   </button>
   <input id="form1"
      min="1"
      max="5"
      name="quantity"
      type="number"
      value="{{ $qty }}"
      class="form-control form-control-sm" />
   <button class="btn btn-link px-2"
      wire:click.prevent="increment('{{ $rowId }}')">
      <i class="fas fa-plus"></i>
   </button>
</div>
<div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
   <h5 class="mb-0 display-6">${{ $price }}</h5>
</div>
 --}} <div class="input-group quantity mx-auto"
   style="width: 100px;">
   <div class="input-group-btn">
      <button class="btn btn-sm btn-primary btn-minus"
         wire:click.prevent="decrement('{{ $rowId }}')">
         <i class="fa fa-minus"></i>
      </button>
   </div>
   <input type="text"
      class="form-control form-control-sm bg-secondary text-center"
      value="{{ $qty }}">
   <div class="input-group-btn">
      <button class="btn btn-sm btn-primary btn-plus"
         wire:click.prevent="increment('{{ $rowId }}')">
         <i class="fa fa-plus"></i>
      </button>
   </div>
</div>
