import React from 'react';
import { useAddToCart } from '../../hooks/cart/useMutateCart';
import { EventType, GeneralServerError } from '../../types/Common';
import { AddCartButtonType } from '../../types/Cart';
import { useMutateEventListener, useMutateToastEventListner } from '../../hooks/common/useEventsListner';

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
    isIncrementingQty?: boolean
}
const AddToCartButton = ({ productId, stockId, variantId, disabled, 
    isInqueryItem, qty, additionalCostId, unitGroupId, unitId, 
    buttonType,isIncrementingQty }: AddToCartButtonProps) => {

    const { mutate: onAddToCart } = useAddToCart(onSuccessAddToCart, onErrorAddToCart);

    const {onExecuteEvent:onExecuteEvent}=useMutateEventListener();
    const {onShowWarningMessage:onShowWarningMessage,onShowSuccessMessage:onShowSuccessMessage}=useMutateToastEventListner();

    function onSuccessAddToCart(data: object) {
        onExecuteEvent(EventType.EVENT_CART_UPDATED,{
            productId: productId,
        })

        onShowSuccessMessage({
            message: "Item added to cart",
        })

    }

    function onErrorAddToCart(er: GeneralServerError) {
        onShowWarningMessage({
            message: er.message,
        })
       
    }


    const onPressAddToCart = () => {
        onAddToCart({
            productId: productId,
            stockId: stockId,
            variantId: variantId,
            qty: qty,
            additionalCostId: additionalCostId,
            unitGroupId: unitGroupId,
            unitId: unitId,
            isIncrementingQty:isIncrementingQty
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