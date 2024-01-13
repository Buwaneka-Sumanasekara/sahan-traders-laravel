import React,{useEffect, useState} from 'react'
import { useFetchSpecificProduct } from '../../hooks/products/useFetchProducts';
import  CustomEvents from '../../common/CustomEvents';
import {triggerCustomEvent} from '../../common/CommonUtil'
import AddToCartButton from '../atoms/AddToCartButton';
import PriceTag from '../atoms/PriceDisplay';
import VariantsList from '../atoms/VarientsList';

export default function ProductInfo(props){

    const {id}=props;

    const [prodVarients, setProdVarients] = useState([])
    const [variantId, setVarientId] = useState(0);
    const [stockId, setStockId] = useState("");
    const [price, setPrice] = useState(0);
    const [isInqueryItem, setIsInqueryItem] = useState(false);
    const [qty, setQty] = useState(2);
    const [additionalCostId, setAdditionalCostId] = useState("")
    const [unitGroupId,setUnitGroupId]=useState("");
    const [unitId,setUnitId]=useState("");


    const {data:productPriceInfo, isLoading, error} = useFetchSpecificProduct(id)

 
  

    useEffect(() => {
        if(productPriceInfo){
            setPrice(productPriceInfo.displayPrice)
            setIsInqueryItem(productPriceInfo.isInquiryItem)
            setStockId(productPriceInfo.stockId)
            setUnitGroupId(productPriceInfo.unitGroupId)
            setUnitId(productPriceInfo.unitId)

            const variants=productPriceInfo.variants;
            setProdVarients(variants)
            setVarientId(variants[0].id)
        }
    }
    ,[productPriceInfo])

   

    const onSelectedVariant=(variant)=>{
        console.log("onSelectedVariant",variant)
        setVarientId(variant.id);
        setPrice(variant.displaySellPrice);

        setStockId(variant.stockId);

    }
  


   if(!!productPriceInfo){
    return (
        <div className={"mt-5"}>
            <PriceTag price={price} size={"lg"} />
            {prodVarients.length>1?<VariantsList 
            variants={prodVarients} 
            variantGroup={productPriceInfo.varientGroup}
            onSelectedVariant={onSelectedVariant}
            selectedVariantId={variantId}
            />:null}

            <AddToCartButton 
            disabled={false} 
            productId={id} 
            stockId={stockId} 
            variantId={variantId} 
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



