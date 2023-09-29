<div class="card-group">
    @foreach($featuredProducts as $stock)
    <x-molecules.product-card :productName="$stock->product->name"
        :productImage="$stock->product->mainThumbnailImageUrl()" :productStockBatch="$stock->batch"
        :productPrice="$stock->displayPrice()" :productId="$stock->pm_product_id" :productSlug="$stock->product->slug"
        :productIsInqItem="$stock->product->is_inquiry_item" />
    @endforeach
</div>
