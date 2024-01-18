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
