import React, { useEffect, useState } from 'react';
import { Button, Col, Form, ListGroup, Modal, Row, Spinner } from 'react-bootstrap';
import * as formik from 'formik';
import * as yup from 'yup';

import { useFetchShippingCountries } from '../../hooks/shipping/useFetchShipping';
import { AddressType, Country, EventType } from '../../types/Common';
import { useUpdateBuyerAddress } from '../../hooks/buyer/useMutateBuyer';
import { useMutateEventListener } from '../../hooks/common/useEventsListner';


type BuyerAddressChangeModalProps = {
    isVisible: boolean,
    onHide: () => void
}
const BuyerAddressChangeModal = (props: BuyerAddressChangeModalProps) => {
    const { isVisible, onHide } = props;

    const [address1, setAddress1] = useState('');
    const [address2, setAddress2] = useState('');
    const [city, setCity] = useState('');
    const [zipCode, setZipCode] = useState('');
    const [province, setProvince] = useState('');
    const [countryId, setCountryId] = useState('');

    const { Formik } = formik;

    const schema = yup.object().shape({
        address1: yup.string().required(),
        address2: yup.string().required(),
        city: yup.string().required(),
        zipCode: yup.string().required(),
        province: yup.string().required(),
        countryId: yup.number().required(),
    });


    const { data } = useFetchShippingCountries();
    const { onExecuteEvent: onExecuteEvent } = useMutateEventListener();

    const { mutate: updateBuyerAddress, isLoading: isUpdating } = useUpdateBuyerAddress(() => {
        onHide();
        onExecuteEvent(EventType.EVENT_CART_UPDATED, {})
    });

    const countries = data || [];


  

    return (

        <Modal show={isVisible} aria-labelledby="contained-modal-title-vcenter"
            centered>
            <Modal.Header closeButton>
                <Modal.Title>Add your shipping Address</Modal.Title>

            </Modal.Header>
            <Modal.Body>

                <Formik
                    validationSchema={schema}
                    onSubmit={(values: any) => { updateBuyerAddress({ ...values, addressType: AddressType.SHIPPING,updateCart:true })}}
                    initialValues={{
                        address1: '',
                        address2: '',
                        city: '',
                        zipCode: '',
                        province: '',
                        countryId: '',
                    }}
                >
                    {({ handleSubmit, handleChange, values, touched, errors }) => (
                        <Form onSubmit={handleSubmit}
                            noValidate
                        >
                            <Form.Group className="mb-3" controlId="AddressForm.Address1">
                                <Form.Label>Address 1</Form.Label>
                                <Form.Control type="text" placeholder="Address1"
                                    name='address1'
                                    onChange={handleChange}
                                    isInvalid={!!errors.address1}
                                    value={values.address1}
                                />
                                <Form.Control.Feedback type="invalid">
                                    {errors.address1 as string}
                                </Form.Control.Feedback>
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="AddressForm.Address2">
                                <Form.Label>Address 2</Form.Label>
                                <Form.Control type="text" placeholder="Address2" value={values.address2}
                                    onChange={handleChange}
                                    name='address2'
                                    isInvalid={!!errors.address2} />
                                <Form.Control.Feedback type="invalid">
                                    {errors.address2 as string}
                                </Form.Control.Feedback>
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="AddressForm.City">
                                <Form.Label>City</Form.Label>
                                <Form.Control type="text"
                                    name='city'
                                    placeholder="City" value={values.city}
                                    onChange={handleChange}
                                    isInvalid={!!errors.city} />

                                <Form.Control.Feedback type="invalid">
                                    {errors.city as string}
                                </Form.Control.Feedback>
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="AddressForm.ZipCode">
                                <Form.Label>Zip code</Form.Label>
                                <Form.Control type="text" name='zipCode' placeholder="Zip code" value={values.zipCode}
                                    onChange={handleChange}
                                    isInvalid={!!errors.zipCode} />
                                <Form.Control.Feedback type="invalid">
                                    {errors.zipCode as string}
                                </Form.Control.Feedback>
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="AddressForm.Province">
                                <Form.Label>Province name</Form.Label>
                                <Form.Control type="text" name='province' placeholder="Province" value={values.province}
                                    onChange={handleChange}
                                    isInvalid={!!errors.province} />
                                <Form.Control.Feedback type="invalid">
                                    {errors.province as string}
                                </Form.Control.Feedback>
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="AddressForm.Country">
                                <Form.Label>Country</Form.Label>
                                <Form.Select aria-label="Select country" name='countryId' value={values.countryId}
                                    isInvalid={!!errors.countryId}
                                    onChange={handleChange}
                                    isValid={touched.countryId && !errors.countryId} >
                                    {countries.map((country: Country) => (
                                        <option value={`${country.id}`}>{country.name}</option>
                                    ))}

                                </Form.Select>

                                <Form.Control.Feedback type="invalid">
                                    {errors.countryId as string}
                                </Form.Control.Feedback>
                            </Form.Group>
                            {!isUpdating ? <React.Fragment>
                                <Button variant="secondary" className='me-2' type='button' onClick={() => onHide()}>
                                    Close
                                </Button>
                                <Button variant="primary" type='submit'  >
                                    Save Changes
                                </Button>
                            </React.Fragment> : <Spinner animation="border" variant="primary" />}
                        </Form>
                    )}
                </Formik >

            </Modal.Body>
            <Modal.Footer>


            </Modal.Footer>
        </Modal>


    )
}

export default BuyerAddressChangeModal;