<div x-data="{ productSlug: '{{ $productSlug }}' }">
    <div class="card" x-on:click="handleClick" style="height: 400px;">
        <img src="{{$productImage}}" class="card-img-top img-responsive" style=" width:100%;height:230px" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$productName}}</h5>

            <p class="card-text">{{$productPrice}}</p>

        </div>
        <div class="card-footer d-grid">
            @if($productIsInqItem)
            <button class="btn btn-danger" type="button">Read more</button>
            @else
            <button class="btn btn-danger" type="button">Add to cart</button>
            @endif

        </div>
    </div>


    <script>

        function handleClick() {
            window.location.href = "/product/" + this.productSlug;
        }
    </script>

</div>
