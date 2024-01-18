import { LottieAnimationName } from "../types/Common";


export function triggerCustomEvent(eventName, data) {
  var event = new CustomEvent(eventName, {
    detail: data
  });
 
  const state=window.dispatchEvent(event);
  console.log("triggerCustomEvent call", event,"state:",state)
}


