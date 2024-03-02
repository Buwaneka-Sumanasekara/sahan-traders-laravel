import { Country } from "./Common";

export enum AddCartButtonType {
    AddToCart = 0,
    BuyNow = 1,
}

export enum CartSteps{
    Step1=1,
    Step2Summary=2,
    Step3Payment=3
}

export interface Cart{
    id:string,
    displayNetAmount:string,
    displayGrossAmount:string,
    taxPer:number,
    displayShippingAmount:string,
    disPer:number,
    trackingNumber:string,
    carrierInfo:ShippingCarrier,
    displayDisPer:string
    displayDisPerAmount:string,
    displayShippingCost:string,
    displayTaxPer:string,
    displayTaxAmount:string,
    shippingAddressCountry?:Country,
    shippingAddress?:CartAddress,
    billingAddress?:CartAddress,
    billingAddressCountry?:Country,
}

export interface CartItem {
    id: number;
    productId:string,
    productName: string;
    productSlug:string,
    displaySellPrice: string;
    displayAmount: string;
    productThumbnailImageUrl: string;
    qty: number;
}


export interface ShippingCarrier {
    uniqueId: string;
    carrier_id: string;
    carrier: string;
    service: string;
    currency: string;
    price: number;
    displayService: string;
    displayShippingCost: string;
}



export type CartAddress={
    id:number,
    name:string,
    city:string,
    country:Country,
    zip_code:string,
    address_1:string,
    address_2:string,
    province_name:string,
    contact_number:string,
}