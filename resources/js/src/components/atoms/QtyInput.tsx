import React from 'react';
import { Unit } from '../../types/Product';

type QtyInputProps={
    qty:number,
    disableIncrement:boolean,
    disableDecrement:boolean,
    onChange:(qty:number,unitGroupId?:string,unitId?:string)=>void,
    units?:Unit[],
    enableUnitSelection?:boolean,
    isEditable?:boolean
}
const QtyInput = (props:QtyInputProps) => {

    const {qty,onChange,disableIncrement,disableDecrement,isEditable}=props;


    const onChangeValue=(val:number)=>{
        if(val<1){
            return;
        }

        onChange(val);
    }

    if(isEditable){
        return (
            <div className="input-group input-group-md">
                <button className="btn btn-outline-secondary" 
                type="button" id="button-addon1" 
                onClick={()=>onChangeValue(qty-1)}
                disabled={disableDecrement}
                >-</button>
                <input type="text" className="input-qty form-control text-center input-lg" value={qty} readOnly />
                <button className="btn btn-outline-secondary" 
                type="button" id="button-addon2" 
                onClick={()=>onChangeValue(qty+1)} disabled={disableIncrement}>+</button>
            </div>
        )
    }

    return (
        
        <div className="input-group input-group-md">
            <input type="text" className="input-qty form-control text-center input-lg" value={qty} readOnly />
        </div>
    )
}

export default QtyInput;