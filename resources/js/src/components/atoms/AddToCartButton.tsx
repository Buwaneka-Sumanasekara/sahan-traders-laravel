import React from 'react';
import { useAddToCart } from '../../hooks/cart/useMutateCart';
import { GeneralServerError } from '../../types/Common';
import { AddCartButtonType } from '../../types/Cart';

type AddToCartButtonProps = {
    productId: string,
    stockId: string,
    variantId: string,
    disabled: boolean,
    isInqueryItem: boolean
    qty: number
    unitGroupId: string,
    unitId: string,
    additionalCostId?: string,
    buttonType: AddCartButtonType
}
const AddToCartButton = ({ productId, stockId, variantId, disabled, isInqueryItem, qty, additionalCostId, unitGroupId, unitId, buttonType }: AddToCartButtonProps) => {

    const { mutate: onAddToCart } = useAddToCart(onSuccessAddToCart, onErrorAddToCart);

    function onSuccessAddToCart(data: any) {
        console.log("onSuccessAddToCart", data)

    }

    function onErrorAddToCart(er: GeneralServerError) {
        console.log(er);
       
    }


    const onPressAddToCart = () => {
        onAddToCart({
            productId: productId,
            stockId: stockId,
            variantId: variantId,
            qty: qty,
            additionalCostId: additionalCostId,
            unitGroupId: unitGroupId,
            unitId: unitId
        })
    }

    const onPressInquiry = (data: any) => {
        console.log(data)
    }

    if (isInqueryItem) {
        return (
            <button className="btn btn-danger" disabled={disabled} onClick={() => onPressInquiry({
                productId: productId,
                stockId: stockId,
                variantId: variantId
            })}>Send Inquiry</button>
        )
    } else {
        if (buttonType === AddCartButtonType.BuyNow) {
            return (
                <button className="btn  btn-outline-danger " disabled={disabled} onClick={() => onPressAddToCart()}>Buy Now</button>
            )
        }
        return (
            <button className={`btn btn btn-danger`} disabled={disabled} onClick={() => onPressAddToCart()}>{
                'Add To Cart'
            }</button>
        )
    }


}

export default AddToCartButton