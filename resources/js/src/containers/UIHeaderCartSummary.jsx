import React from 'react';
import App from '../layout/App';
import { createRoot } from 'react-dom/client';
import HeaderCartSummary from '../components/molecules/HeaderCartSummary';



const UIHeaderCartSummary = (props) =><App><HeaderCartSummary {...props} /></App>

//assign to a element

if(document.getElementById('jsx-ui-header-cart-summary')){

    const container = document.getElementById('jsx-ui-header-cart-summary')
    let props = Object.assign({},container?.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<UIHeaderCartSummary {...props}/>);
}


export default UIHeaderCartSummary;