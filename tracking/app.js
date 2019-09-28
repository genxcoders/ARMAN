(function() {
	// Your web app's Firebase configuration
	var firebaseConfig = {
	apiKey: "AIzaSyALAjEoWpEtkICpgAafDELgtDuEk2Y2wpc",
	authDomain: "dmsapp-3329c.firebaseapp.com",
	databaseURL: "https://dmsapp-3329c.firebaseio.com",
	projectId: "dmsapp-3329c",
	storageBucket: "dmsapp-3329c.appspot.com",
	messagingSenderId: "37035088167",
	appId: "1:37035088167:web:29819603927f2899"
	};
	// Initialize Firebase
	firebase.initializeApp(firebaseConfig);

	// Get pre id=object
	const preObject = document.getElementById('object');
	// Create Reference Object
	const dbRefObject = firebase.database().ref().child('preObject');
	// Create Reference Object

	// Sync object Changes
	dbRefObject.on('value', snap => console.log(snap.val()));
	// Sync object Changes
	// Get pre id=object
}());