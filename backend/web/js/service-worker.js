//alert('serviceWorker' in navigator);
if ('serviceWorker' in navigator) { 
  navigator.serviceWorker.register('js/service-worker.js').then(function(registration) {
	// Registration was successful 
	//	alert(subscription.subscriptionId);
	console.log('ServiceWorker registration successful with scope: ',    registration.scope);
	registration.pushManager.subscribe({userVisibleOnly: true}).then(function(subscription){
	isPushEnabled = true;  
	//alert(subscription.subscriptionId);
	console.log("subscription.subscriptionId: ", subscription.subscriptionId);
	console.log("subscription.endpoint: ", subscription.endpoint);
	
	// TODO: Send the subscription subscription.endpoint
	// to your server and save it to send a push message
	// at a later date
	return sendSubscriptionToServer(subscription);
	});
  }).catch(function(err) {
    // registration failed :(
			//	alert(err);
    console.log('ServiceWorker registration failed: ', err);
  });
}