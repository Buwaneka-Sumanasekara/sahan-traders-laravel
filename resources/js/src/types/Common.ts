

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
    type?:'error'|'success'|'info'|'warning'
}


export enum LottieAnimationName{
    EMPTY_CART="empty-cart",
}

export type IconProps={
    name:string,
    color?:string,
    size?:number,
}