import React from 'react';
import App from '../layout/App';
import { createRoot } from 'react-dom/client';
import CartPayment from '../components/organisms/CartPayment';



const UICartPayment = (props) =><App><CartPayment /></App>

//assign to a element

if(document.getElementById('jsx-cart-payment')){

    const container = document.getElementById('jsx-cart-payment')
    let props = Object.assign({},container?.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<UICartPayment {...props}/>);
}


export default UICartPayment;