import React, { useState } from "react";
import { Container, Row, Col, Form, Button } from "react-bootstrap";
import { Cart } from "../../types/Cart";
import { convertAddressToDisplayString } from "../../utils/CommonUtills";


type CartStep2AddressProps = {
    cart: Cart
    isSameAddress: boolean
    setIsSameAddress: (value: boolean) => void
}
const CartStep2Address = (props: CartStep2AddressProps) => {
    const { cart,isSameAddress,setIsSameAddress } = props;


    return (<Container className="py-4 bg-body-secondary">
        <Row>
            <Col md={2} sm={12} >
                <p>Delivery Address:</p>
            </Col>
            <Col md={10} sm={12}>
                {cart.shippingAddress?<span className="text-primary">{convertAddressToDisplayString(cart.shippingAddress)}</span>:<span>{"- No Address found-"}</span>}
                <Button variant="danger" className={"ms-2"} size="sm">
            {cart.shippingAddress?"Change":"Add new Address"} 
        </Button>
            </Col>
            
        </Row>
        <Row className="mb-4">
            <Col>
                <Form.Check // prettier-ignore
                    type={'checkbox'}
                    id={``}
                    label={`Use same address for billing`}
                    checked={isSameAddress}
                    onChange={(e) => setIsSameAddress(e.target.checked)}
                />
            </Col>
        </Row>
        {!isSameAddress ? <Row>
            <Col md={2} sm={12} >
                <p>Billing Address:</p>
            </Col>
            <Col md={10} sm={12}>
                {cart.billingAddress?<span className="text-primary">{convertAddressToDisplayString(cart.billingAddress)}</span>:<span>{"- No Address found-"}</span>}
            
                <Button variant="danger" size="sm" className={"ms-2"}>
            {cart.billingAddress?"Change":"Add new Address"} 
        </Button>
            </Col>
           
        </Row> : null}

    </Container>)

}

export default CartStep2Address;