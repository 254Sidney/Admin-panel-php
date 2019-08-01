<?php
require 'function.php';

//handel query excute 

//check the table 
if(!empty($_POST['tablename'])){

	$main_table = mysql_real_escape_string($_POST['tablename']);
	$fkfieldname = mysql_real_escape_string($_POST['fkfieldname']);
    $relatedid   = mysql_real_escape_string($_POST['relatedid']);
	//check the query type 
	if(!empty($_POST['delete'])){
			
			$main_id = mysql_real_escape_string($_POST['mainid']);
			$get_prim_key_name = GetCoulmsInfo($main_table);
			$get_prim_key_name = $get_prim_key_name['primrykeyname'];

			$delet_query = "DELETE FROM `$main_table` WHERE `$get_prim_key_name` ='$main_id'";
			if(!mysql_query($delet_query)){
				$error =  mysql_error();
				
				echo "<script>window.location ='displayrelatedinfo.php?tablename=$main_table&relatedinfo=$main_table&fkfieldname=$fkfieldname&relatedid=$relatedid&true&error=$error';</script>"; 
			}else{				
				 echo "<script>window.location ='displayrelatedinfo.php?tablename=$main_table&relatedinfo=$main_table&fkfieldname=$fkfieldname&relatedid=$relatedid&true&Done';</script>"; 
    			 
			}
	}//end of delete query 
	unset($_POST);
	unset($SESSION);


}





?>