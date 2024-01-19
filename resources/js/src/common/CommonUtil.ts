import { GeneralServerError, LottieAnimationName, RedirectProps } from "../types/Common";


export function triggerCustomEvent(eventName, data) {
  var event = new CustomEvent(eventName, {
    detail: data
  });
 
  const state=window.dispatchEvent(event);
  console.log("triggerCustomEvent call", event,"state:",state)
}


export function authenticationRedirectHandler(props:RedirectProps) {
  const {onErrorCallBack,productId,errorObject}=props;
  if(errorObject.status===401 && productId){
    window.open(`/login?redirect-to-item=${productId}`,'_self');
  }else if(errorObject.status===403){
    window.open(`#`,'_self');
  }else{
    onErrorCallBack?.(
      errorObject.data?.error as GeneralServerError
    )
  }
}