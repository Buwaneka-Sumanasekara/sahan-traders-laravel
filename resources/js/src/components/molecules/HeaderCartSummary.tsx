import React, { useState,useEffect } from 'react';
import CustomEvents from '../../common/CustomEvents';
import { useFetchCurrentUserCart } from '../../hooks/cart/useFetchCart';
import { useQueryClient } from 'react-query';
import QueryKeys from '../../common/QueryKeys';

type HeaderCartSummaryProps={

}


const HeaderCartSummary  = (props:HeaderCartSummaryProps) => {

    const queryClient=useQueryClient();


    const {data:currentCart}=useFetchCurrentUserCart();

    console.log("currentCart",currentCart)

    const cartHed=currentCart?.hed || {}
    const cartItemsAmount=cartHed?.displayNetAmount || "0";
    const cartItemsCount=cartHed?.itemsCount || 0

    useEffect(() => {
        const handleCustomEvent = (event) => {
          // Handle the custom event here
          console.log('Custom event received:', event.detail);
         // setCount(event.detail.id)
         queryClient.invalidateQueries([QueryKeys.CART_CURRENT])
        };
    
        // Add event listener when the component mounts
        window.addEventListener(CustomEvents.EVENT_CART_UPDATED, handleCustomEvent);
    
        // Remove event listener when the component unmounts
        return () => {
          window.removeEventListener(CustomEvents.EVENT_CART_UPDATED, handleCustomEvent);
        };
    }, []); // Empty dependency array ensures that the effect runs once on mount
    


    return (
        <>
             <div className="d-flex align-self-center me-4">
                <button type="button" className="btn btn-outline-secondary position-relative rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-bag"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                    </svg>
                    <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <span id="header_cart_items_count">{`${cartItemsCount}`}</span>
                    </span>
                </button>
            </div>
            <div className="d-flex flex-column justify-content-center">
                <div className="text-body-tertiary">
                    Shopping Cart
                </div>
                <div className="text-body-tertiary">
                   {`${cartItemsAmount}`}
                </div>
                <div id="jsx-test"></div>
            </div>
        </>
    )
}

export default HeaderCartSummary;