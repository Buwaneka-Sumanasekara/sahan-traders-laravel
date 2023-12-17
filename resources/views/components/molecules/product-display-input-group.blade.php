<div class="row">
        <div class="col-md-6 col-sm-12 ">
            <div class="border p-4">
                <div class="d-flex  mb-3">
                    <!--Qty component-->
                    <div class="me-auto">
                        <x-atoms.qty-input-v1 :id="'product_view_'.$product->id" :initialQty="1" :minQty="1"
                            :maxQty="$product->getFIFOStockQty($varientId)" />
                    </div>
                    <!--Add to cart-->
                    <div class="">
                        <x-atoms.add-to-cart-button :productId="$product->id" :stockBatchId="$product->getFIFOStockId($varientId)"
                            :isInqItem="$product->is_inquiry_item" :qty="0" :isOutOfStock="$product->isOutOfStock($varientId)"
                            :isDisplayFullWidth="false" :qtyElemId="'quantity_product_view_'.$product->id" />
                    </div>


                </div>
                <p class="d-inline-flex p-1 bg-body-secondary fs-6 fw-lighter">Available Qty:
                    {{$product->getFIFOStockQty($varientId)}}
                </p>
            </div>
        </div>
</div>