import React from 'react';
import App from '../layout/App';
import { createRoot } from 'react-dom/client';
import Cart from '../components/organisms/Cart';



const UICart = (props) =><App><Cart /></App>

//assign to a element

if(document.getElementById('jsx-cart')){

    const container = document.getElementById('jsx-cart')
    let props = Object.assign({},container?.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<UICart {...props}/>);
}


export default UICart;