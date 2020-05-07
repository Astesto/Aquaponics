(function () {
	const config = {
	apiKey: "AIzaSyC1IaNUJyejeiMfWVSe1DRFGmMRlkblylk",
    authDomain: "aquaponics-system-d168e.firebaseapp.com",
    databaseURL: "https://aquaponics-system-d168e.firebaseio.com",
    storageBucket: "aquaponics-system-d168e.appspot.com",
	};

	firebase.initializeApp(firebaseConfig);
	firebase.analytics();
	
	//const preObject = document.getElementById('object');
	
	const dbRefObject = firebase.database().ref('TempC/ds18b20temp');
	
	dbRefObject.on('value' , snap => console.log(snap.val()));
	
}()); 