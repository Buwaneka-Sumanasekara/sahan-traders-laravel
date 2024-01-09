import React,{useEffect, useState} from 'react'
import { useFetchSpecificProduct } from '../../hooks/products/useFetchProducts';
import  CustomEvents from '../../common/CustomEvents';
import {triggerCustomEvent} from '../../common/CommonUtil'
import AddToCartButton from '../atoms/AddToCartButton';
import PriceTag from '../atoms/PriceDisplay';

export default function ProductInfo(props){

    const {id}=props;

    const [prodVarients, setProdVarients] = useState(JSON.parse(props.prodVarients))
    const [varientId, setVarientId] = useState(prodVarients[0].id);
   

    const {data:productPriceInfo, isLoading, error} = useFetchSpecificProduct(id,varientId)



    const onPress = () => {
        triggerCustomEvent(CustomEvents.EVENT_TEST,{id:id})
      };
    console.log("productPriceInfo",productPriceInfo)


    const price=(productPriceInfo?.price ||"");
    return (
        <div>
            <PriceTag price={price} size={"md"} />
            <AddToCartButton disabled={true} productId={id} stockId={""} varientId={varientId} onPress={onPress}/>
        </div>
    )
}



