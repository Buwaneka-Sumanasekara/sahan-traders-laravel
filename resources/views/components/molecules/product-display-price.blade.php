
    
            <div>
                <div class="d-inline me-3">
                    <label class="fw-bold text-emphasis-secondary me-1">{{$product->getDisplayCategoryName()}}:</label>
                    <span class="fw-lighter">{{$product->getDisplayCategoryValue()}}</span>
                </div>
                <div class="d-inline">
                    <label class="fw-bold me-1">SKU:</label>
                    <span class="fw-lighter">{{$product->getDisplaySKU($varientId)}}</span>
                </div>
            </div>
            <hr />
            <div class="text-center text-md-start">
                <h3 class="py-3 ">{{$product->getDisplayPrice($varientId)}}</h3>
            </div>

 