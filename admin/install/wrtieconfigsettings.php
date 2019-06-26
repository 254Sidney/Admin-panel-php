<?php

include '../authentication/connection.php';

//Define Variables 
$alltablename = array();
$alldisplayname = array();
$array = array();
$arraybegin = '$Forgien_Key_Display_Field = array(';
$merg       = "";
$arrayend   = ')';
$counter    = 0;

//creat table if not exsist 
if(isset($_POST['passwordfieldname']) ||  isset($_POST['fieldname_image']) || isset($_POST['uploaddirectory']) || isset($_POST['viedofieldname']) || isset($_POST['youtubefieldname'])){

	$imagename    = mysqli_real_escape_string($con,$_POST['fieldname_image']);
	$uploadname   = mysqli_real_escape_string($con,$_POST['uploaddirectory']);
	$viedoname    = mysqli_real_escape_string($con,$_POST['viedofieldname']);
	$youtubename  = mysqli_real_escape_string($con,$_POST['youtubefieldname']);
	$passwordfieldname    = mysqli_real_escape_string($_POST['passwordfieldname']);
	if($passwordfieldname != '' || $imagename != '' || $viedoname != '' ||  $uploadname != '' || $youtubename != '' || $usertable  != ''){
		$sql = "CREATE TABLE IF NOT EXISTS `configuer_settings_genericadmin` (
			   `Config_id` int(11) unsigned NOT NULL auto_increment,
			   `fieldname_image`   varchar(255) NOT NULL default '',
			   `uploaddirectory`   varchar(255) NOT NULL default '',
			   `youtubefieldname`  varchar(500) NOT NULL default '',
			   `viedofieldname`    varchar(500) NOT NULL default '',
			   `passwordfieldname` varchar(500) NOT NULL default '',
    			PRIMARY KEY  (`Config_id`)
			   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
			mysqli_query($con,$sql);
		$insertconfigvalue = mysqli_query($con,"INSERT INTO configuer_settings_genericadmin (`fieldname_image`,`uploaddirectory`,`youtubefieldname`,`viedofieldname`,`passwordfieldname`) VALUES ('$imagename','$uploadname','$viedoname','$youtubename','$passwordfieldname') ");
	}

}

if (!empty(isset($_POST['projectname']))) {
	# code...
	$projectname = mysqli_real_escape_string($con,$_POST['projectname']);
	$projectsql = "CREATE TABLE IF NOT EXISTS `configuer_settings_projectname` (
			   `projectid` int(11) unsigned NOT NULL auto_increment,
			   `projectname`   varchar(255) NOT NULL default '',
    			PRIMARY KEY  (`projectid`)
			   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
			mysqli_query($con,$projectsql);

			$projectnamequery = mysqli_query($con,"INSERT INTO `configuer_settings_projectname` (`projectname`) VALUES ('$projectname') ");

}

//handel user table name and field 
if (!empty(isset($_POST['usertable']))) {
	//creat table to store all statistics tables 
$userloginsql = "CREATE TABLE IF NOT EXISTS `userlogin_settings_genericadmin` (
	   `userlogin_id` int(11) unsigned NOT NULL auto_increment,
	   `tablename` varchar(255) NOT NULL default '',
	   `fieldname_username` varchar(255) NOT NULL default '',
	   `fieldname_password` varchar(255) NOT NULL default '',
		PRIMARY KEY  (`userlogin_id`)
	   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
	mysqli_query($con,$userloginsql);

	//get table name of user login 
	$usertablename = mysqli_real_escape_string($con,$_POST['usertable']);
	$insertuserlogin = '';
	$insertuserlogin = "INSERT INTO userlogin_settings_genericadmin (`tablename`,`fieldname_username`,`fieldname_password`) VALUES ('$usertablename',";
	$userlogincounter = 0;
	foreach ($_POST as $key => $value) {
		$key = substr($key, 0, strrpos($key, '_'));
		if ($key == 'usertablefield') {

				if($userlogincounter == 1){
					$insertuserlogin = $insertuserlogin."'".$value."')";
				}else{
					$insertuserlogin = $insertuserlogin."'".$value."',";
				}
				$userlogincounter++;
				
		}
	}

			mysqli_query($con,$insertuserlogin);
	
	
}



//creat table to store all statistics tables 
$statisticsql = "CREATE TABLE IF NOT EXISTS `statistics_settings_genericadmin` (
	   `table_id` int(11) unsigned NOT NULL auto_increment,
	   `tablename` varchar(255) NOT NULL default '',
	   `methodname` varchar(255) NOT NULL default '',
	   `fieldname` varchar(255) NOT NULL default '',
		PRIMARY KEY  (`table_id`)
	   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
	mysqli_query($con,$statisticsql);
//creat the insert sql 
//array not allowed 
$NotAllowed = ['Select Table','Submit','fkname','fktablename','fkallfieldsname','Select Method','Select Field',''];
$statisticcounter = 0;
$statisticlength = 0;
//get the length of the statistics 
for ($z=0; $z <count($_POST) ; $z++) { 
	@$notemptyvalue =  $_POST["statisticstablefield_".$z];
	if($notemptyvalue != '' ){
		$statisticlength++;
	}
}
//loop to check the statistics tables
for ($xx=0; $xx < $statisticlength  ; $xx++) {
	$statistictablename  = mysqli_real_escape_string($con,$_POST["statisticstablename_".$xx]);
	$statisticmethodname = mysqli_real_escape_string($con,$_POST["statisticsmethod_".$xx]);
	$statisticfieldname  = mysqli_real_escape_string($con,$_POST["statisticstablefield_".$xx]);
	if($statistictablename != 'Select Table' && $statisticmethodname != 'Select Method' &&  $statisticfieldname != 'Select Field'){
		$statistic_query = "INSERT INTO  `statistics_settings_genericadmin` ( `tablename`,`methodname`,`fieldname`) VALUES ('$statistictablename','$statisticmethodname','$statisticfieldname')"; 
		if(!mysqli_query($con,$statistic_query)){
			echo mysqli_error();
		}		
	}
	
}
//loop for the post and collect the forgien key info 
foreach ($_POST as $key => $value) {	
	if ($value !='Select Table' && $value != '' && $value != 'Submit' ) {
		@$key  = substr($key, 0, strrpos($key, '_'));
		@$value  = substr($value, 0, strrpos($value, '_'));
		//check for forgien keys 
		if($key != 'fkname'){
				if($key == 'fktablename' ){
					array_push($alltablename,$value);
				}else if($key == 'fkallfieldsname'){
					array_push($alldisplayname,$value);
				}				
		}//end of forgien key 		
	}	
}
//combine the tow array as key => value 
for ($i=0; $i < count($alltablename) ; $i++) { 
	for($y=0; $y < count($alldisplayname) ; $y++){
			$array[$alltablename[$i]] = $alldisplayname[$i];				
	}	
}
foreach ($array as $key => $value) {		
	if($counter == count($array)-1){
		$merg = $merg."'".$key."' =>'".$value."'";
	}else{
		$merg = $merg."'".$key."' =>'".$value."',";
	}
	$counter++;	
}
$combarray = $arraybegin . $merg .$arrayend ;
//write forgien key info in the FK_file 
$file = '../authentication/FK_Config.php';
$fp   = fopen($file, 'w');
fwrite($fp, '<?php '.$combarray."?>");
fclose($fp);
header('Location: '.'../index.php');
die();

?>