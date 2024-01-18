import React from 'react';
import App from '../layout/App';
import { createRoot } from 'react-dom/client';
import CartStep1 from '../components/organisms/CartStep1';



const UICartStep1 = (props) =><App><CartStep1 {...props} /></App>

//assign to a element

if(document.getElementById('jsx-cart-step1')){

    const container = document.getElementById('jsx-cart-step1')
    let props = Object.assign({},container?.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<UICartStep1 {...props}/>);
}


export default UICartStep1;