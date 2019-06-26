<?php

if (isset($_GET['connectionsubmit'])) {
	# code...
	$DataBaseHostName = $_GET['DataBaseHostName'];
	$DataBaseName     = $_GET['DataBaseName'];
	$DataBaseUserName = $_GET['DataBaseUserName'];
	$DataBasePassword = $_GET['DataBasePassword'];

	//now edit the connection string in the connection.php
    $file = '../authentication/connection.php';
	$file_contents = file_get_contents($file);
	$fh = fopen($file, "w");

	/*$file_contents = str_replace('hostname',$DataBaseHostName,$file_contents);
	$file_contents = str_replace('dbname',$DataBaseName,$file_contents);
	$file_contents = str_replace('username',$DataBaseUserName,$file_contents);
	$file_contents = str_replace('password',$DataBasePassword,$file_contents);*/
	$file_contents = 
'<?php
	  @$Host_Name     = "'.$DataBaseHostName.'";
	  @$DataBase_Name = "'.$DataBaseName.'";
	  @$user_name     = "'.$DataBaseUserName.'";
	  @$Password      = "'.$DataBasePassword.'";


	//Set the Database Name in Session 
	@$_SESSION["DataBase_Name"] = $DataBase_Name;
	$con = mysqli_connect($Host_Name,$user_name,$Password,$DataBase_Name);
	if (!$con)
	  {
	  die("Could not connect:" . mysqli_error());
	  }
	


?>';

	fwrite($fh, $file_contents);
	fclose($fh);

	header('Location: '.'config.php?config');
	die();
	
}


?>