import React, { FormEvent } from "react";
import { Col, Container, Row, Button, Form } from "react-bootstrap";
import {
  Elements,
  PaymentElement,
  useElements,
  useStripe,
} from "@stripe/react-stripe-js";
import { useFetchPaymentInfoFromSession } from "../../hooks/payment/useFetchPayment";
import { StripeElementsOptions } from "@stripe/stripe-js";
import { useMutateToastEventListner } from "../../hooks/common/useEventsListner";
import { createStripePaymentIntent } from "../../hooks/payment/useMutatePayment";





const StripePaymentForm = (props) => {
  const { sessionId, amountDisplay } = props;
  const stripe = useStripe();
  const elements = useElements();

  const { onShowWarningMessage: onShowWarningMessage } = useMutateToastEventListner();




  const onSubmit = async (event: FormEvent) => {

    try {
      event.preventDefault();

      if (elements == null) {
        return;
      }

      // Trigger form validation and wallet collection
      const { error: submitError } = await elements.submit();
      if (submitError) {
        // Show error to your customer

        onShowWarningMessage({
          message: submitError.message || "An error occurred",
        })
        return;
      }

      const resp = await createStripePaymentIntent(sessionId)
      if (resp?.status === 200) {
        console.log('submit', resp?.data?.data)
        const { clientSecret, successUrl, billingAddress
        } = resp?.data?.data;
        if (!stripe) {
          throw new Error("Stripe is not initialized")
        }
        console.log('successUrl', successUrl)
        const { error } = await stripe.confirmPayment({
          //`Elements` instance that was used to create the Payment Element
          elements,
          clientSecret,
          confirmParams: {
            return_url: successUrl,
            payment_method_data: {
              billing_details: {
                address: {
                  country: billingAddress?.country?.payment_code
                }
              }
            }

          },
        });

        if (error) {
          // This point will only be reached if there is an immediate error when
          // confirming the payment. Show error to your customer (for example, payment
          // details incomplete)

          throw new Error(error.message || "An error occurred in payment")
        } else {
          // Your customer will be redirected to your `return_url`. For some payment
          // methods like iDEAL, your customer will be redirected to an intermediate
          // site first to authorize the payment, then redirected to the `return_url`.
        }

      } else {
        throw new Error(resp?.data?.error?.message || "An error occurred in payment")
      }

    } catch (error) {

      const message = error?.response?.data?.error?.message || error.message || "An error occurred in payment"
      console.log('error', message)
      onShowWarningMessage({
        message: message,
      })
    }
  }

  return (
    <Form onSubmit={onSubmit}>
      <Container>
        <Row className='justify-content-center mb-3'>
          <Col className='col-md-auto bg-dark text-center py-2' style={{ width: 480 }}>
            <p className="text-white">{`To Pay`}</p>
            <h3 className="text-white">{`${amountDisplay}`}</h3>
          </Col>
        </Row>
        <Row className='justify-content-center mb-2 '>
          <Col className='col-md-auto' style={{ width: 500 }} >

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

          </Col>
        </Row>
        <Row className='justify-content-center'>
          <Col className='col-md-auto' style={{ width: 500 }}>
            <Button variant="secondary" style={{ width: "100%" }} type="submit">
              Pay
            </Button>
          </Col>
        </Row>
      </Container>
    </Form>
  )
}


const StripePayment = (props) => {
  const { stripe, sessionId } = props;




  const { data, isLoading } = useFetchPaymentInfoFromSession(sessionId, true)


  if (data) {
    const options: StripeElementsOptions = {
      mode: 'payment',
      currency: data.currency,
      amount: data?.amount || 0,
      appearance: {},
    };
    return (
      <Elements stripe={stripe} options={options}>
        <StripePaymentForm sessionId={sessionId} amount={data?.amount} amountDisplay={data?.amount_display} />
      </Elements>
    )
  }

}



export default StripePayment;
