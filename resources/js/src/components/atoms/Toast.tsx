import React from 'react';
import { useToastEventListener } from '../../hooks/common/useEventsListner';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { ToastProps } from '../../types/Common';


const Toast = () => {

    useToastEventListener(({type,message,position}:ToastProps)=>{toast(message,{
        position: position?position:"top-right",
        autoClose: 5000,
        hideProgressBar: true,
        closeOnClick: true,
        pauseOnHover: true,
        type:type,
    })})

    return (
        <ToastContainer theme="colored"/>
    )
}

export default Toast

