import React from 'react'
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import { useFetchCurrentUserCart } from '../../hooks/cart/useFetchCart'
import { useEventListener } from '../../hooks/common/useEventsListner';
import { EventType, LottieAnimationName } from '../../types/Common';
import { CartItem } from '../../types/Cart';
import LottieAnimation from '../atoms/LottieAnimation';


type CartStep1EmptyProps = {

}
const CartStep1Empty = (props: CartStep1EmptyProps) => {



    const onClickRedirectToHome = () => {
        window.open(`/`, '_self');
    }


    return <React.Fragment>
        <Row className='justify-content-center'>
            <Col className='col-md-auto'>
                <LottieAnimation
                    autoPlay={true} loop={true}
                    width={200} height={200}
                    animation={LottieAnimationName.EMPTY_CART} />

                <p>Your cart is empty , Do you want to buy something?</p>
            </Col>
        </Row>
        <Row className='justify-content-center'>
            <Col className='col-md-auto'>
                <Button className='my-auto' variant="primary" onClick={onClickRedirectToHome}>Expore products</Button>
            </Col>
        </Row>
    </React.Fragment>


}

export default CartStep1Empty

