<div x-data="{ productSlug: '{{ $productSlug }}' }">
    <div class="card" style="height: 400px;">
        <img src="{{$productImage}}" x-on:click="handleClick" class="card-img-top img-responsive"
            style=" width:100%;height:230px" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$productName}}</h5>

            <p class="card-text">{{$productPrice}}</p>

        </div>
        <div class="card-footer">
            <!-- @if($productIsInqItem)
            <button class="btn btn-danger" type="button">Read more</button>
            @else
            <button class="btn btn-danger" type="button">Add to cart</button>
            @endif -->

            <x-atoms.add-to-cart-button :productId="$productId" :stockBatchId="$productStockBatch"
                :isInqItem="$productIsInqItem" :qty="1" :isOutOfStock="$isOutOfStock" :isDisplayFullWidth="true" />


        </div>
    </div>


    <script>

        function handleClick() {
            window.location.href = "/product/" + this.productSlug;
        }
    </script>

</div>
