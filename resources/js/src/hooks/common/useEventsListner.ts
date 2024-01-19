import React,{useEffect,useState} from 'react';
import { EventType, ToastProps } from '../../types/Common';
import { useQueryClient } from 'react-query';
import QueryKeys from '../../common/QueryKeys';



export const useEventListener = (type:EventType) => {

    const [data,setData]=useState({});

    const queryClient = useQueryClient();
    useEffect(() => {
        // Add event listener when the component mounts
        window.addEventListener(type, handleCustomEvent);
        // Remove event listener when the component unmounts
        return () => {
          window.removeEventListener(type, handleCustomEvent);
        };
    }, [type]); // Empty dependency array ensures that the effect runs once on mount
    

    function handleCustomEvent(event) {
        console.log('Custom event received:',type, event.detail);
       if(type===EventType.EVENT_CART_UPDATED){
        const {productId}=event.detail;
        queryClient.invalidateQueries([QueryKeys.CART_CURRENT])
        queryClient.invalidateQueries([QueryKeys.PRODUCT_PRICE_INFO,productId])
        queryClient.invalidateQueries({
            queryKey: [QueryKeys.PRODUCT_LIST],
        })
       }   
    }
    return {data:data}
}


export const useMutateEventListener = () => {
    function onExecuteEvent(type:EventType, data:object){
        window.dispatchEvent(new CustomEvent(type, { detail: { time: new Date(),...data } }));
    }
    return {onExecuteEvent:onExecuteEvent}
}


export const useMutateToastEventListner = () => {
    function onShowMessage( data:ToastProps){
        window.dispatchEvent(new CustomEvent(EventType.SHOW_TOAST_MESSAGE, { detail: { time: new Date(),...data,type:"info" } }));   
    }
    function onShowErrorMessage( data:ToastProps){
        window.dispatchEvent(new CustomEvent(EventType.SHOW_TOAST_MESSAGE, { detail: { time: new Date(),...data,type:"error" } }));   
    }
    function onShowWarningMessage( data:ToastProps){
        window.dispatchEvent(new CustomEvent(EventType.SHOW_TOAST_MESSAGE, { detail: { time: new Date(),...data,type:"warning" } }));   
    }
    function onShowSuccessMessage( data:ToastProps){
        window.dispatchEvent(new CustomEvent(EventType.SHOW_TOAST_MESSAGE, { detail: { time: new Date(),...data,type:"success" } }));   
    }

    return {onShowMessage,onShowErrorMessage,onShowWarningMessage,onShowSuccessMessage}
}

export const useToastEventListener = (onShowToast:(props:ToastProps)=>void) => {
    useEffect(() => {
        // Add event listener when the component mounts
        window.addEventListener(EventType.SHOW_TOAST_MESSAGE, handleCustomEvent);
        // Remove event listener when the component unmounts
        return () => {
          window.removeEventListener(EventType.SHOW_TOAST_MESSAGE, handleCustomEvent);
        };
    }, []); // Empty dependency array ensures that the effect runs once on mount
    

    function handleCustomEvent(event) {
        const {type,message,...otherProps}=event.detail; 
        onShowToast({
            message:message,
            type:type || 'error',
            ...otherProps
        });
    }
}