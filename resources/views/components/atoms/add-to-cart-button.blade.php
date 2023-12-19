<div {{ $attributes->class(['d-grid' => $isDisplayFullWidth]) }} >
    @if($isInqItem)
    <button class="btn btn-danger" type="button" @click="add_to_cart_button_handleClickInqItem()">Read more</button>
    @else
    <button class="btn btn-danger" type="button" onclick="add_to_cart_button_handleClick()">Add to cart</button>
    @endif



    <script>




        function add_to_cart_button_handleClickInqItem() {

        }

        function add_to_cart_move_topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

        function add_to_cart_button_handleClick() {
            var qty_elem_id = '{{$qtyElemId}}'
            var product_id = '{{$productId}}'

            var varient_ele_id="item_varient_"+product_id
            var additional_cost_ele_id="item_additional_cost_"+product_id

            var hasQtyEle = qty_elem_id ? true : false
            var varientElement =document.getElementById(varient_ele_id);
            var additionalCostElement=document.getElementById(additional_cost_ele_id);

            var qty = hasQtyEle ? document.getElementById(qty_elem_id).value : 1
            var varient_id= (typeof(varientElement) != 'undefined' && varientElement != null)?varientElement.value:1;
            var addtional_cost_id= (typeof(additionalCostElement) != 'undefined' && additionalCostElement != null)?additionalCostElement.value:"";


            var data={
                product_id: product_id,
                varient_id:varient_id,
                qty: qty,
                addtional_cost_id:addtional_cost_id,
            }
            console.log(data);
            axios.post('/action/cart/add', data).then(response => {
                console.log(response)

                //need to trigger event "change_header_add_to_cart" here
                document.dispatchEvent(new CustomEvent('change_header_add_to_cart', {
                    detail: { message: 'Cart updated successfully' }
                }));
                // Dispatch a custom event
                // Alpine.store('change_header_add_to_cart', {
                //     message: 'Cart updated successfully'
                // });

                add_to_cart_move_topFunction();
              
                setTimeout(() => {
                    window.location.reload() 
                }, 500);
            }).catch(er => {
                if (er.response.status === 401) {
                    window.location.href = '/login?redirect-to-item={{$productId}}';
                } else {
                    console.log(er);
                    window.location.href = "#"
                }
            });
        }

    </script>
</div>
