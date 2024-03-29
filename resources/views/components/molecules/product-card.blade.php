<div x-data="{ productSlug: '{{ $productSlug }}' }">
    <div class="card" style="height: 400px;">
        <img src="{{$productImage}}" x-on:click="product_card_handleClickOnProductImage"
            class="card-img-top img-responsive" style=" width:100%;height:230px" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$productName}}</h5>

            <p class="card-text">{{$productPrice}}</p>

        </div>
        <div class="card-footer" id="jsx-quick-add-to-cart">
        </div>
    </div>


    <script>

        function product_card_handleClickOnProductImage() {
            window.location.href = "/product/" + this.productSlug;
        }
    </script>

</div>
