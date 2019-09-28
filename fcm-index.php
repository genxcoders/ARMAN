<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Web Push Notification</title>
		<!-- <script src="http://www.gstatic.com/firebasejs/5.8.0/firebase.js"></script> -->
		<script src="https://www.gstatic.com/firebasejs/5.8.0/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/5.8.0/firebase-auth.js"></script>
		<script src="https://www.gstatic.com/firebasejs/5.8.0/firebase-messaging.js"></script>
		<!-- <script type="text/javascript" src=""></script> -->
		<link rel="manifest" type="text/css" href="manifest.json">
		<script>

			// Initialize Firebase
			var config = {
				apiKey: "AIzaSyALAjEoWpEtkICpgAafDELgtDuEk2Y2wpc",
				authDomain: "dmsapp-3329c.firebaseapp.com",
				databaseURL: "https://dmsapp-3329c.firebaseio.com",
				projectId: "dmsapp-3329c",
				storageBucket: "dmsapp-3329c.appspot.com",
				messagingSenderId: "103953800507"
			};
				firebase.initializeApp(config);

				// var messaging = firebase.messaging();

				// Retrieve Firebase Messaging object.
				const messaging = firebase.messaging();
				messaging.requestPermission()
				.then(function() {
					console.log('Notification permission granted.');
					// TODO(developer): Retrieve an Instance ID token for use with FCM.
					if(isTokenSentToServer()){
						console.log('Token already saved.')
					}else{
						getRegToken();
					}
						return messaging.getToken()
				})
				.then(function(result){
					console.log("The token is: ", result);
				})
				.catch(function(err) {
					console.log('Unable to get permission to notify.', err);
				});

				function getRegToken(argument){
					messaging.getToken()
						.then(function(currentToken) {
							if (currentToken) {
								saveToken(currentToken);
								updateUIForPushEnabled(currentToken);
							} else {
							// Show permission request.
							console.log('No Instance ID token available. Request permission to generate one.');
							// Show permission UI.
							updateUIForPushPermissionRequired();
							setTokenSentToServer(false);
							}
						}).catch(function(err) {
							// console.log('An error occurred while retrieving token. ', err);
							showToken('Error retrieving Instance ID token. ', err);
							setTokenSentToServer(false);
						});

						messaging.onTokenRefresh(function() {
							messaging.getToken().then(function(refreshedToken) {
								console.log('Token refreshed.');
								setTokenSentToServer(false);
								// Send Instance ID token to app server.
								sendTokenToServer(refreshedToken);
								// ...
							}).catch(function(err) {
								console.log('Unable to retrieve refreshed token ', err);
								showToken('Unable to retrieve refreshed token ', err);
							});
						});
				}

				function resetUI() {
				    clearMessages();
				    showToken('loading...');
				    messaging.getToken().then(function(currentToken) {
			      		if (currentToken) {
					        sendTokenToServer(currentToken);
					        updateUIForPushEnabled(currentToken);
			      		} else {
			        		// Show permission request.
			        		console.log('No Instance ID token available. Request permission to generate one.');
			        		// Show permission UI.
			        		updateUIForPushPermissionRequired();
			        		setTokenSentToServer(false);
			      		}
			    	}).catch(function(err) {
						console.log('An error occurred while retrieving token. ', err);
						showToken('Error retrieving Instance ID token. ', err);
						setTokenSentToServer(false);
			    	});
			    	// [END get_token]
			  	}
			  	function showToken(currentToken) {
			    	// Show token in console and UI.
				    var tokenElement = document.querySelector('#token');
				    // tokenElement.textContent = currentToken;
			  	}
			  	function sendTokenToServer(currentToken) {
				    if (!isTokenSentToServer()) {
						console.log('Sending token to server...');
						// TODO(developer): Send the current token to your server.
						setTokenSentToServer(true);
				    } else {
						console.log('Token already sent to server so won\'t send it again ' +
						'unless it changes');
				    }
			  	}
				function isTokenSentToServer() {
				    return window.localStorage.getItem('sentToServer') === '1';
				}
				function setTokenSentToServer(sent) {
				    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
				}
				function showHideDiv(divId, show) {
				    const div = document.querySelector('#' + divId);
				    if (show) {
						div.style = 'display: visible';
				    } else {
						div.style = 'display: none';
				    }
				}
				function updateUIForPushEnabled(currentToken) {
				    showHideDiv(tokenDivId, true);
				    showHideDiv(permissionDivId, false);
				    showToken(currentToken);
				}
				function updateUIForPushPermissionRequired() {
				    showHideDiv(tokenDivId, false);
				    showHideDiv(permissionDivId, true);
				}

				function saveToken(currentToken){
				  	$.ajax({
				  		url: 'token-save.php',
				  		method: 'post',
				  		data: 'token=' + currentToken
				  	})
				  	.done(function(result){
				  		console.log(result);
				  	})
				}
				messaging.onMessage(function(payload) {
					console.log("Message received." , payload);
					notificationTitle = payload.data.title;
					notificationOptions = {
						body: payload.data.body,
						icon: payload.data.icon
					};
					var notification = new Notification(notificationTitle,notificationOptions);
				});
				
		</script>
	</head>
	<body>
		<center>
			<h1>FCM Web Push Notification </h1>
		</center>
	</body>
</html>