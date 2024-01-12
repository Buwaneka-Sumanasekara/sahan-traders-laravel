import React from 'react';
import App from '../layout/App';
import ProductInfo from '../components/organisms/ProductInfo';
import { createRoot } from 'react-dom/client';


const ProductInfoContainer = (props) =><App><ProductInfo {...props} /></App>

//assign to a element

if(document.getElementById('jsx-product-info')){

    const container = document.getElementById('jsx-product-info')
    let props = Object.assign({},container.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<ProductInfoContainer {...props}/>);
}


export default ProductInfoContainer;