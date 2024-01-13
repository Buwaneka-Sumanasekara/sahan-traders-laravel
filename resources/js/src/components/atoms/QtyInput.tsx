import React from 'react';
import { Unit } from '../../types/Product';

type QtyInputProps={
    qty:number,
    disableIncrement:boolean,
    disableDecrement:boolean,
    onChange:(qty:number,unitId?:string)=>void,
    units:Unit[],
    enableUnitSelection:boolean,
}
const QtyInput = (props:QtyInputProps) => {

    const {qty,onChange,disableIncrement,disableDecrement}=props;


    const onChangeValue=(val:number)=>{
        if(val<1){
            return;
        }

        onChange(val);
    }

    return (
        
        <div className="input-group input-group-md mb-3">
            <button className="btn btn-outline-secondary" 
            type="button" id="button-addon1" 
            onClick={() => onChangeValue(qty - 1)}
            disabled={disableDecrement}
            >-</button>
            <input type="text" className="input-qty form-control text-center input-lg" value={qty} readOnly />
            <button className="btn btn-outline-secondary" 
            type="button" id="button-addon2" 
            onClick={() => onChangeValue(qty + 1)} disabled={disableIncrement}>+</button>
        </div>
    )
}

export default QtyInput;