self.addEventListener('push', function(event) {  
	debugger;
  console.log('Received a push message', event);
  alert('hii  '.event);

  var title = 'Notification';  
  var body = 'There is newly updated content available on the site. Click to see more.';  
  var icon = 'http://admin.deliveryonweb.com/dist/img/logo.png';  
  var tag = 'simple-push-demo-notification-tag';
  
  event.waitUntil(  
    self.registration.showNotification(title, {  
       body: body,  
       icon: icon,  
       tag: tag  
     })  
   );  
});