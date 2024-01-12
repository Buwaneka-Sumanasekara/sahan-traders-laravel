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
    const [stockId, setStockId] = useState("");
    const [price, setPrice] = useState(0);
    const [isInqueryItem, setIsInqueryItem] = useState(false);
    const [qty, setQty] = useState(2);
    const [additionalCostId, setAdditionalCostId] = useState("")
    const [unitGroupId,setUnitGroupId]=useState("");
    const [unitId,setUnitId]=useState("");


    const {data:productPriceInfo, isLoading, error} = useFetchSpecificProduct(id,varientId)

 
    console.log("productPriceInfo",productPriceInfo)

    useEffect(() => {
        if(productPriceInfo){
            setPrice(productPriceInfo.displayPrice)
            setIsInqueryItem(productPriceInfo.isInquiryItem)
            setStockId(productPriceInfo.stockId)
            setUnitGroupId(productPriceInfo.unitGroupId)
            setUnitId(productPriceInfo.unitId)
        }
    }
    ,[productPriceInfo])

   
  


   if(!!productPriceInfo){
    return (
        <div>
            <PriceTag price={price} size={"md"} />
            <AddToCartButton 
            disabled={false} 
            productId={id} 
            stockId={stockId} 
            varientId={varientId} 
            isInqueryItem={isInqueryItem} 
            qty={qty}
            additionalCostId={additionalCostId}
            unitGroupId={unitGroupId}
            unitId={unitId}
            />
        </div>
    )
   }
    return null
}



