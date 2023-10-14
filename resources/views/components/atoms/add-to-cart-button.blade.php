<div {{ $attributes->class(['d-grid' => $isDisplayFullWidth]) }}>
    @if($isInqItem)
    <button class="btn btn-danger" type="button">Read more</button>
    @else
    <button class="btn btn-danger" type="button">Add to cart</button>
    @endif
</div>
