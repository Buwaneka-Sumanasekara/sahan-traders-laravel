import React from 'react';
import App from '../layout/App';
import { createRoot } from 'react-dom/client';
import StripePayment from '../components/organisms/StripePayment';
import { loadStripe } from "@stripe/stripe-js";


const UIStripePayment = (props) =><App><StripePayment {...props} /></App>

//assign to a element

if(document.getElementById('jsx-stripe-payment')){

    const container = document.getElementById('jsx-stripe-payment')
    let props = Object.assign({},container?.dataset)
  
    const stripe=loadStripe(props.pk_session);
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<UIStripePayment stripe={stripe} sessionId={props.session_id}/>);
}


export default UIStripePayment;