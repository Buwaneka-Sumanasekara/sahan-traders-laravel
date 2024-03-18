import React from "react";
import { Col, Container, Row, Button } from "react-bootstrap";
import {
    Elements,
    CardElement,
    PaymentElement,
  } from "@stripe/react-stripe-js";
  import { loadStripe } from "@stripe/stripe-js";

const CartPayment = () => {
    console.log('CartPayment')
    const stripe = loadStripe(
        "pk_test_51MgDCzAOnE9oXiC8ZgSm68u3N1T9rC2tALnk0GlDACPss8KedrHVUN2mkj9uzVObzIARbdUqNJfk0DggC2RNWMs800Op20mBut"
      );

      const options = {
        mode: 'payment',
        amount: 1099,
        currency: 'jpy',
        // Fully customizable with appearance API.
        appearance: {
          /*...*/
        },
      };
    return (
            <Container>
            <Row className='justify-content-center'>
                <Col className='col-md-auto' style={{width:500,height:300}} >
                <Elements stripe={stripe} options={options}>
                    <PaymentElement  
             />
                    <Button variant="secondary" >
                    Close
                </Button>
                </Elements>
                </Col>
            </Row>
            </Container>
  

    )
}



export default CartPayment;
