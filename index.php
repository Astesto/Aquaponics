 <?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
    <style>
      html {
        font-family: Arial;
        display: inline-block;
        margin: 0px auto;
        text-align: center;
      }
      h1 { font-size: 2.0rem; }
      p { font-size: 2.0rem; }
      .units { font-size: 1.2rem; }
      .dht-labels{
        font-size: 1.5rem;
        vertical-align:middle;
        padding-bottom: 15px;
      }
    </style>
 
    
</head>

<body>
<div>
	<div class="header">
		<h2>SMART AQUAPONICS MONITORING SYSTEM</h2><br><br>
   

		
		
		

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br><br><br>
						
       <a href="login.php" ><button type="button" class="btn btn-danger"><strong>Logout</strong></button></a>
      
					</small>

				<?php endif ?>
	</div><br><br>
	<div class="content">
		  <p>
      <i class="fa fa-thermometer-half" style="font-size:3.0rem;color:#62a1d3;"></i> 
      <span class="dht-labels">Temperature : </span> 
      <span id="tempReading">0</span>
    </p><br><br>
    <p>
      <i class="fa fa-tint" style="font-size:3.0rem;color:#75e095;"></i>
      <span class="dht-labels">Water levels : </span>
      <span id="waterlevel">0</span>
      
    </p>
    <p>
      <i class="far fa-clock" style="font-size:1.0rem;color:#e3a8c7;"></i>
      <span style="font-size:1.0rem;">Time </span>
      <span id="time" style="font-size:1.0rem;"></span>
      
      <i class="far fa-calendar-alt" style="font-size:1.0rem;color:#f7dc68";></i>
      <span style="font-size:1.0rem;">Date </span>
      <span id="date" style="font-size:1.0rem;"></span>
    </P> 
	</div>
	
</div>	
<!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

  <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-app.js"></script>

  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-analytics.js"></script>

  <!-- Add Firebase products that y
  ou want to use -->
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-database.js"></script>

<script defer >
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyC1IaNUJyejeiMfWVSe1DRFGmMRlkblylk",
    authDomain: "aquaponics-system-d168e.firebaseapp.com",
    databaseURL: "https://aquaponics-system-d168e.firebaseio.com",
    projectId: "aquaponics-system-d168e",
    storageBucket: "aquaponics-system-d168e.appspot.com",
    messagingSenderId: "108371453311",
    appId: "1:108371453311:web:a9c473e381e19478ac264a",
    measurementId: "G-XNBC0BQBXQ"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  //const preObject = document.getElementById('object');
	
  const dbRefObject = firebase.database().ref('TempC/ds18b20temp');
  const waterLevel = firebase.database().ref('Distance/Ultrasonic');
	
  dbRefObject.on('value', snap => {
    const temp = Object.values(snap.val());
    temp.sort(function (a, b) {
    if (a > b) {
        return -1;
    }
    if (b > a) {
        return 1;
    }
    return 0;
});

    const tempTag = document.getElementById('tempReading');
    tempTag.innerHTML = temp[0];
    console.log(snap.val())}); // add logic in this line

    waterLevel.on('value', snap => {
    const dist = Object.values(snap.val())
    dist.sort(function (a, b) {
    if (a > b) {
        return -1;
    }
    if (b > a) {
        return 1;
    }
    return 0;
});
    const distTag = document.getElementById('waterlevel');
    distTag.innerHTML = dist[0];
    console.log(snap.val())}); // add logic in this line

    

</script>


<script>
     
      
     setInterval(function() {
       // Call a function repetatively with 1 Second interval
       Time_Date();
     }, 1000); 

    
     function Time_Date() {
       var t = new Date();
       document.getElementById("time").innerHTML = t.toLocaleTimeString();
       var d = new Date();
       const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday","Saturday"];
       const monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
       document.getElementById("date").innerHTML = dayNames[d.getDay()] + ", " + d.getDate() + "-" + monthNames[d.getMonth()] + "-" + d.getFullYear();
     }
   </script>

</body>

</html>