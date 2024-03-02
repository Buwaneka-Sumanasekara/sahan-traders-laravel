import React, { useRef, useState } from 'react'
import Button from 'react-bootstrap/Button';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import { Cart, CartItem } from '../../types/Cart';
import Container from 'react-bootstrap/esm/Container';
import Tooltip from 'react-bootstrap/Tooltip';
import Overlay from 'react-bootstrap/Overlay';
import Icon from '../atoms/Icon';
import CartSummaryRowShipping from '../atoms/CartSummaryShipping';
import BuyerAddressChangeModal from './BuyerAddressChangeModal';
import { AddressType } from '../../types/Common';

const CartSummaryHeader = () => {
    return (
        <Row >
            <Col md={7} sm={12} className='border-bottom py-2'>
                <span className="fw-bold text-primary-emphasis text-uppercase">Cart Total</span>
            </Col>
            <Col md={5} sm={12} className='border-bottom py-2'></Col>
        </Row>

    )
}



const CartSummaryRow = (props: { displayAmount?: string, label: string, toolTip?: string, onPress?: () => void }) => {
    const { displayAmount, label, toolTip, onPress } = props;
    const target = useRef(null);

    const [show, setShow] = useState(false);
    const firstColSize = (displayAmount ? 7 : 12)
    const isButton = !!props.onPress;
    return (
        <Row className='justify-content-end pt-3' onClick={() => onPress?.()}>
            <Col md={firstColSize} sm={12} ref={target} onMouseEnter={() => {
                if (!!toolTip) {
                    setShow(true);
                }
            }} onMouseLeave={() => setShow(false)}>
                <span className={`fw-bold text-primary-emphasis ${isButton ? `text-decoration-underline` : ''} `}>{label}  {!!toolTip && <Icon name={"Info"} size={15} />}</span>

            </Col>
            <Overlay target={target.current} show={toolTip !== "" && show} placement="top">
                {(props) => (
                    <Tooltip id="overlay-example" {...props}>
                        {toolTip}
                    </Tooltip>
                )}
            </Overlay>
            {displayAmount ? <Col md={5} sm={12} className='text-end'>
                <span className="fw-bold text-primary-emphasis ">{displayAmount}</span>
            </Col> : null}

        </Row>
    )
}



const CartSummaryButton = (props: { lable: string, varient: string, onPress: () => void, disabled?: boolean, disableText?: string }) => {

    const { lable, onPress, varient, disabled, disableText } = props;


    return (
        <Row className='justify-content-end pt-3'>
            <Col md={12} sm={12} >
                <div className="d-grid gap-2">
                    <Button variant={varient} onClick={onPress} disabled={disabled}>
                        {lable}
                    </Button>
                    {(disabled && !!disableText) ? <small className="text-danger">{disableText}</small> : null}
                </div>

            </Col>
        </Row>
    )
}



type CartStep2SummaryProps = {
    cart: Cart,
    onPressProceedToCheckout: () => void
    onPressGoBack: () => void
    isSameAddress: boolean
}
const CartStep2Summary = (props: CartStep2SummaryProps) => {

    const { cart, onPressProceedToCheckout, onPressGoBack, isSameAddress } = props;

    const [isVisibleAddressModal, setVisibleAddressModal] = useState(false);


    const noCarrierSelected = !cart.carrierInfo;
    const noAddressFound = !cart.shippingAddressCountry;
    const noBillingAddressFound = !cart.billingAddressCountry;


    function needToDisableNextStep() {
        let isDisabled = false;
        let reason = "";

        if (noAddressFound) {
            isDisabled = true;
            reason = "Update your shipping address to continue";
        }
        else if (noCarrierSelected) {
            isDisabled = true;
            reason = "Select shipping method to continue";
        }
        else if (!isSameAddress && noBillingAddressFound) {
            isDisabled = true;
            reason = "Update your billing address to continue";
        }

        return { isDisabled, reason };
    }


    const { isDisabled, reason } = needToDisableNextStep();
    return (
        <Container>
            <CartSummaryHeader />
            <CartSummaryRow label="Subtotal" displayAmount={cart.displayGrossAmount} />
            <CartSummaryRow label={`Discount (${cart.displayDisPer})`} displayAmount={cart.displayDisPerAmount} />
            <CartSummaryRow toolTip={"Tax will be calculated using the Subtotal amount"} label={`Tax (+ ${cart.displayTaxPer})`} displayAmount={cart.displayTaxAmount} />


            {cart.shippingAddressCountry ? <CartSummaryRowShipping carrierInfo={cart.carrierInfo} amount={cart.displayShippingCost} shippingCountry={cart.shippingAddressCountry} />
                : <CartSummaryRow onPress={() => setVisibleAddressModal(true)} toolTip={"Shipping cost will be calculated using the billing address"} label={`Click here to add Shipping address`} displayAmount={""} />
            }

            <hr />
            <CartSummaryRow label="Total" displayAmount={cart.displayNetAmount} />

            <CartSummaryButton lable="Edit Cart" varient="outline-primary" onPress={onPressGoBack} />


            <CartSummaryButton lable="Place Order" varient="primary" disableText={reason} disabled={isDisabled} onPress={onPressProceedToCheckout} />


            <BuyerAddressChangeModal addressType={AddressType.BOTH} isVisible={isVisibleAddressModal} onHide={() => setVisibleAddressModal(false)} />
        </Container>
    )



}

export default CartStep2Summary

