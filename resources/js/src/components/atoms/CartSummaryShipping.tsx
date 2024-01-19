import React, { useRef, useState } from 'react'
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Tooltip from 'react-bootstrap/Tooltip';
import Overlay from 'react-bootstrap/Overlay';
import Icon from '../atoms/Icon';
import CountryLabel from './CountryLabel';
import { Country } from '../../types/Common';

type CartSummaryRowShippingProps = {
    amount: string,
    shippingCountry:Country
}
const CartSummaryRowShipping = (props: CartSummaryRowShippingProps) => {
    const { amount,shippingCountry } = props;

    return (
        <Row className='justify-content-end pt-3' >
            <Col md={7} sm={12} >
                <span className="fw-bold text-primary-emphasis ">{"Shipping Cost"}</span><br/> 
                <CountryLabel name={shippingCountry.name} countryCode={shippingCountry.courierCode} />
            </Col>
            <Col md={5} sm={12} className='text-end'>
                <span className="fw-bold text-primary-emphasis ">{amount}</span>
            </Col>
        </Row>
    )
}

export default CartSummaryRowShipping