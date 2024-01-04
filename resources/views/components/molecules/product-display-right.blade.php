<div x-data="{ selectedVarientId: 1,additionalCostId:'' }">
   
    <div class="row">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>

               
            <div id="jsx-product-info" 
                data-id="{{$product->id}}"
                data-prod-varients="{{$product->productVarients}}"
                data-prod-stocks="{{$product->stocks}}"
            >
            </div>

            </div>
    </div>
   
</div>
