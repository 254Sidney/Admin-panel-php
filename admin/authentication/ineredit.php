<?xml version="1.0" encoding="UTF-8"?> <!DOCTYPE html>
<html>
<head>

	        <title>Dynamic | Admin Dashboard </title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard,generic,dynamic admin,php admin,website content mangment,CRM, PHP CRM , generic mangment , free admin, free website admin, free website php admin, free generic admin " />
        <meta name="author" content="ali alroomi" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <link href='../../assets/css/css.css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- Theme Styles -->
        <link href="../../assets/css/modern.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../DateTime/css/DateTimePicker.css" />
		<script type="text/javascript" src="../DateTime/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="../DateTime/js/DateTimePicker.js"></script>
        <style type="text/css">
        	.content-wrap {
			    overflow: auto !important;
			}
			.col-sm-10 select{

				 color: black;
			    min-width: 220px;
			    border-radius: 5px;
			    min-height: 30px;
			}

			.form-control {
				width: 60%;

			}
        </style>

        <script type="text/javascript">	
		$(document).ready(function()
		{
			$("#dtBox").DateTimeOmnix();
		});

	</script>

</head>
<body style="color:white;">
 <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner">
                <form method="POST" action="" enctype='multipart/form-data'>
<?php
//include main library 
include 'function.php';
include 'FK_Config.php';

if (isset($_GET['tablename']) && isset($_GET['edit'])) {
	# code...
	$tablename = mysqli_real_escape_string($con,$_GET['tablename']);
	$PrimID    = mysqli_real_escape_string($con,$_GET['edit']);

	echo "<div id='table_title' >
	<h1 style='margin-left: 14px;color:#4E5E6A;'>".strtoupper($tablename)."</h1>
	</div><table>";
	

	$table_update_info      		=  GetCoulmsInfo($con,$tablename);
	@$PrimryKey_DisplayName 		=   $table_update_info['FieldsName'][0];
	@$colum_update_name_no_replace  =   $table_update_info['FieldsName'];
	@$colum_update_name     		=  str_replace('_', ' ', $table_update_info['FieldsName']);
	@$colum_update_type     		=  $table_update_info['FieldType'];
	@$colum_update_orginaltype      = $table_update_info['OrginalFieldType'];
	@$colum_update_number   		=  $table_update_info['columnnumber'];

	//get all config info if exsist 
	@$confObj = CheckconfigInfo($con);
	//prepare the variables for youtube and viedo and images 
    if(count($confObj) > 0){
        if($confObj['fieldname_image'] != ''){
            $images  = str_replace('_', '', $confObj['fieldname_image']);
        }else{
            $images  = 'Image'; 
        }

        

        if($confObj['uploaddirectory'] != ''){
            $uploads  = $confObj['uploaddirectory'];
        }else{
            $uploads  = 'uploads/'; 
        }

        if($confObj['youtubefieldname'] != ''){
            $youtube = str_replace('_', '', $confObj['youtubefieldname']);
        }else{
            $youtube = 'YouTube';
        }

        if($confObj['viedofieldname'] != ''){
            $viedo   = str_replace('_', '', $confObj['viedofieldname']);
        }else{
            $viedo   = 'Video';
        }

        if($confObj['passwordfieldname'] != ''){
            $password   = str_replace('_', '', $confObj['passwordfieldname']);
        }else{
            $password   = 'Password';
        }

    }else{
        $youtube = 'YouTube';
        $viedo   = 'Video';
        $images  = 'Image'; 
        $uploads  = 'uploads/';  
        $password   = 'Password'; 
    }


	//get all info for the table 
	$columvalue = mysqli_query($con,"SELECT * FROM $tablename WHERE `$PrimryKey_DisplayName` = '$PrimID'");

	while ($rowval = mysqli_fetch_array($columvalue)) {
		
	
	//get the value of the primry key and draw the update form 
	//draw the form update
	for ($i=0; $i <= @$colum_update_number-1; $i++) { 
			if($colum_update_name_no_replace[$i] != @$PrimryKey_DisplayName ){

				//check if there is forgien key 
				$FK=mysqli_get_foregin_key($con,$tablename,$table_update_info['FieldsName'][$i]);
				if($FK != '' && $colum_update_name_no_replace[$i] == $FK ){

					//get table name for the fk and select * from table by field name if exsist 
					//databas name to get all FK
					$FK_Fields_Name   = $colum_update_name_no_replace[$i];
                    $All_FK_TableName = GetForeginKey_TableName($con,$tablename,$FK);
                    $Tablename_FK     = substr($All_FK_TableName[$FK_Fields_Name], 0, strpos($All_FK_TableName[$FK_Fields_Name], '.'));
                    $PK_Name_For_FK   = @end( explode( ".", $All_FK_TableName[$FK_Fields_Name] ));              
                    //$FK_PK            = GetCoulmsInfo($Tablename_FK);
                    $FKPrimID = $rowval[$i];                  
                    //get * from this table if display name if empty
                    //the FK Field Should be Displayed by user 
                    if(!empty($Forgien_Key_Display_Field)){
                    	//get the displayed forgien key name
                    	if(array_key_exists($Tablename_FK, $Forgien_Key_Display_Field)){
                    		$FK_Field_Display = $Forgien_Key_Display_Field[$Tablename_FK];	
	                    	//get the value that already selected in the main table 
	                    	$FK_Selected_Value_Query  = mysqli_query($con,"SELECT * FROM  $Tablename_FK WHERE `$PK_Name_For_FK` ='$FKPrimID' ");
		    				  while ($FK_Row = mysqli_fetch_array($FK_Selected_Value_Query)) {
		    				  		$Selected_Value = $FK_Row[$FK_Field_Display];
		    				  }
		    				//get the rest of value 
		    				$FK_Select_All_Value_Query  = mysqli_query($con,"SELECT * FROM  $Tablename_FK WHERE `$PK_Name_For_FK` !='$FKPrimID' ");
		    				//append the value in dropdown and then append the rest 
		    				echo "<div class='form-group' >
									<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
									<div class='col-sm-10'>
									    <select name='$colum_update_name_no_replace[$i]' id='$colum_update_name_no_replace[$i]' >
									    <option value='$FKPrimID' selected='selected'>$Selected_Value</option>";
									    //now get the rest of value from the same table 
									while ($RestOfValue = mysqli_fetch_array($FK_Select_All_Value_Query)) {
										$Selected_Value = $RestOfValue[$FK_Field_Display];
										$FK_ID          = $RestOfValue[$PK_Name_For_FK];
										echo "<option value='$FK_ID' >$Selected_Value</option>";
									}

							echo    "</select>
									</div>
									</div>";

							}else{  //not in array 

								//get the value that already selected in the main table 
		                    	$FK_Selected_Value_Query  = mysqli_query($con,"SELECT * FROM  $Tablename_FK WHERE `$PK_Name_For_FK` ='$FKPrimID' ");
			    				  while ($FK_Row = mysqli_fetch_array($FK_Selected_Value_Query)) {
			    				  		$Selected_Value = $FK_Row[0];
			    				  }
			    				//get the rest of value 
			    				$FK_Select_All_Value_Query  = mysqli_query($con,"SELECT * FROM  $Tablename_FK WHERE `$PK_Name_For_FK` !='$FKPrimID' ");
			    				//append the value in dropdown and then append the rest 
			    				echo "<div class='form-group' >
										<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
										<div class='col-sm-10'>
										    <select name='$colum_update_name_no_replace[$i]' id='$colum_update_name_no_replace[$i]' >
										    <option value='$FKPrimID' selected='selected'>$Selected_Value</option>";
										    //now get the rest of value from the same table 
										while ($RestOfValue = mysqli_fetch_array($FK_Select_All_Value_Query)) {
											$Selected_Value = $RestOfValue[0];
											$FK_ID          = $RestOfValue[0];
											echo "<option value='$FK_ID' >$Selected_Value</option>";
										}

								echo    "</select>
										</div>
										</div>";
							}

                    }else{
                    	//get the value that already selected in the main table 
                    	$FK_Selected_Value_Query  = mysqli_query("SELECT * FROM  $Tablename_FK WHERE `$PK_Name_For_FK` ='$FKPrimID' ");
	    				  while ($FK_Row = mysqli_fetch_array($FK_Selected_Value_Query)) {
	    				  		$Selected_Value = $FK_Row[0];
	    				  }
	    				//get the rest of value 
	    				$FK_Select_All_Value_Query  = mysqli_query("SELECT * FROM  $Tablename_FK WHERE `$PK_Name_For_FK` !='$FKPrimID' ");
	    				//append the value in dropdown and then append the rest 
	    				echo "<div class='form-group' >
								<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
								<div class='col-sm-10'>
								    <select name='$colum_update_name_no_replace[$i]' id='$colum_update_name_no_replace[$i]' >
								    <option value='$FKPrimID' selected='selected'>$Selected_Value</option>";
								    //now get the rest of value from the same table 
								while ($RestOfValue = mysqli_fetch_array($FK_Select_All_Value_Query)) {
									$Selected_Value = $RestOfValue[0];
									$FK_ID          = $RestOfValue[0];
									echo "<option value='$FK_ID' >$Selected_Value</option>";
								}

						echo    "</select>
								</div>
								</div>";

                    } //end of else display name for the forgien key is empty 

				}else{

					//check if contain you tube 
					if(preg_match('/'.$youtube.'/',$colum_update_name[$i])){
						echo "<div class='form-group' >
								<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
								<div class='col-sm-10'>";
								if(@$rowval[$i] !=''){
								  echo"<iframe src='$rowval[$i]' width='500' height='220' frameborder='0' allowfullscreen></iframe>
								  <input type='text' placeholder='Place Your URL Here' name='$colum_update_name_no_replace[$i]' value='$rowval[$i]' class='form-control input-rounded' style='width: 60%;' />";
								}else{
									echo "<img src='images/youtube.png' style='width:130px;height:80px;border-radius: 10px;margin-bottom:10px;'/><input type='text' placeholder='Place YouTube URL Here' name='$colum_update_name_no_replace[$i]' class='form-control input-rounded' style='width: 60%;'/>";
								}
						echo   "</div>
							   </div>";

					}else if(preg_match('/'.$password.'/',$colum_update_name[$i])){
						echo "<div class='form-group' >
									<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
									<div class='col-sm-10'>
										<input type='password' placeholder='Password' name='$colum_update_name_no_replace[$i]' value='$rowval[$i]' class='form-control input-rounded' style='width: 60%;' />
									</div>
							   </div>";

					}else if(preg_match('/'.$viedo.'/',$colum_update_name[$i])){
                        echo "<div class='form-group' >
								<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
								<div class='col-sm-10'>";
                    		if(@$rowval[$i] !=''){
                                  echo"<video width='320' height='240' controls><source src='$rowval[$i]' type='video/mp4'></video><input type='text' value='$rowval[$i]' name='$colum_update_name_no_replace[$i]' class='form-control input-rounded' style='width: 60%;'/>";
                        	}else{
                                  echo "<img src='images/video.png' style='width:130px;height:80px;border-radius: 10px;margin-bottom:10px;'/><input type='text' placeholder='Place Video URL Here' name='$colum_update_name_no_replace[$i]' class='form-control input-rounded' style='width: 60%;'/>";
                       		}

                        	echo "</div>
                        		</div>";

                    }else if(preg_match('/'.$images.'/',$colum_update_name[$i])){
						//same code for the blob type but we check for the name incase the type is not blob
                        if(@$rowval[$i] == ''){
								echo "<div class='form-group'>
								<label for='input-rounded' class='col-sm-2 control-label'>".@$colum_update_name[$i]."</label>
								<div class='col-sm-10'>
								    <img src='../images/default.png' style='width:80px;height:80px;'/><input type='file' id='$colum_update_name_no_replace[$i]' name='$colum_update_name_no_replace[$i]_uploadcoverimage' class='form-input' >
								</div>
								</div>";

							}else{
								echo "<div class='form-group'>
								<label for='input-rounded' class='col-sm-2 control-label'>".@$colum_update_name[$i]."</label>
								<div class='col-sm-10'>
								    <img src='".$uploads.$rowval[$i]."' style='width:80px;height:80px;'/><input type='file' id='$colum_update_name_no_replace[$i]' name='$colum_update_name_no_replace[$i]_uploadcoverimage' class='form-input' >
								</div>
								</div>";

							}	

							 if(!empty($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]['name'])){
                                //upload attachment
		                        $allowedExts = array("gif", "jpeg", "jpg", "png","JPEG","JPG","PNG","GIF");
		                        $temp = explode(".", $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["name"]);
		                        $extension = end($temp);
		                        if ((($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["type"] == "image/gif")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["type"] == "image/jpeg")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["type"] == "image/jpg")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["type"] == "image/pjpeg")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["type"] == "image/x-png")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["type"] == "image/png"))
		                        && ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["size"] < 2000000)
		                        && in_array($extension, $allowedExts))
		                          {
		                          if ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["error"] > 0)
		                            {
		                            echo "Return Code: " . $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["error"] . "<br>";
		                            }
		                          else
		                            {
		                             "Upload: " . $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["name"] . "<br>";
		                             "Type: " . $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["type"] . "<br>";
		                             "Size: " . ($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["size"] / 1024) . " kB<br>";
		                             "Temp file: " . $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["tmp_name"] . "<br>";

		                            if (file_exists($uploads . $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["name"]))
		                              {
		                              echo $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["name"] . " already exists. ";
		                              }
		                            else
		                              {
		                              move_uploaded_file($_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["tmp_name"],
		                              $uploads . $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["name"]);
		                               "Stored in: " . $uploads . $_FILES["$colum_update_name_no_replace[$i]_uploadcoverimage"]["name"];
		                              }
		                            }
		                          }
		                        else
		                          {
		                          echo "Invalid file";
		                          }
		                        //end of upload steps
		                        }


                    }else{

						 if(@$colum_update_type[$i] == 'text'){
							echo "<div class='form-group' >
								<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
								<div class='col-sm-10'>
								    <textarea class='form-control input-rounded' id='input-rounded' name='$colum_update_name_no_replace[$i]'>".@$rowval[$i]."</textarea>
								</div>
								</div>";
						}else if( @$colum_update_type[$i] != 'text' && $colum_update_orginaltype[$i] =='blob' && !preg_match('/'.$images.'/',$colum_update_name[$i])){
							if(@$rowval[$i] == ''){
								echo "<div class='form-group'>
								<label for='input-rounded' class='col-sm-2 control-label'>".@$colum_update_name[$i]."</label>
								<div class='col-sm-10'>
								    <img src='../images/default.png' style='width:80px;height:80px;'/><input type='file' id='$colum_update_name_no_replace[$i]' name='$colum_update_name_no_replace[$i]_coverimage' class='form-input' >
								</div>
								</div>";

							}else{
								echo "<div class='form-group'>
								<label for='input-rounded' class='col-sm-2 control-label'>".@$colum_update_name[$i]."</label>
								<div class='col-sm-10'>
								    <img src='data:image/jpeg;base64,".base64_encode(@$rowval[$i])."' style='width:80px;height:80px;'/><input type='file' id='$colum_update_name_no_replace[$i]' name='$colum_update_name_no_replace[$i]_coverimage' class='form-input' >
								</div>
								</div>";

							}	

							 if(!empty($_FILES["$colum_update_name_no_replace[$i]_coverimage"]['name'])){
                                //upload attachment
		                        $allowedExts = array("gif", "jpeg", "jpg", "png","JPEG","JPG","PNG","GIF");
		                        $temp = explode(".", $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["name"]);
		                        $extension = end($temp);
		                        if ((($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["type"] == "image/gif")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["type"] == "image/jpeg")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["type"] == "image/jpg")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["type"] == "image/pjpeg")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["type"] == "image/x-png")
		                        || ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["type"] == "image/png"))
		                        && ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["size"] < 2000000)
		                        && in_array($extension, $allowedExts))
		                          {
		                          if ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["error"] > 0)
		                            {
		                            echo "Return Code: " . $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["error"] . "<br>";
		                            }
		                          else
		                            {
		                             "Upload: " . $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["name"] . "<br>";
		                             "Type: " . $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["type"] . "<br>";
		                             "Size: " . ($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["size"] / 1024) . " kB<br>";
		                             "Temp file: " . $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["tmp_name"] . "<br>";

		                            if (file_exists("uploads/" . $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["name"]))
		                              {
		                              echo $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["name"] . " already exists. ";
		                              }
		                            else
		                              {
		                              move_uploaded_file($_FILES["$colum_update_name_no_replace[$i]_coverimage"]["tmp_name"],
		                              "uploads/" . $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["name"]);
		                               "Stored in: " . "uploads/" . $_FILES["$colum_update_name_no_replace[$i]_coverimage"]["name"];
		                              }
		                            }
		                          }
		                        else
		                          {
		                          echo "Invalid file";
		                          }
		                        //end of upload steps
		                        }



						}else if(@$colum_update_type[$i] == "timestamp"){

							echo "<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
									<input type='text' name='$colum_update_name_no_replace[$i]' class='form-control input-rounded' data-field='datetime' value='".@$rowval[$i]."'  data-format='yyyy-MM-dd hh:mm:ss' style='margin-left: 12px;width: 58%;'>
									<div id='dtBox'></div>";

						}else if(@$colum_update_type[$i] == "date" || @$colum_update_type[$i] == "Date"){

							echo "<label for='input-rounded' class='col-sm-2 control-label'>".$colum_update_name[$i]."</label>
									<input type='date' name='$colum_update_name_no_replace[$i]' class='form-control input-rounded' data-field='datetime' value='".@$rowval[$i]."'  data-format='yyyy-MM-dd' style='margin-left: 12px;width: 58%;'>
									<div id='dtBox'></div>";

						}else{
							
							if(preg_match('/'.$password.'/',$colum_update_name[$i])){
									// we need to check the forgien key and display name for them 
								echo "<div class='form-group'>
									<label for='input-rounded' class='col-sm-2 control-label'>".@$colum_update_name[$i]."</label>
									<div class='col-sm-10'>
									    <input type='password' class='form-control input-rounded' name='$colum_update_name_no_replace[$i]' value='".@$rowval[$i]."' id='input-rounded'>
									</div>
									</div>";

							}else{
								// we need to check the forgien key and display name for them 
								echo "<div class='form-group'>
									<label for='input-rounded' class='col-sm-2 control-label'>".@$colum_update_name[$i]."</label>
									<div class='col-sm-10'>
									    <input type='text' class='form-control input-rounded' name='$colum_update_name_no_replace[$i]' value='".@$rowval[$i]."' id='input-rounded'>
									</div>
									</div>";

							}
							
						}//end of type not text or blob 


					}//end of youtube
				}//end of if forgien key exsist 			
			}//end of if primry key 
		
	   

	}//end of loop for coulmn name 

}//end of while loop 



	if (isset($_POST['updaterecords'])) {

		//build the genric update query 
		$update_query = "";
		$update_query = "UPDATE $tablename SET ";
		$post_length = count($_POST);
		$counter = 0;
		$i=0;
		$y=0;

	    //check if image exsist
	    if(!empty(isset($_FILES))){
	    		//get the length of images that had been uploaded 
	    		foreach($_FILES as $value){
				  if (strlen($value['name'])){
				    $counter++;
				  }
				}

				$file_length = $counter -1;


				//build the query start with all fields are not image
				if($file_length < 0 ){  // no images uploaded or post 
					foreach ($_POST as $key => $value) {
						if ($key != 'updaterecords') {
							//check if this is the last value and key 
							if (preg_match('/'.$password.'/',$key)){
								$value = sha1($value);
							}
							if($i == $post_length -2){
								//build update query 
								$update_query .= "`".$key . "` = '" . $value . "'  ";
							}else{
								//build update query 
								$update_query .= "`".$key . "` = '" . $value . "' , ";
							}				
							$i++;		     
						}//end of build query 
						
					}

				}else{  // we have posted or uploaded images 
					foreach ($_POST as $key => $value) {
						if ($key != 'updaterecords') {
							if (preg_match('/'.$password.'/',$key)){
								$value = sha1($value);
							}
							//check if this is the last value and key 
							if($i == $post_length -2){
								//build update query 
								$update_query .= "`".$key . "` = '" . $value . "',  ";
							}else{
								//build update query 
								$update_query .= "`".$key . "` = '" . $value . "' , ";
							}				
							$i++;		     
						}//end of build query 
						
					}
				}//end of else we had uploaded images 
				
				
				//bild the query with images field 
				foreach ($_FILES as $key => $value) {	
					 $value = mysqli_real_escape_string($con,$value['name']);	 
					 //convert to blob 
					 if($value !=''){
					 	//check if normal upload or blob upload 
						if (preg_match('/_coverimage/',$key)){
							$key   = str_replace('_coverimage', '', $key);
							$value = file_get_contents($uploads.$value);
					 		$value = addslashes($value);
					 		//end of convert to blob
						}else if(preg_match('/_uploadcoverimage/',$key)){
							$key   = str_replace('_uploadcoverimage', '', $key);
						}
					 	if($y == $file_length){
							//build update query 
							if($value !=''){
								$update_query .= "`".$key . "` = '" . $value . "'  ";
							}							
						}else{
							//build update query 
							if($value !=''){
								$update_query .= "`".$key . "` = '" . $value . "',  ";
							}
						}	

						$y++;
					}								
				}	
				//end of build query 						
		}else{
				//append all fields with the query without images fields 
				foreach ($_POST as $key => $value) {
					if ($key != 'updaterecords') {
						if (preg_match('/'.$password.'/',$key)){
								$value = sha1($value);
							}
						//check if this is the last value and key 
						if($i == $post_length -2){
							//build update query 
							$update_query .= "`".$key . "` = '" . $value . "'  ";
						}else{
							//build update query 
							$update_query .= "`".$key . "` = '" . $value . "' , ";
						}				
						$i++;		     
					}//end of build query 				
				}
		}
		//end of check image		
		@$update_query .= "WHERE `$PrimryKey_DisplayName` = '" . $PrimID . "' ";	
		//end of build the genric update query 
		@$excute_update_query = mysqli_query($con,@$update_query);
		if(!mysqli_query($con,@$update_query)){
		 	 mysqli_error();
		}else{
			echo "<script>					
					window.opener.location.reload(true);
					window.opener.location ='../index.php?tablename=$tablename&Updated';
			        window.close();
				 </script>";			
		}
		
	}//end of update records 

}//end of all updats


?>
	<div class='form-group'>
		<div class='col-sm-10'>
		    <button type="submit" name="updaterecords" class="btn btn-primary">Update</button>	
		</div>
	</div>
 </form>
</div>
</div>
</main>


</body>
</html>


