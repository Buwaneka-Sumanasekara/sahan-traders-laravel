
export interface ProductVariantGroup {
    id: number,
    name: string,
}

export interface ProductVarient {
    id: number,
    name: string,
    stockId:string,
    displaySellPrice:string,
    costPrice:number
    sellPrice:number,
    qty:number,
    typeId:ProductVariantType,
    val:string,
  }

  export interface ProductAdditionalCost {
    id: number,
    name: string,
    amount:number,
    displayAmount:string,
  }

  export enum ProductVariantType {
    Text=0,
    Color=1,
  }

  export type Unit={
    id:number,
    name:string,
    symbol:string,
  }