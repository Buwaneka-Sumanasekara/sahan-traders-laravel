import React,{useState} from 'react';
import { ProductAdditionalCost } from '../../types/Product';

type AdditionalCostProps={
    values:ProductAdditionalCost[],
    selectedValue:ProductAdditionalCost|null,
    onChangeValue:(value:ProductAdditionalCost)=>void,
}
const AdditionalCost = ({ values,onChangeValue,selectedValue }:AdditionalCostProps) => {

  

  
    return (
        <div className={"py-2"}>
            <p className={"text-secondary bg-light"}>{"Additional Costs:"}</p>
            {values.map((value, index) => (
                <div className={`mb-1 form-check ${selectedValue?.id === value.id ? 'selected' : ''}`} key={index}>
                    <input className="form-check-input" type="radio" name="flexRadioDefault" id={`flexRadioDefault${index}`} onClick={() => {
                        onChangeValue(value);      
                    }} />
                    <label className="form-check-label" htmlFor={`flexRadioDefault${index}`}>
                        {`${value.name} ( ${value.displayAmount} + )`}
                    </label>
                </div>
            )
            )}
        </div>
    )
}

export default AdditionalCost