<?php

require 'index.php';
$Trash = $_GET["trash"];

$Distance = $_GET["distance"];
$Temperature = $_GET["temp_f"];


// --- This is your Firebase URL
$baseURI = 'https://thesis1-69.firebaseio.com';
// --- Use your token from Firebase here
$token = 'gg';
// --- Here is your parameter from the http GET



$devicestatus= array('Distance' => $Distance,'Temperature' => $Temperature,'Humidity' => $Humidity);

$firebasePath = '/thesis1-69/';




$full= array($Trash => $devicestatus);

/// --- Making calls
$fb = new Firebase($baseURI, $token);
$fb -> update($firebasePath, $full);


?>