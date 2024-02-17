import React, { useEffect, useState } from 'react'
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Button from 'react-bootstrap/Button';
import CountryLabel from './CountryLabel';
import { Country, EventType } from '../../types/Common';
import { useFetchShippingRates } from '../../hooks/shipping/useFetchShipping';
import { ShippingCarrier } from '../../types/Cart';
import { Badge, Form, ListGroup, Modal } from 'react-bootstrap';
import { useUpdateCartCarrier } from '../../hooks/cart/useMutateCart';
import { useMutateEventListener } from '../../hooks/common/useEventsListner';


type CartCarrierChangeModalProps = {
    isVisible: boolean,
    onHide: () => void,
    carrierInfo: ShippingCarrier
    onChangeCarrier: (carrier: ShippingCarrier) => void
}
const CartCarrierChangeModal = (props: CartCarrierChangeModalProps) => {
    const { isVisible, onHide, carrierInfo, onChangeCarrier } = props;
    const [selectedCarrier, setSelectedCarrier] = useState<ShippingCarrier | null>(carrierInfo);
    const { data: carriers } = useFetchShippingRates();

    useEffect(() => {
        if (!!carrierInfo) {
            setSelectedCarrier(carrierInfo)
        }
    }, [carrierInfo, isVisible])

    const onSave = (carrier: ShippingCarrier) => {
        onChangeCarrier(carrier);
        onHide();
    }
    return (
        <Modal show={isVisible} aria-labelledby="contained-modal-title-vcenter"
            centered>
            <Modal.Header closeButton>
                <Modal.Title>Choose carrier</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <ListGroup>
                    {!!carriers && (carriers || []).map((carrier: ShippingCarrier) => (
                        <ListGroup.Item as="li" key={`shipping-carrier-${carrier.uniqueId}`}
                            className="d-flex justify-content-between align-items-start">
                            <div className="ms-2 me-auto">
                                <Form.Check
                                    type="radio"
                                    id={`shipping-carrier-${carrier.uniqueId}`}
                                    name="shipping-carrier"
                                    label={`${carrier.displayService}`}
                                    checked={selectedCarrier?.uniqueId === carrier.uniqueId}
                                    onChange={() => setSelectedCarrier(carrier)}
                                />
                            </div>
                            <Badge bg="primary" pill>
                                {`${carrier.displayShippingCost}`}
                            </Badge>
                        </ListGroup.Item>
                    ))}
                </ListGroup>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={() => onHide()}>
                    Close
                </Button>
                <Button variant="primary" onClick={() => {
                    if (!!selectedCarrier) {
                        onSave(selectedCarrier)
                    }
                }}>
                    Save Changes
                </Button>
            </Modal.Footer>
        </Modal>

    )
}

type CartSummaryRowShippingCarrierProps = {
    carrierInfo: ShippingCarrier
}
const CartSummaryRowShippingCarrier = (props: CartSummaryRowShippingCarrierProps) => {
    const { carrierInfo } = props;

    const { onExecuteEvent: onExecuteEvent } = useMutateEventListener();

    const { mutate: updateCarrier, isLoading: isCalculating } = useUpdateCartCarrier(() => {
        onExecuteEvent(EventType.EVENT_CART_UPDATED, {
        })
    });

    const [isVisibleModal, setVisibleModal] = useState(false);
    return (
        <Row className='justify-content-end pt-2' >
            {isCalculating ? <Col md={8} sm={12} >
                <span className="fw-bold text-info">{"Calculating..."}</span><br />

            </Col> : <React.Fragment>
                <Col md={8} sm={12} >
                    <span className="fw-bold text-info">{`( ${carrierInfo.displayService} )`}</span><br />
                </Col>
                <Col md={4} sm={12} className='text-end'>
                    <Button variant="primary" className="p-1" size="sm" onClick={() => {
                        setVisibleModal(true)
                    }}>
                        {"Change"}
                    </Button>
                </Col>
            </React.Fragment>}


            <CartCarrierChangeModal
                isVisible={isVisibleModal}
                onHide={() => setVisibleModal(false)} carrierInfo={carrierInfo}
                onChangeCarrier={(carrier: ShippingCarrier) => {
                    updateCarrier({
                        carrierId: carrier.uniqueId
                    })
                }}
            />
        </Row>
    )
}





type CartSummaryRowShippingProps = {
    amount: string,
    shippingCountry: Country,
    carrierInfo: ShippingCarrier | null
}
const CartSummaryRowShipping = (props: CartSummaryRowShippingProps) => {
    const { amount, shippingCountry, carrierInfo } = props;


    return (
        <React.Fragment>

            <Row className='justify-content-end pt-3' >

                <Col md={7} sm={12} >
                    <span className="fw-bold text-primary-emphasis ">{"Shipping Cost"}</span><br />
                    <CountryLabel name={shippingCountry.name} countryCode={shippingCountry.courierCode} />
                </Col>
                <Col md={5} sm={12} className='text-end'>
                    <span className="fw-bold text-primary-emphasis ">{amount}</span>
                </Col>


            </Row>

            {!!carrierInfo ? <CartSummaryRowShippingCarrier carrierInfo={carrierInfo} /> : null}
        </React.Fragment>

    )
}

export default CartSummaryRowShipping