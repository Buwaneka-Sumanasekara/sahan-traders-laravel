import React, { useState } from 'react'
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Container from 'react-bootstrap/Container';
import { useFetchCurrentUserCart } from '../../hooks/cart/useFetchCart'
import { useEventListener, useMutateEventListener, useMutateToastEventListner } from '../../hooks/common/useEventsListner';
import { EventType, GeneralServerError, ToastProps } from '../../types/Common';
import CartStep1Table from '../molecules/CartStep1Table';
import CartStep1Empty from '../molecules/CartStep1Empty';
import CartStep1Summary from '../molecules/CartStep1Summary';
import { useDeleteCartItem, useUpdateCartItem } from '../../hooks/cart/useMutateCart';
import { CartSteps } from '../../types/Cart';
import CartStep2Summary from '../molecules/CartStep2Summary';
import CartStep2Address from '../molecules/CartStep2Address';



/*========================== Cart Step 1===================================*/
type CartStep1Props = {
    data: any,
    onExecuteEvent: (type: EventType, data: any) => void
    onShowWarningMessage: (props: ToastProps) => void,
    onPressRedirectHome: () => void
    onPressProceedToCheckout: () => void
}

const CartStep1 = (props: CartStep1Props) => {
    const { data, onExecuteEvent, onShowWarningMessage, onPressRedirectHome, onPressProceedToCheckout } = props;

    const { mutate: onUpdateQty, isLoading: isUpdating } = useUpdateCartItem(onSuccessUpdateCartItem, onErrorUpdateCart);

    const { mutate: onRemoveCartItem, isLoading: isDeleting } = useDeleteCartItem(onSuccessUpdateCartItem, onErrorUpdateCart);

    function onSuccessUpdateCartItem(data: any, variables: any) {
        onExecuteEvent(EventType.EVENT_CART_UPDATED, {
            productId: variables?.productId,
        })
    }

    function onErrorUpdateCart(er: GeneralServerError) {
        onShowWarningMessage({
            message: er.message,
        })

    }

    const onChangeQty = (cartItemId: number, productId: string, qty: number, unitGroupId?: string, unitId?: string) => {
        onUpdateQty({
            productId: productId,
            id: cartItemId.toString(),
            qty: qty,
            unitGroupId: unitGroupId,
            unitId: unitId
        })
    }
    const onDeleteItem = (cartItemId: number, productId: string) => {
        onRemoveCartItem({
            productId: productId,
            id: cartItemId.toString(),
        })
    }

    return (<Container>
        <Row className="justify-content-md-space-between">
            <Col md={8} sm={12}>
                <CartStep1Table isEditable={true} cartItems={data.det} isUpdating={isUpdating || isDeleting} onChangeQty={onChangeQty} onDeleteItem={onDeleteItem} />
            </Col>
            <Col md={{ span: 3, offset: 1 }} sm={12} >
                <CartStep1Summary cart={data.hed} onPressRedirectHome={onPressRedirectHome} onPressProceedToCheckout={onPressProceedToCheckout} />
            </Col>
        </Row>
    </Container>)
}

/*========================== Cart Step 2===================================*/
type CartStep2Props = {
    data: any,
    onExecuteEvent: (type: EventType, data: any) => void
    onShowWarningMessage: (props: ToastProps) => void
    onPressGoBack: () => void
    onPressProceedToCheckout: () => void
}

const CartStep2 = (props: CartStep2Props) => {
    const { data, onExecuteEvent, onPressProceedToCheckout, onPressGoBack } = props;


    const [isSameAddress, setIsSameAddress] = useState(true);

    return (<Container>
        <Row className="justify-content-md-space-between">
            <Col md={8} sm={12}>
                <Row>
                    <Col>
                        <CartStep2Address  isSameAddress={isSameAddress} setIsSameAddress={setIsSameAddress} cart={data.hed} />
                    </Col>
                </Row>
                <br/>
                <Row>
                    <Col>
                        <CartStep1Table cartItems={data.det} isEditable={false} />
                    </Col>
                </Row>
            </Col>
            <Col md={{ span: 3, offset: 1 }} sm={12} >
                <CartStep2Summary  cart={data.hed} isSameAddress={isSameAddress} onPressProceedToCheckout={onPressProceedToCheckout} onPressGoBack={onPressGoBack} />
            </Col>
        </Row>
    </Container>)
}


const Cart = () => {
    const [cartSteps, setCartSetp] = useState(CartSteps.Step1);
    const { data } = useFetchCurrentUserCart();
    useEventListener(EventType.EVENT_CART_UPDATED)
    const { onExecuteEvent: onExecuteEvent } = useMutateEventListener();
    const isLoading = !data;

    const { onShowWarningMessage: onShowWarningMessage } = useMutateToastEventListner();


    const onPressRedirectHome = () => {
        window.open(`/`, '_self');
    }

    if (isLoading) {
        return <div>Loading...</div>
    } else if (!isLoading && data.det.length === 0) {
        return (<CartStep1Empty />)
    } else {
        if (cartSteps === CartSteps.Step1) {
            return (<CartStep1 data={data} onExecuteEvent={onExecuteEvent}
                onPressProceedToCheckout={() => setCartSetp(CartSteps.Step2Summary)}
                onPressRedirectHome={onPressRedirectHome}
                onShowWarningMessage={onShowWarningMessage} />)
        } else if (cartSteps === CartSteps.Step2Summary) {
            return (<CartStep2 data={data}
                onExecuteEvent={onExecuteEvent}
                onPressGoBack={() => setCartSetp(CartSteps.Step1)}
                onShowWarningMessage={onShowWarningMessage}
                onPressProceedToCheckout={() => setCartSetp(CartSteps.Step3Payment)}

            />)
        } else {
            return null
        }

    }

}

export default Cart

