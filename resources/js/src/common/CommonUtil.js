

export function triggerCustomEvent(eventName, data) {
  var event = new CustomEvent(eventName, {
    detail: data
  });
  window.dispatchEvent(event);
}

