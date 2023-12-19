<div class="row">
    @foreach($featuredProducts as $product)
    <div class="col">
        <x-molecules.product-card :productName="$product->name" :productImage="$product->mainThumbnailImageUrl()"
            :productStockBatch="$product->getFIFOStockId(1)" :productPrice="$product->getDisplayPrice(1)"
            :productId="$product->id" :productSlug="$product->slug" :productIsInqItem="$product->is_inquiry_item"
            :isOutOfStock="$product->isOutOfStock(1)" />
    </div>

    @endforeach
</div>
