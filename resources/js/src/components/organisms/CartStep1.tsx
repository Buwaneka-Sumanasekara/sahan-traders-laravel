import React from 'react'
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Container from 'react-bootstrap/Container';
import { useFetchCurrentUserCart } from '../../hooks/cart/useFetchCart'
import { useEventListener } from '../../hooks/common/useEventsListner';
import { EventType } from '../../types/Common';
import CartStep1Table from '../molecules/CartStep1Table';
import CartStep1Empty from '../molecules/CartStep1Empty';
import CartStep1Summary from '../molecules/CartStep1Summary';


const CartStep1 = () => {
    const { data } = useFetchCurrentUserCart();
    useEventListener(EventType.EVENT_CART_UPDATED)

    const isLoading = !data;

    console.log("data", data)

    if (isLoading) {
        return <div>Loading...</div>
    } else if (!isLoading && data.det.length === 0) {
        return (<CartStep1Empty />)
    } else {
        return (<Container>
            <Row className="justify-content-md-space-between">
                <Col md={8} sm={12}>
                    <CartStep1Table cartItems={data.det} />
                </Col>
                <Col md={{ span: 3, offset: 1 }} sm={12} >
                    <CartStep1Summary cart={data.hed} carItems={data.det} />
                </Col>
            </Row>
        </Container>)

    }

}

export default CartStep1

