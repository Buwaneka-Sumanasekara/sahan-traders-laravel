import React from 'react'
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Container from 'react-bootstrap/Container';
import { useFetchCurrentUserCart } from '../../hooks/cart/useFetchCart'
import { useEventListener, useMutateEventListener, useMutateToastEventListner } from '../../hooks/common/useEventsListner';
import { EventType, GeneralServerError } from '../../types/Common';
import CartStep1Table from '../molecules/CartStep1Table';
import CartStep1Empty from '../molecules/CartStep1Empty';
import CartStep1Summary from '../molecules/CartStep1Summary';
import { useDeleteCartItem, useUpdateCartItem } from '../../hooks/cart/useMutateCart';


const CartStep1 = () => {
    const { data } = useFetchCurrentUserCart();
    useEventListener(EventType.EVENT_CART_UPDATED)
    const {onExecuteEvent:onExecuteEvent}=useMutateEventListener();
    const isLoading = !data;
    const {onShowWarningMessage:onShowWarningMessage}=useMutateToastEventListner();


    const {mutate:onUpdateQty,isLoading:isUpdating}=useUpdateCartItem(onSuccessUpdateCartItem,onErrorUpdateCart);

    const {mutate:onRemoveCartItem,isLoading:isDeleting}=useDeleteCartItem(onSuccessUpdateCartItem,onErrorUpdateCart);

    function onSuccessUpdateCartItem(data: any,variables:any) {
        onExecuteEvent(EventType.EVENT_CART_UPDATED,{
            productId: variables?.productId,
        })
    }

    function onErrorUpdateCart(er: GeneralServerError) {
        console.log(er);
        onShowWarningMessage({
            message: er.message,
        })
       
    }

    const onChangeQty = (cartItemId: number,productId:string, qty: number,unitGroupId?:string, unitId?: string) => {
        onUpdateQty({
            productId:productId,
            id: cartItemId.toString(),
            qty: qty,
            unitGroupId:unitGroupId,
            unitId:unitId
        })
    }
    const onDeleteItem = (cartItemId: number,productId:string) => {
        console.log("onDeleteItem", cartItemId)
        onRemoveCartItem({
            productId:productId,
            id: cartItemId.toString(),
        })
    }
console.log("data:cart",data)

    if (isLoading) {
        return <div>Loading...</div>
    } else if (!isLoading && data.det.length === 0) {
        return (<CartStep1Empty />)
    } else {
        return (<Container>
            <Row className="justify-content-md-space-between">
                <Col md={8} sm={12}>
                    <CartStep1Table cartItems={data.det} isUpdating={isUpdating || isDeleting} onChangeQty={onChangeQty} onDeleteItem={onDeleteItem} />
                </Col>
                <Col md={{ span: 3, offset: 1 }} sm={12} >
                    <CartStep1Summary cart={data.hed} carItems={data.det} />
                </Col>
            </Row>
        </Container>)

    }

}

export default CartStep1

