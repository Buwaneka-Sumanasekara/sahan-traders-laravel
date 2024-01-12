import React from 'react';
import { useAddToCart } from '../../hooks/cart/useMutateCart';
import { GeneralServerError } from '../../types/Common';

type AddToCartButtonProps={
    productId:string,
    stockId:string,
    varientId:string,
    disabled:boolean,
    isInqueryItem:boolean
    qty:number
    unitGroupId:string,
    unitId:string,
    additionalCostId?:string
}
const AddToCartButton = ({ productId,stockId,varientId,disabled,isInqueryItem,qty,additionalCostId,unitGroupId,unitId }:AddToCartButtonProps) => {

    const {mutate:onAddToCart}=useAddToCart(onSuccessAddToCart,onErrorAddToCart);




    function onSuccessAddToCart(data: any) {
       console.log("onSuccessAddToCart",data)
    }

    function onErrorAddToCart(er:GeneralServerError){
        console.log(er);
    }


    const onPressAddToCart = () => {
        onAddToCart({
            productId:productId,
            stockId:stockId,
            varientId:varientId,
            qty:qty,
            additionalCostId:additionalCostId,
            unitGroupId:unitGroupId,
            unitId:unitId
        })
    }

    const onPressInquiry = (data:any) => {
        console.log(data)
    }

    if(isInqueryItem){
        return (
            <button className="btn btn-danger" disabled={disabled} onClick={() =>onPressInquiry({
                productId:productId,
                stockId:stockId,
                varientId:varientId
            })}>Send Inquiry</button>
        ) 
    }
    return (
        <button className="btn btn-danger" disabled={disabled} onClick={() =>onPressAddToCart()}>Add to cart</button>
    )
    
}

export default AddToCartButton