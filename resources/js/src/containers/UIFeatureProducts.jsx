import React from 'react';
import App from '../layout/App';
import { createRoot } from 'react-dom/client';
import FeatureProducts from '../components/organisms/FeatureProducts';



const UIFeatureProducts = (props) =><App><FeatureProducts {...props} /></App>

//assign to a element

if(document.getElementById('jsx-feature-products')){

    const container = document.getElementById('jsx-feature-products')
    let props = Object.assign({},container?.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<UIFeatureProducts {...props}/>);
}


export default UIFeatureProducts;