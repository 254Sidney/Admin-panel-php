<?php
	  @$Host_Name     = "localhost";
	  @$DataBase_Name = "vapingyou";
	  @$user_name     = "root";
	  @$Password      = "";


	//Set the Database Name in Session 
	@$_SESSION["DataBase_Name"] = $DataBase_Name;
	$con = mysqli_connect($Host_Name,$user_name,$Password,$DataBase_Name);
	if (!$con)
	  {
	  die("Could not connect:" . mysqli_error());
	  }
	


?>