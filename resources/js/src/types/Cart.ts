import { Country } from "./Common";

export enum AddCartButtonType {
    AddToCart = 0,
    BuyNow = 1,
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
    shippingAddressCountry:Country,
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