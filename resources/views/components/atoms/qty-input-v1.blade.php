<div class="form-group" x-data="{ quantity: {{$initialQty}},maxQty:{{$maxQty}} }">
    <div class="input-group">
        <input type="number" id="quantity" class="form-control" min="1" :max="maxQty" x-model="quantity">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"
                @click='quantity < maxQty ? quantity++ : maxQty'>+</button>
            <button class="btn btn-outline-secondary" type="button" @click="quantity > 1 ? quantity-- : 1">-</button>
        </div>
    </div>
</div>
