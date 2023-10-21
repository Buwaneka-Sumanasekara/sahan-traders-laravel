<div>
    <div class="row">
        <div class="col-md-12">
            <h2>{{$product->name}}</h2>
            <div>
                <div class="d-inline me-3">
                    <label class="fw-bold text-emphasis-secondary me-1">{{$product->getDisplayCategoryName()}}:</label>
                    <span class="fw-lighter">{{$product->getDisplayCategoryValue()}}</span>
                </div>
                <div class="d-inline">
                    <label class="fw-bold me-1">SKU:</label>
                    <span class="fw-lighter">{{$product->getDisplaySKU()}}</span>
                </div>
            </div>
            <hr />
            <div class="text-center text-md-start">
                <h3 class="py-3 ">{{$product->getDisplayPrice()}}</h3>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12 ">
            <div class="border p-4">
                <div class="d-flex  mb-3">
                    <!--Qty component-->
                    <div class="me-auto">
                        <x-atoms.qty-input-v1 :id="'product_view_'.$product->id" :initialQty="1" :minQty="1"
                            :maxQty="$product->getFIFOStockQty()" />
                    </div>
                    <!--Add to cart-->
                    <div class="">
                        <x-atoms.add-to-cart-button :productId="$product->id" :stockBatchId="$product->getFIFOStockId()"
                            :isInqItem="$product->is_inquiry_item" :qty="0" :isOutOfStock="$product->isOutOfStock()"
                            :isDisplayFullWidth="false" :qtyElemId="'quantity_product_view_'.$product->id" />
                    </div>


                </div>
                <p class="d-inline-flex p-1 bg-body-secondary fs-6 fw-lighter">Available Qty:
                    {{$product->getFIFOStockQty()}}
                </p>
            </div>
        </div>
    </div>
