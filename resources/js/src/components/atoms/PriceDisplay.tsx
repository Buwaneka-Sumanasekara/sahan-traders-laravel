import React from 'react';

type PriceTagProps={
    price:number,
    size:'sm'|'md'|'lg'
}
const PriceTag = ({ price,size }:PriceTagProps) => {

    const Element = size === 'sm' ? 'h4' : size === 'md' ? 'h2' : 'h3'

  
    return (
        <Element className="text-secondary-emphasis">{price}</Element>
    )
}

export default PriceTag