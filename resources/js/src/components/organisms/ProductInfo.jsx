import React,{useEffect, useState} from 'react'
import { createRoot } from 'react-dom/client';
import { useFetchSpecificProduct } from '../../hooks/products/useFetchProducts';
import App from '../../layout/App';
import  CustomEvents from '../../common/CustomEvents';

export default function ProductInfo(props){

    const {id}=props;

    const [prodVarients, setProdVarients] = useState(JSON.parse(props.prodVarients))
    const [varientId, setVarientId] = useState(prodVarients[0].id);
   

    const {data:productPriceInfo, isLoading, error} = useFetchSpecificProduct(id,varientId)


    const triggerCustomEvent = () => {
        console.log("triggerr.....")
        const customEvent = new CustomEvent(CustomEvents.EVENT_TEST, { detail: 'Some data' });
        window.dispatchEvent(customEvent);
      };
    console.log("productPriceInfo",productPriceInfo)
    return (
        <div>
            <h1>hello react {props.id}</h1>
            <button onClick={triggerCustomEvent}>Trigger custom event</button>
        </div>
    )
}



//assign to a element

if(document.getElementById('jsx-product-info')){

    const container = document.getElementById('jsx-product-info')
    let props = Object.assign({},container.dataset)
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<App><ProductInfo {...props} /></App>);
}
