import React from 'react';
import App from '../layout/App';
import { createRoot } from 'react-dom/client';
import Toast from '../components/atoms/Toast';


const ToastContainer = (props) =><App><ProductInfo {...props} /></App>

//assign to a element

if(document.getElementById('jsx-toast')){

    const container = document.getElementById('jsx-toast')
    let props = Object.assign({},container.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<Toast {...props}/>);
}


export default ToastContainer;