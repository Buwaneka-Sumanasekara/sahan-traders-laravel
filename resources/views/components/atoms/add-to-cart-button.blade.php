<div {{ $attributes->class(['d-grid' => $isDisplayFullWidth]) }} >
    @if($isInqItem)
    <button class="btn btn-danger" type="button" @click="add_to_cart_button_handleClickInqItem()">Read more</button>
    @else
    <button class="btn btn-danger" type="button" onclick="add_to_cart_button_handleClick()">Add to cart</button>
    @endif



    <script>




        function add_to_cart_button_handleClickInqItem() {

        }

        function add_to_cart_button_handleClick() {
            var qty_elem_id = '{{$qtyElemId}}'
            var product_id = '{{$productId}}'

            var hasQtyEle = qty_elem_id ? true : false

            var qty = hasQtyEle ? document.getElementById(qty_elem_id).value : 1

            axios.post('/action/cart/add', {
                product_id: product_id,
                qty: qty
            }).then(response => {
                console.log(response)

                //need to trigger event "change_header_add_to_cart" here
                document.dispatchEvent(new CustomEvent('change_header_add_to_cart', {
                    detail: { message: 'Cart updated successfully' }
                }));
                // Dispatch a custom event
                // Alpine.store('change_header_add_to_cart', {
                //     message: 'Cart updated successfully'
                // });

                // window.location.href = "#"
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
