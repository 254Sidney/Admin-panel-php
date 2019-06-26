<?php
include '../authentication/connection.php';

if (isset($_POST['usertable'])) {
	$usertable =  mysqli_real_escape_string($con,$_POST['usertable']);

	$getuserfieldcloumen = mysqli_query($con,"SHOW COLUMNS FROM $usertable ");
	$getuserpasswordcloumen = mysqli_query($con,"SHOW COLUMNS FROM $usertable ");
	$counter = 0;
				for ($i=0; $i < 2 ; $i++) { 
					if($i == 0){
						echo "
						<div class='form-group col-md-4'>
							<label for='userloginfield'>User Name Field </label>
				        <select class='form-control'  name='usertablefield_$counter' id='userloginfield' >
				       		<option >Select User Name Field</option>";
						    while($row=mysqli_fetch_array($getuserfieldcloumen)){ 
						           echo "<option value='$row[0]' > $row[0] </option>"; 
						        $counter++;        
						    }
						echo "</select></div>";
					}else{
						echo "
						<div class='form-group col-md-4' >
						<label for='userloginpassword'>User Password Field </label>
				        <select class='form-control'  name='usertablefield_$counter' id='userloginpassword'>
				       		<option >Select User Password Field</option>";
						    while($row=mysqli_fetch_array($getuserpasswordcloumen)){ 
						           echo "<option value='$row[0]' > $row[0] </option>"; 
						        $counter++;        
						    }
						echo "</select></div>";

					}
					
				}
				
}
	
	



?>