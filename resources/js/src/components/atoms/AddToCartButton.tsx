import React from 'react';

type AddToCartButtonProps={
    productId:string,
    stockId:string,
    varientId:string,
    onPress:(
        data:{
            productId:string,
            stockId:string,
            varientId:string
        }
    )=>void,
    disabled:boolean
}
const AddToCartButton = ({ productId,stockId,varientId,onPress,disabled }:AddToCartButtonProps) => {

    return (
        <button className="btn btn-danger" disabled={disabled} onClick={() =>onPress({
            productId:productId,
            stockId:stockId,
            varientId:varientId
        })}>Add to cart</button>
    )
    
}

export default AddToCartButton