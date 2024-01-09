import React from 'react';

type PriceTagProps={
    price:number,
    size:'sm'|'md'|'lg'
}
const PriceTag = ({ price,size }:PriceTagProps) => {

    const Element = size === 'sm' ? 'h6' : size === 'md' ? 'h5' : 'h4'

  
    return (
        <Element className="text-secondary-emphasis">{price}</Element>
    )
}

export default PriceTag