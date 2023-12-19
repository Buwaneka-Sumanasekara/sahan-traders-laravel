
<div class="mb-4">
@foreach ($arVarients as $varient)
 
  @if($varient->id==$selectedVarient)
  <button class="btn btn-secondary" type="button"
                @click="selectedVarientId={{$varient->id}}">
             {{$varient->name}}
  </button>
  @else
  <button class="btn btn-outline-secondary" type="button"
                @click="selectedVarientId={{$varient->id}}">
             {{$varient->name}}
  </button>
  @endif

@endforeach
</div>