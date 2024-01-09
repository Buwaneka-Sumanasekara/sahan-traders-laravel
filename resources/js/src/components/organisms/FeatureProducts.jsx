import React,{useEffect, useState} from 'react'
import { useFetchFeatureProducts, useFetchSpecificProduct } from '../../hooks/products/useFetchProducts';
import  CustomEvents from '../../common/CustomEvents';
import {triggerCustomEvent} from '../../common/CommonUtil'
import AddToCartButton from '../atoms/AddToCartButton';
import PriceTag from '../atoms/PriceDisplay';

export default function FeatureProducts(props){

    const {data:featureProducts, isLoading, error} = useFetchFeatureProducts(5)



    const onPressAddToCart = (item) => {
    console.log("AddToCartButton",item)
    }


    const products=featureProducts || [];
    console.log(products)
    return (
       <React.Fragment>
        {products.map((product,index)=>(
            <div className={"col"} key={`feature_prod${index}`}>
                <div className="card" style={{height:400}}>
                    <img src={product.mainThumbnailImageUrl} 
                        className="card-img-top img-responsive" 
                        style={{ width:'100%',height:230}} alt={product.name}
                    />
                    <div className="card-body">
                        <h5 className="card-title">{product.name}</h5>
                        <p className="card-text">{product.price}</p>
                    </div>
                    <div className="card-footer">
                      <AddToCartButton 
                      disabled={!product.isQtyAvailableInStock} 
                      productId={product.id} 
                      stockId={product.stockId} 
                      varientId={product.varientId} onPress={onPressAddToCart}/>
                    </div>
                </div>
                
            </div>
        ))}
       </React.Fragment>
    )
}



