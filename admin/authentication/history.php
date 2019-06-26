
<?php
date_default_timezone_set('UTC');
//using the default timezone 
// Traking the user and saving his every move 



// Get The Current Page URL
function curPageURL() {
 $pageURL = 'http';
 if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

// Creat the table for the traking history 
$creattablehistory = mysqli_query("CREATE TABLE IF NOT EXISTS System_history (ip varchar(80), time_stamp varchar(200),user_id varchar(25),URL varchar(500));");
if (!$creattablehistory) {
	echo "Error in History Traking Table Creation : " . mysqli_error();
}

// Fetch Clint IP
$userip = $_SERVER['REMOTE_ADDR']; 
$URL = curPageURL();
$timestamp = $today = date("Y-m-d H:i:s"); 

// Check if he is logged in or not
if (loggedin()) {

	$userid = getfield('id');
	$insuery = mysqli_query("INSERT INTO System_history (ip,time_stamp,user_id,URL) VALUES ('$userip','$timestamp','$userid','$URL')");
	if (!$insuery) {
		echo "Error in History Traking Table Insert when user in on : " . mysqli_error();
	}


} else {

	$insuery2 = mysqli_query("INSERT INTO System_history (ip,time_stamp,user_id,URL) VALUES ('$userip','$timestamp','Anonymous','$URL')");
	if (!$insuery2) {
		echo "Error in History Traking Table Insert when user in off : " . mysqli_error();
	}
}
?>