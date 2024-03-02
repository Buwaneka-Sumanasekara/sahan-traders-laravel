
import { CartAddress } from "../types/Cart";


export function convertAddressToDisplayString(address: CartAddress) {
    let addressAr:string[]=[];

    if(address.address_1){
        addressAr.push(address.address_1);
    }
    if(address.address_2){
        addressAr.push(address.address_2);
    }
    if(address.city){
        addressAr.push(address.city);
    }
    if(address.zip_code){
        addressAr.push(address.zip_code);
    }
    if(address.country){
        addressAr.push(address.country.name);
    }
    

    return addressAr.join(", ");
}