<div x-data="{ selectedVarientId: 1,additionalCostId:'' }">
   
    <div class="row">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>

                <input type="hidden" x-model="selectedVarientId" value="1" id="item_varient_{{$product->id}}"/>
                <input type="hidden" x-model="additionalCostId" value="" id="item_additional_cost_{{$product->id}}"/>
                @foreach ($product->productVarients as $varient)
                <div x-show="selectedVarientId=={{$varient->id}}">
                    <x-molecules.product-display-price :varientId="$varient->id" :product="$product"  />
                    @if ($product->hasMultipleVarients())
                    <x-molecules.product-display-varients :arVarients="$product->productVarients" :selectedVarient="$varient->id"  />
                    @endif

                    
                    @if($product->hasAdditionalCosts())
                        <ul class="list-group mb-3">
                        @foreach ($product->productAdditionalCosts as $additionalCost)
                        <li class="list-group-item">
                            <input type="radio" class="form-check-input me-1" @click="additionalCostId={{$additionalCost->id}}"  name="listGroupRadio" value="{{$additionalCost->id}}" >
                            <label class="form-check-label" for="firstCheckbox">{{$additionalCost->name}}</label>
                        </li>
                        @endforeach
                        </ul>
                    @endif

                   <x-molecules.product-display-input-group :varientId="$varient->id" :product="$product"  />
                </div>
                @endforeach  

            </div>
    </div>
   
</div>
