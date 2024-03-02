import React, { useEffect, useState } from 'react';
import { Button, Col, Form, ListGroup, Modal, Row, Spinner } from 'react-bootstrap';
import * as formik from 'formik';
import * as yup from 'yup';
import "yup-phone";

import { useFetchShippingCountries } from '../../hooks/shipping/useFetchShipping';
import { AddressType, Country, EventType } from '../../types/Common';
import { useUpdateBuyerAddress } from '../../hooks/buyer/useMutateBuyer';
import { useMutateEventListener, useMutateToastEventListner } from '../../hooks/common/useEventsListner';
import Constants from '../../common/Constants';
import { CartAddress } from '../../types/Cart';


type BuyerAddressChangeModalProps = {
    isVisible: boolean,
    onHide: () => void
    addressType: AddressType
    isUpdate?: boolean
    address?:CartAddress
}
const BuyerAddressChangeModal = (props: BuyerAddressChangeModalProps) => {
    const { isVisible, onHide, addressType, isUpdate,address } = props;

    const { onShowWarningMessage: onShowWarningMessage } = useMutateToastEventListner();


    const { Formik } = formik;

    const schema = yup.object().shape({
        address1: yup.string().required().label("Address 1"),
        address2: yup.string().required().label("Address 2"),
        city: yup.string().required().label("City"),
        zipCode: yup.string().required().label("Zip code"),
        province: yup.string().required().label("Province"),
        countryId: yup.number().required().label("Country"),
        name: yup.string().required().label("Name"),
        contactNumber: yup.string().matches(Constants.REG_EXPRESSIONS.MOBILE_NUMBER, "Invalid mobile number").required().label("Mobile number")
    });


    const { data } = useFetchShippingCountries();
    const { onExecuteEvent: onExecuteEvent } = useMutateEventListener();

    const { mutate: updateBuyerAddress, isLoading: isUpdating } = useUpdateBuyerAddress(() => {
        onHide();
        onExecuteEvent(EventType.EVENT_CART_UPDATED, {})
    },(error)=>{
        onShowWarningMessage({
            message: error.message
        })
    });

    const countries = data || [];




    const addressTypeName=addressType===AddressType.BILLING?"Billing":addressType===AddressType.SHIPPING?"Shipping":"Shipping and Billing";
    return (

        <Modal show={isVisible} aria-labelledby="contained-modal-title-vcenter"
            centered onHide={() => onHide()}>
            <Modal.Header closeButton >
                <Modal.Title>{`${isUpdate ? `Update ${addressTypeName}  Address` : `Add ${addressTypeName} Address`}`}</Modal.Title>

            </Modal.Header>
            <Modal.Body>

                <Formik
                    validationSchema={schema}
                    onSubmit={(values: any) => { updateBuyerAddress({ ...values, addressType: addressType, updateCart: true,isUpdateMultiple:(addressType===AddressType.BOTH) }) }}
                    initialValues={{
                        id: address?.id || 0,
                        address1: address?.address_1 || '',
                        address2: address?.address_2 || '',
                        city: address?.city || '',
                        zipCode: address?.zip_code || '',
                        province: address?.province_name || '',
                        countryId: address?.country.id || '',
                        contactNumber: address?.contact_number || '',
                        name: address?.name || '',
                    }}
                >
                    {({ handleSubmit, handleChange, values, touched, errors }) => (
                        <Form onSubmit={handleSubmit}
                            noValidate
                        >
                            <Row className="mb-3">
                                <Form.Group as={Col} controlId="AddressForm.ContactNo">
                                    <Form.Label>Name</Form.Label>
                                    <Form.Control type="text"
                                        name='name'
                                        placeholder="Name" value={values.name}
                                        onChange={handleChange}
                                        isInvalid={!!errors.name} />

                                    <Form.Control.Feedback type="invalid">
                                        {errors.name as string}
                                    </Form.Control.Feedback>
                                </Form.Group>
                                <Form.Group as={Col} controlId="AddressForm.ContactNo">
                                    <Form.Label>Contact Number (Mobile)</Form.Label>
                                    <Form.Control type="text"
                                        name='contactNumber'
                                        placeholder="Contact Number" value={values.contactNumber}
                                        onChange={handleChange}
                                        isInvalid={!!errors.contactNumber} />

                                    <Form.Control.Feedback type="invalid">
                                        {errors.contactNumber as string}
                                    </Form.Control.Feedback>
                                </Form.Group>
                            </Row>


                            <Form.Group className="mb-3" controlId="AddressForm.Address1">
                                <Form.Label>Address 1</Form.Label>
                                <Form.Control type="text" placeholder="Address 1"
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
                                <Form.Control type="text" placeholder="Address 2" value={values.address2}
                                    onChange={handleChange}
                                    name='address2'
                                    isInvalid={!!errors.address2} />
                                <Form.Control.Feedback type="invalid">
                                    {errors.address2 as string}
                                </Form.Control.Feedback>
                            </Form.Group>
                            <Row className="mb-3">
                                <Form.Group as={Col} controlId="AddressForm.City">
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
                                <Form.Group as={Col} controlId="AddressForm.ZipCode">
                                    <Form.Label>Zip code</Form.Label>
                                    <Form.Control type="text" name='zipCode' placeholder="Zip code" value={values.zipCode}
                                        onChange={handleChange}
                                        isInvalid={!!errors.zipCode} />
                                    <Form.Control.Feedback type="invalid">
                                        {errors.zipCode as string}
                                    </Form.Control.Feedback>
                                </Form.Group>
                            </Row>
                            <Row className="mb-3">
                                <Form.Group as={Col} controlId="AddressForm.Province">
                                    <Form.Label>Province name</Form.Label>
                                    <Form.Control type="text" name='province' placeholder="Province" value={values.province}
                                        onChange={handleChange}
                                        isInvalid={!!errors.province} />
                                    <Form.Control.Feedback type="invalid">
                                        {errors.province as string}
                                    </Form.Control.Feedback>
                                </Form.Group>
                                <Form.Group as={Col} controlId="AddressForm.Country">
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
                            </Row>

                            <Row className='mt-4'>
                                            <Col>
                                    {!isUpdating ? <React.Fragment>

                                        <Button variant="primary" type='submit'  >
                                            Save Changes
                                        </Button>
                                    </React.Fragment> : <Spinner animation="border" variant="primary" />}
                                    </Col>
                            </Row>
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