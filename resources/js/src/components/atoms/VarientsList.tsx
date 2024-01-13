import React from 'react';
import { ProductVariantGroup, ProductVariantType, ProductVarient } from '../../types/Product';




type VarientItemProps={
  variant: ProductVarient,
  onSelectedVariant: (variant:ProductVarient)=>void,
  isSelected:boolean
}
const VarientItem = ({ variant, onSelectedVariant,isSelected }:VarientItemProps) => {

    return (
      <div className={`me-2 ${isSelected?'variant-selected':''}`} onClick={()=>onSelectedVariant(variant)}>
        {variant.typeId===ProductVariantType.Text?<div className='badge bg-secondary'>{variant.val}</div>:null}
        {variant.typeId===ProductVariantType.Color?<div className='variant-color-box' style={{backgroundColor:variant.val}}></div>:null}
      </div>
    )
    
  
}


type VariantsListProps={
    variantGroup:ProductVariantGroup,
    variants: ProductVarient[],
    onSelectedVariant: (variant:ProductVarient)=>void,
    selectedVariantId:number
}
const VariantsList = ({ variants,variantGroup,onSelectedVariant,selectedVariantId }:VariantsListProps) => {

    

  console.log("variants",variants)
  
    return (
      <div className={"mt-4"}>
      <p className={"fw-bolder"}>{`${variantGroup.name}`}</p> 
      <div className={"d-flex align-items-start mb-3"}>
          {variants.map((variant,index) => (
              <VarientItem key={index} variant={variant} 
              onSelectedVariant={onSelectedVariant} 
              isSelected={selectedVariantId===variant.id}/>
          ))}
       </div>
       </div>
    )
}

export default VariantsList