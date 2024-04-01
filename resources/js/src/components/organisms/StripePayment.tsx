import React from "react";
import { Col, Container, Row, Button } from "react-bootstrap";
import {
  Elements,
  PaymentElement,
} from "@stripe/react-stripe-js";
import { useFetchPaymentInfoFromSession } from "../../hooks/payment/useFetchPayment";
import { StripeElementsOptions } from "@stripe/stripe-js";





const StripePayment = (props) => {
  const { stripe, sessionId } = props;
  console.log('CartPayment')



  const { data, isLoading } = useFetchPaymentInfoFromSession(sessionId, true)


  if (data) {
    console.log(data)
    const options: StripeElementsOptions = {
      mode: 'payment',
      currency: data.currency,
      amount: 100,
      appearance: {},

    };
    return (
      <Container>
        <Row className='justify-content-center mb-2'>
          <Col className='col-md-auto' style={{ width: 500 }} >
            <Elements stripe={stripe} options={options}>
              <PaymentElement
                options={{
                  fields: {
                    billingDetails: {
                      address: {
                        country: "never"
                      }
                    }
                  },
                  layout: 'tabs'
                }}
              />
            </Elements>
          </Col>
        </Row>
        <Row className='justify-content-center'>
          <Col className='col-md-auto' style={{ width: 500 }}>
            <Button variant="secondary" style={{width:"100%"}}>
              Pay
            </Button>
          </Col>
        </Row>
      </Container>


    )
  }

}



export default StripePayment;
