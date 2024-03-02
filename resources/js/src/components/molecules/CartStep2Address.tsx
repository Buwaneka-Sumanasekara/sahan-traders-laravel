import React, { useState } from "react";
import { Container, Row, Col, Form, Button } from "react-bootstrap";
import { Cart } from "../../types/Cart";
import { convertAddressToDisplayString } from "../../utils/CommonUtills";
import { AddressType } from "../../types/Common";
import BuyerAddressChangeModal from "./BuyerAddressChangeModal";


type CartStep2AddressProps = {
    cart: Cart
    isSameAddress: boolean
    setIsSameAddress: (value: boolean) => void
}
const CartStep2Address = (props: CartStep2AddressProps) => {
    const { cart, isSameAddress, setIsSameAddress } = props;

    const [isVisibleAddressModal, setVisibleAddressModal] = useState(false);
    const [addressType, setAddressType] = useState<AddressType>((isSameAddress ? AddressType.BOTH : AddressType.SHIPPING));


    const showModal = (type: AddressType) => {
        setAddressType(type);
        setVisibleAddressModal(true);
    }

    console.log("cart", cart)
    return (<Container className="py-4 bg-body-secondary">
        <Row>
            <Col md={2} sm={12} >
                <p>Delivery Address:</p>
            </Col>
            <Col md={10} sm={12}>
                <Row>
                    <Col>
                        {cart.shippingAddress ? <span className="text-primary">{`${cart.shippingAddress?.name || ""}   ${cart.shippingAddress?.contact_number}`}</span> : <span>{""}</span>}
                    </Col>
                </Row>
                <Row>
                    <Col>
                        {cart.shippingAddress ? <span className="text-primary">{convertAddressToDisplayString(cart.shippingAddress)}</span> : <span>{"- No Address found-"}</span>}
                        <Button variant="danger" className={"ms-2"} size="sm" onClick={() => showModal(isSameAddress ? AddressType.BOTH : AddressType.SHIPPING)}>
                            {cart.shippingAddress ? "Change" : "Add new Address"}
                        </Button>
                    </Col>
                </Row>
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

                <Row>
                    <Col>
                        {cart.billingAddress ? <span className="text-primary">{`${cart.billingAddress?.name || ""}   ${cart.billingAddress?.contact_number}`}</span> : <span>{""}</span>}
                    </Col>
                </Row>
                <Row>
                    <Col>
                        {cart.billingAddress ? <span className="text-primary">{convertAddressToDisplayString(cart.billingAddress)}</span> : <span>{"- No Address found-"}</span>}
                        <Button variant="danger" size="sm" className={"ms-2"} onClick={() => showModal(AddressType.BILLING)}>
                            {cart.billingAddress ? "Change" : "Add new Address"}
                        </Button>
                    </Col>
                </Row>

            </Col>

        </Row> : null}

        <BuyerAddressChangeModal
            isVisible={isVisibleAddressModal}
            onHide={() => setVisibleAddressModal(false)}
            addressType={addressType}
            address={addressType === AddressType.BILLING ? cart.billingAddress : cart.shippingAddress}
            isUpdate={addressType === AddressType.BILLING ? !!cart.billingAddress : !!cart.shippingAddress}
        />
    </Container>)

}

export default CartStep2Address;