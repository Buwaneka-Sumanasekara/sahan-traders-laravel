import React,{useEffect, useState} from 'react'
import { createRoot } from 'react-dom/client';
import App from '../../layout/App';


export default function Test(props){


const [count, setCount] = useState("");


    useEffect(() => {
        const handleCustomEvent = (event) => {
          // Handle the custom event here
          console.log('Custom event received:', event.detail);
          setCount(event.detail)
        };
    
        // Add event listener when the component mounts
        window.addEventListener('jsx_event_cart', handleCustomEvent);
    
        // Remove event listener when the component unmounts
        return () => {
          window.removeEventListener('jsx_event_cart', handleCustomEvent);
        };
      }, []); // Empty dependency array ensures that the effect runs once on mount
    


  
    return (
        <div>
            <h1>count {count}</h1>
        </div>
    )
}



//assign to a element

if(document.getElementById('jsx-test')){

    const container = document.getElementById('jsx-test')
   
  
    const root = createRoot(container); // createRoot(container!) if you use TypeScript
    root.render(<App><Test  /></App>);
}