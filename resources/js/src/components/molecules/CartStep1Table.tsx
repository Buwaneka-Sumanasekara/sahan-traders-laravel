import React, { useRef } from 'react'
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Button from 'react-bootstrap/Button';
import Image from 'react-bootstrap/Image';
import { useFetchCurrentUserCart } from '../../hooks/cart/useFetchCart'
import { useEventListener } from '../../hooks/common/useEventsListner';
import { EventType, LottieAnimationName } from '../../types/Common';
import { CartItem } from '../../types/Cart';
import LottieAnimation from '../atoms/LottieAnimation';
import QtyInput from '../atoms/QtyInput';
import Container from 'react-bootstrap/esm/Container';
import Icon from '../atoms/Icon';
import { Spinner } from 'react-bootstrap';
import Overlay from 'react-bootstrap/Overlay';


const CartHeader = () => {
    return (
        <Row className='border-bottom py-2'>
            <Col md={2}>
                <span className="fw-bold text-primary-emphasis text-uppercase">Product</span>
            </Col>
            <Col md={10}>
                <Row>
                    <Col md={2} >
                        <span className="fw-bold text-primary-emphasis text-uppercase">Price</span>
                    </Col>
                    <Col md={3}><span className="fw-bold text-primary-emphasis text-uppercase">Quantity</span></Col>
                    <Col md={3} className=' d-flex justify-content-end'><span className="fw-bold text-primary-emphasis text-uppercase">Amount</span></Col>
                    <Col md={1}></Col>
                </Row>
            </Col>
        </Row>

    )
}

type CartRowProps = {
    item: CartItem,
    isUpdating?: boolean,
    onChangeQty: (cartItemId: number,productId:string, qty: number, unitGroupId?:string,unitId?: string) => void
    onDeleteItem: (cartItemId: number,productId:string) => void
}
const CartRow = (props: CartRowProps) => {
    const { item, onChangeQty,onDeleteItem } = props;

    const { id,productId, productSlug, productName, productThumbnailImageUrl, displaySellPrice, qty, displayAmount } = item
    return (
        <Row className='border-bottom py-2'>
            <Col md={2}>
                <Image src={productThumbnailImageUrl} width="100" height="100" rounded />
            </Col>
            <Col md={10}>
                <Row>
                    <Col>
                        <a href={`/product/${productSlug}`} className="text-decoration-none"> <p>{productName}</p> </a>
                    </Col>
                </Row>
                <Row className='align-items-center'>
                    <Col md={2} >
                        <span className="fw-bold text-body-secondary">{displaySellPrice}</span>
                    </Col>
                    <Col md={3}><QtyInput
                        qty={qty} disableIncrement={false} disableDecrement={false} onChange={(qty,unitGroupId, unitId) => onChangeQty(id,productId, qty, unitGroupId,unitId)} /></Col>
                    <Col md={3} className=' d-flex justify-content-end'><span>{displayAmount}</span></Col>
                    <Col md={1}><Button variant="danger" onClick={()=>onDeleteItem(id,productId)}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                        </svg>
                    </Button></Col>
                </Row>
            </Col>
        </Row>
    )
}
const CartRowLoading = () => {
    return (
        <Row className='border-bottom py-2 justify-content-md-center'>
            <Col className='col-md-auto'>
                <LottieAnimation width={200} height={200} loop={true} autoPlay={true} animation={LottieAnimationName.LOADING_CART} />
            </Col>
        </Row>
    )
}

type CartStep1TableProps = {
    cartItems: CartItem[],
    isUpdating?: boolean,
    onChangeQty: (cartItemId: number,productId:string, qty: number, unitGroupId?:string,unitId?: string) => void
    onDeleteItem: (cartItemId: number,productId:string) => void
}
const CartStep1Table = (props: CartStep1TableProps) => {

    const { cartItems, isUpdating,onChangeQty,onDeleteItem } = props;
    
    return (
        <Container {...props}>
            <CartHeader />
            
            { cartItems.map((cartItem, index) => (
                <CartRow key={index} item={cartItem} isUpdating={isUpdating} onChangeQty={onChangeQty} onDeleteItem={onDeleteItem} />
            ))}
            {isUpdating && <CartRowLoading />}
        </Container>
    )
}

export default CartStep1Table

