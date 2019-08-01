<?php
include 'function.php';

//handel query excute 

//check the table 
if(!empty($_POST['tablename'])){

	$main_table = mysqli_real_escape_string($con,$_POST['tablename']);
	//check the query type 
	if(!empty($_POST['delete'])){
			
			$main_id = mysqli_real_escape_string($con,$_POST['mainid']);
			$get_prim_key_name = GetCoulmsInfo($con,$main_table);
			$get_prim_key_name = $get_prim_key_name['primrykeyname'];

			$delet_query = "DELETE FROM `$main_table` WHERE `$get_prim_key_name` ='$main_id'";
			if(!mysqli_query($con,$delet_query)){
				$error =  mysqli_error($con);
				
				echo "<script>window.location ='../index.php?tablename=$main_table&error=$error';</script>"; 
			}else{				
				 echo "<script>window.location ='../index.php?tablename=$main_table&Done';</script>"; 
    			 
			}
	}//end of delete query 
	unset($_POST);
	unset($SESSION);


}





?>