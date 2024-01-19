

export interface GeneralServerError {
    message: string
    type?: string
    code?: string
}

export enum EventType{
    EVENT_CART_UPDATED='EVENT_CART_UPDATED',
    SHOW_TOAST_MESSAGE='SHOW_TOAST_MESSAGE',
}

export type ToastProps={
    message:string,
    type?:'error'|'success'|'info'|'warning',
    position?:'top-right'|'top-left'|'bottom-right'|'bottom-left'|'top-center'|'bottom-center' ,
}


export enum LottieAnimationName{
    EMPTY_CART="empty-cart",
    LOADING_CART="loading-cart",
}

export type IconProps={
    name:string,
    color?:string,
    size?:number,
}

export type RedirectProps={
    onErrorCallBack?:(x: GeneralServerError) => void,
    productId?:string,
    errorObject:any,
}

export type Country={
    name:string,
    code:string,
}