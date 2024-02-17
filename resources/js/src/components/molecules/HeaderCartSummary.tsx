import React from 'react';
import { useFetchCurrentUserCart } from '../../hooks/cart/useFetchCart';
import { useQueryClient } from 'react-query';
import { useEventListener } from '../../hooks/common/useEventsListner';
import { EventType } from '../../types/Common';

type HeaderCartSummaryProps={

}


const HeaderCartSummary  = (props:HeaderCartSummaryProps) => {

    const queryClient=useQueryClient();


    const {data:currentCart}=useFetchCurrentUserCart();
    useEventListener(EventType.EVENT_CART_UPDATED)

   

    const cartHed=currentCart?.hed || {}
    const cartItemsAmount=cartHed?.displayNetAmount || "0";
    const cartItemsCount=cartHed?.itemsCount || 0


    const onClickCart=()=>{
        window.open(`/cart`, '_self');
    }


    return (
        <>
             <div className="d-flex align-self-center me-4">
                <button type="button" className="btn btn-outline-secondary position-relative rounded" onClick={onClickCart}>
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
            <div className="d-flex flex-column justify-content-center" onClick={onClickCart}>
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