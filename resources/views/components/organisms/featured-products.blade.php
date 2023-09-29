<div class="row">
    @foreach($featuredProducts as $product)
    <div class="col">
        <x-molecules.product-card :productName="$product->name" :productImage="$product->mainThumbnailImageUrl()"
            :productStockBatch="$product->getFIFOStockId()" :productPrice="$product->getDisplayPrice()"
            :productId="$product->id" :productSlug="$product->slug" :productIsInqItem="$product->is_inquiry_item" />
    </div>

    @endforeach
</div>
