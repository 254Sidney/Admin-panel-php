<?php
require 'connection.php';

// Start headers

session_start();

//header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
//header( 'Cache-Control: post-check=0, pre-check=0', false ); 
//header( 'Pragma: no-cache' );

//set cookies
$last = 2592000 + time(); 
//$min=600 +time();
//this adds 30 days to the current time 
setcookie('AboutVisit', date("F jS - g:i a"), $last);
ob_start();
// Return the current page file name
 $current_file = $_SERVER['SCRIPT_NAME'];
// Returns The Page that we came from
if (isset($_SERVER['HTTP_REFERER'])) {
	$http_referer = $_SERVER['HTTP_REFERER'];
}



// A Function To Check if the User Is Logged in . 
// We Did this function here so we can user it everywhere and we dont have to do this long if again
function LoginTableName($con){
    $getusertablename = mysqli_query($con,"SELECT `tablename` FROM `userlogin_settings_genericadmin` WHERE `userlogin_id` = '1' ");
    $usertable        = mysqli_result($getusertablename, 0);  

        return $usertable;	
}


function loggedin(){
    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        return true;
    } else {
        return false;
    }
}

 function recursive_remove_directory($directory, $empty=FALSE)
 {
     // if the path has a slash at the end we remove it here
     if(substr($directory,-1) == '/')
     {
         $directory = substr($directory,0,-1);
     }
  
     // if the path is not valid or is not a directory ...
     if(!file_exists($directory) || !is_dir($directory))
     {
         // ... we return false and exit the function
         return FALSE;
  
     // ... if the path is not readable
     }elseif(!is_readable($directory))
     {
         // ... we return false and exit the function
         return FALSE;
  
     // ... else if the path is readable
     }else{
  
         // we open the directory
         $handle = opendir($directory);
  
         // and scan through the items inside
         while (FALSE !== ($item = readdir($handle)))
         {
             // if the filepointer is not the current directory
             // or the parent directory
             if($item != '.' && $item != '..')
             {
                 // we build the new path to delete
                 $path = $directory.'/'.$item;
  
                 // if the new path is a directory
                 if(is_dir($path)) 
                 {
                     // we call this function with the new path
                     recursive_remove_directory($path);
  
                // if the new path is a file
                 }else{
                     // we remove the file
                     unlink($path);
                 }
             }
         }
         // close the directory
         closedir($handle);
  
         // if the option to empty is not set to true
         if($empty == FALSE)
         {
             // try to delete the now empty directory
             if(!rmdir($directory))
             {
                 // return false if not possible
                 return FALSE;
             }
         }
         // return success
         return TRUE;
     }
 }

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function QueryResult($con,$query){
    $query_syntax = mysqli_query($con,$query);
    return $query_syntax;
}

function DisplyTables($con){
    $AllTables = mysqli_query($con,"show tables"); // run the query and assign the AllTables to $AllTables
    $i=0;
    $TablesObj = array();
    while($table = mysqli_fetch_array($AllTables)) { // go through each row that was returned in $AllTables
         $tablename = $table[0];
         if($tablename != 'configuer_settings_genericadmin' && $tablename != 'statistics_settings_genericadmin' && $tablename != 'userlogin_settings_genericadmin'){
            echo  "<li><a href='?tablename=$tablename' class='waves-effect waves-button'><span class='menu-icon glyphicon glyphicon-list'></span><p>".ucfirst(str_replace('_', ' ', $tablename))."</p></a></li>";
         }
         $TablesObj[$i] = $tablename;
         $i++;
    }
    return $TablesObj;
}
function Tables($con){
    $tablequery = "show tables";
    $AllTables = mysqli_query($con,$tablequery); // run the query and assign the AllTables to $AllTables
    $i=0;
    $TablesObj = array();
    while($table = mysqli_fetch_array($AllTables)) { // go through each row that was returned in $AllTables
         $tablename = $table[0];
         if($tablename != 'configuer_settings_genericadmin'){
            $TablesObj[$i] = $tablename;
            $i++;
         }
         
    }
    return $TablesObj;
}

function GetUserInfo($con){
    $userid         = $_SESSION['userid'];
    $usertablename  = LoginTableName($con);
    $coulmtype      = GetCoulmsInfo($con,$usertablename);
    $primryname     = $coulmtype['FieldsName'][0];
    $username      = $_SESSION['username'];
    $guestuserinfo  = mysqli_query($con,"SELECT * FROM `$usertablename` WHERE `$primryname` = '$userid' ");
     
    $cloumnnumber = mysqli_num_fields($guestuserinfo);

    //get all config info if exsist 
    @$confObj = CheckconfigInfo($con);
    //prepare the variables for youtube and viedo and images 
    if(count($confObj) > 0){
        if($confObj['fieldname_image'] != ''){
            $images  = str_replace('_', '', $confObj['fieldname_image']);
        }else{
            $images  = 'Image'; 
        }
    }else{
        $images  = 'Image'; 
    }

    //check if user has image or not 
    while ($userrow = mysqli_fetch_array($guestuserinfo)) {
        for ($i=0; $i < $cloumnnumber ; $i++) { 
            $fieldname =  $coulmtype['FieldsName'][$i];

            if(preg_match('/'.$images.'/',$fieldname)){
                @$userimagename = $userrow[$i];
                @$imagefieldtype = $coulmtype['OrginalFieldType'][$i];
            }else if($coulmtype['OrginalFieldType'][$i] == 'blob' && $coulmtype['FieldType'][$i] != 'text'){
                @$userimagename = $userrow[$i];
                @$imagefieldtype = $coulmtype['OrginalFieldType'][$i];
            }
        }    
    }

    if (@$userimagename !='') {
        
        $userinfo = array();
        $userinfo[0] = $username.'___'.$userimagename.'___'.$imagefieldtype;
        return $userinfo;
    }else{
        $userinfo = array();
        $userinfo[0] = $username;
        return $userinfo;
    }
}

function mysqli_get_foregin_key($con,$table,$field){
        $sql = "SHOW INDEX FROM $table WHERE Column_name = '$field' and Key_name != 'PRIMARY' ";
        $gp = mysqli_query($con,$sql);
        $cgp = mysqli_num_rows($gp);
        if($cgp > 0){
        // Note I'm not using a while loop because I never use more than one prim key column
        //$agp = mysqli_fetch_array($gp);
        while ($agp=mysqli_fetch_array($gp)) {
            extract($agp);
            return($Column_name);
        }

        }else{
            return(false);
        }
    }



function GetAllForeginKey_Info($con,$DB){
        $AllFKObject = array();
        $itreation=0;
        $Allforgeninfo = mysqli_query($con,"select concat(referenced_table_name, '.', referenced_column_name) as 'references'
        from
            information_schema.key_column_usage
        where
            referenced_table_name is not null
            and table_schema = '$DB'");
        while($row=mysqli_fetch_array($Allforgeninfo )){
            $All_FK_TableName = @end(array_pop(explode('.', $row['references'])));
            $All_FK_PrimaryID = substr($row['references'], 0, strrpos($row['references'], '.'));
            $CONECTTABLENAMEWITHFK = $All_FK_TableName.".".$All_FK_PrimaryID;
            if (!in_array($CONECTTABLENAMEWITHFK, $AllFKObject)) {
                $AllFKObject[$itreation] = $CONECTTABLENAMEWITHFK;
                $itreation++;
             }
        }
        return $AllFKObject;
    }

function GetForeginKey_TableName($con,$tablename,$fk){
        $FKObject = array();
        $forgentablename = mysqli_query($con,"SELECT REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE  WHERE  TABLE_NAME='$tablename' and COLUMN_NAME='$fk'");
        while($row=mysqli_fetch_array($forgentablename )){
            $FK_TableName = $row['REFERENCED_TABLE_NAME'];
            $FK_PrimaryID = $row['REFERENCED_COLUMN_NAME'];
            $FKObject[$fk] = $FK_TableName.".".$FK_PrimaryID;
        }
        return $FKObject;
    }

function GetForgienTablename_ForSpecific_Tablename($tablename){
    $FKAllObject = array();
    $y=0;

    $AllFKTableName = mysqli_query("SELECT  ke.table_name ,ke.column_name FROM  information_schema.KEY_COLUMN_USAGE ke WHERE  ke.referenced_table_name ='$tablename' ORDER BY  ke.referenced_table_name");
    while(@$row=mysqli_fetch_array($AllFKTableName )){
            for ($i=0; $i < count($row) ; $i++) { 
             @$FKTableName = $row['table_name'];
             @$FKidName = $row['column_name'];
                 if (!in_array($FKTableName.".".$FKidName, $FKAllObject)) {
                  @$FKAllObject[$y] = $FKTableName.".".$FKidName;
                  $y++;
                }
            }

        }
        return $FKAllObject;

}

function GetCloumName($con,$table){
    $columname = QueryResult($con,"SHOW COLUMNS FROM $table");
    $counter = 0;
    while($row=mysqli_fetch_array($columname)){
        if($counter < 8){
           echo "<td>$row[0]</td>"; 
        }
        $counter++;        
    }
}

function GetUpdateCloumName($con,$table){
    $columname = QueryResult($con,"SHOW COLUMNS FROM $table");
    while($row=mysqli_fetch_array($columname)){       
           echo "<td>$row[0]</td>";           
    }
}

function CheckconfigInfo($con){

    $configObject = [];
    @$getallconfiginfo = mysqli_query($con,"SELECT * FROM `configuer_settings_genericadmin` WHERE `Config_id` = '1'");
    while (@$confrow = mysqli_fetch_array($getallconfiginfo)) {

            $fieldname_image     = $confrow['fieldname_image'];
            $uploaddirectory     = $confrow['uploaddirectory'];
            $youtubefieldname    = $confrow['youtubefieldname'];
            $viedofieldname      = $confrow['viedofieldname'];
            $passwordfieldname   = $confrow['passwordfieldname'];

            $configObject['fieldname_image']  = $fieldname_image;
            $configObject['uploaddirectory']  = $uploaddirectory;
            $configObject['youtubefieldname'] = $youtubefieldname;
            $configObject['viedofieldname']  = $viedofieldname;
            $configObject['passwordfieldname']  = $passwordfieldname;

            if($configObject['uploaddirectory'] != ''){
                if (!file_exists($configObject['uploaddirectory'])) {
                    mkdir($configObject['uploaddirectory'], 0777, true);
                }
            }
        
    }


    
    return $configObject;
}
//start of pagination 
function pagination($con,$query,$per_page=10,$page=1,$url='?',$tablename){   

    $query = "SELECT COUNT(*) as `num` FROM {$query}";
    $row = mysqli_fetch_array(mysqli_query($con,$query));
    $total = $row['num'];
    $adjacents = "2"; 
     
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination'>";
        $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
             
            if ($page > 1) $pagination.= "<li><a href='{$url}tablename=$tablename&page={$prev}'>{$prevlabel}</a></li>";
             
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}tablename=$tablename&page={$counter}'>{$counter}</a></li>";                    
            }
         
        } elseif($lastpage > 5 + ($adjacents * 2)){
             
            if($page < 1 + ($adjacents * 2)) {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}tablename=$tablename&page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='{$url}tablename=$tablename&page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}tablename=$tablename&page={$lastpage}'>{$lastpage}</a></li>";  
                     
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                 
                $pagination.= "<li><a href='{$url}tablename=$tablename&page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}tablename=$tablename&page=2'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}tablename=$tablename&page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}tablename=$tablename&page={$lastpage}'>{$lastpage}</a></li>";      
                 
            } else {
                 
                $pagination.= "<li><a href='{$url}tablename=$tablename&page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}tablename=$tablename&page=2'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}tablename=$tablename&page={$counter}'>{$counter}</a></li>";                    
                }
            }
        }
         
            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}tablename=$tablename&page={$next}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}tablename=$tablename&page=$lastpage'>{$lastlabel}</a></li>";
            }
         
        $pagination.= "</ul>";        
    }
     
    return $pagination;
}
//end of pagination 
function GetcolumnValue($con,$table,$Forgien_Key_Display_Field){

    $coulmtype  = GetCoulmsInfo($con,$table);
    $primryname = $coulmtype['FieldsName'][0];
    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    if ($page <= 0) $page = 1;  
    $per_page = 10; // Set how many records do you want to display per page.  
    $startpoint = ($page * $per_page) - $per_page; 
    $statement = "`$table` ORDER BY `$primryname` DESC"; // Change `records` according to your table name.
    $columvalue = QueryResult($con,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
    $counter = 0;
    $itreation_FK = 0;
    $limtbuttonrepeat = 0; 
    //get config info 
    $confObj = CheckconfigInfo($con);

 

    
    while($rowvalue=mysqli_fetch_row($columvalue)){
        echo "<form method='POST' action='authentication/deletequery.php' data-form='true' id='myform_$counter'><tr>";
        //we check the length to make it fit with the table responsive

        //append the radio button 
        echo "<td ><span id='hash'>#</span><input type='radio' name='showrelatedinfo' value='".$rowvalue[0]."' style='display:none;margin-top: -2px;opacity: 1;margin-left: 0px;position: inherit;'></td>";
        if (count($rowvalue) < 8) {        
            for($i = 0; $i < count($rowvalue) ; $i++) {
                    //get primry key for the fields less than 8 
                 $prima=mysqli_get_foregin_key($con,$table,$coulmtype['FieldsName'][$i]);
                if($prima != ''){
                    //get FK tablename and primary key for the forgien key and the display name if exsist and its value
                    $FK = GetForeginKey_TableName($con,$table,$prima);
                    $Tablename_FK  = substr($FK[$prima], 0, strpos($FK[$prima], '.'));               
                    // add the button to get all info for this primary key from the related table 
                    @$fktables = GetForgienTablename_ForSpecific_Tablename($table); 
                    @$fktablesname = substr($fktables[$limtbuttonrepeat], 0, strpos($fktables[$limtbuttonrepeat], '.'));
                    @$fkidname =  end( explode( ".", $fktables[$limtbuttonrepeat] ));
                    if($limtbuttonrepeat < count($fktables) && $fktablesname !=''){
                       echo "<a id='displayrelatedrecords' onclick=\"window.open('authentication/displayrelatedinfo.php?tablename=$table&relatedinfo=$fktablesname&fkfieldname=$fkidname&relatedid=$rowvalue[0]&true','Display Related Info','scrollbars=1,resizable=1,width=1200,height=640')\" style=\"cursor: pointer;margin-bottom:10px;margin-right:10px;display:none\" class='btn btn-info'>Display "." ".ucfirst($fktablesname)."</a> ";
                    }
                    $limtbuttonrepeat++;
                    $PK_Name_For_FK = @end( explode( ".", $FK[$prima] ));
                    $FKNAME = $coulmtype['FieldsName'][$i];
                    $PK_Value_For_FK  = $rowvalue[$i];
                     if(!empty($Forgien_Key_Display_Field)){    
                        if(array_key_exists($Tablename_FK, $Forgien_Key_Display_Field)){                   
                            $FK_Field_Display = $Forgien_Key_Display_Field[$Tablename_FK];
                            @$FK_Query = QueryResult($con,"SELECT * FROM $Tablename_FK  WHERE `$PK_Name_For_FK` = '$PK_Value_For_FK' ");
                            while(@$FKRow = mysqli_fetch_array(@$FK_Query)){
                                echo "<td>".$FKRow[$FK_Field_Display]."</td>";
                            }
                            echo "<input  type=\"hidden\" name=\"Tablename_FK\" prim_key=\"$PK_Value_For_FK\" display_name=\"$FK_Field_Display\" value=\"$Tablename_FK\">";
                        }else{
                            $FK_Query = QueryResult($con,"SELECT * FROM $Tablename_FK  WHERE `$PK_Name_For_FK` = '$PK_Value_For_FK' ");
                            while($FKRow = mysqli_fetch_array($FK_Query)){
                                echo "<td>".substr($FKRow[0], 0, 60)."</td>";
                            }
                            echo "<input  type=\"hidden\" name=\"Tablename_FK\" prim_key=\"$PK_Value_For_FK\"  value=\"$Tablename_FK\">";                                                  
                        }//end of array has no value for this tablename 
                    }else{
                        $FK_Query = QueryResult($con,"SELECT * FROM $Tablename_FK  WHERE `$PK_Name_For_FK` = '$PK_Value_For_FK' ");
                        while($FKRow = mysqli_fetch_array($FK_Query)){
                            echo "<td>".substr($FKRow[0], 0, 60)."</td>";
                        }
                        echo "<input  type=\"hidden\" name=\"Tablename_FK\" prim_key=\"$PK_Value_For_FK\"  value=\"$Tablename_FK\">";
                    }                        

                 }else{

                    //prepare the variables for youtube and viedo and images 
                    if(count($confObj) > 0){
                        if($confObj['fieldname_image'] != ''){
                            $images  = $confObj['fieldname_image'];
                        }else{
                            $images  = 'Image'; 
                        }
                        if($confObj['youtubefieldname'] != ''){
                            $youtube = $confObj['youtubefieldname'];
                        }else{
                            $youtube = 'YouTube';
                        }

                        if($confObj['viedofieldname'] != ''){
                            $viedo   = $confObj['viedofieldname'];
                        }else{
                            $viedo   = 'Video';
                        }

                    }else{
                        $youtube = 'YouTube';
                        $viedo   = 'Video';
                        $images  = 'Image';   
                    }
                    


                    //check for youtube              
                    if(preg_match('/'.$youtube.'/',$coulmtype['FieldsName'][$i]) ){
                        if(@$rowvalue[$i] !=''){
                                  echo"<td><iframe src='$rowvalue[$i]' width='130' height='100' frameborder='0' scrolling='no' allowfullscreen></iframe></td>";
                        }else{
                                  echo "<td><img src='images/youtube.png' style='width:130px;height:80px;border-radius: 10px;'/></td>";
                        }
                    }else if(preg_match('/'.$viedo.'/',$coulmtype['FieldsName'][$i])){
                        if(@$rowvalue[$i] !=''){
                                  echo"<td><video width='320' height='240' controls><source src='$rowvalue[$i]' type='video/mp4'></video>  </td>";
                        }else{
                                  echo "<td><img src='images/video.png' style='width:130px;height:80px;border-radius: 10px;'/></td>";
                        }
                    }else if(preg_match('/'.$images.'/',$coulmtype['FieldsName'][$i]) && $coulmtype['OrginalFieldType'][$i] != "blob" && $coulmtype['FieldType'][$i] != "text" ){
                        //same code for the blob type but we check for the name incase the type is not blob
                        if($rowvalue[$i] == ''){
                            echo "<td><img src='images/default.png' style='width:80px;height:80px;border-radius: 10px;'/></td>";
                        }else{
                            echo "<td><img src='authentication/uploads/$rowvalue[$i]' style='width:80px;height:80px;border-radius: 10px;'/></td>";     
                        }

                    }else{
                        if($coulmtype['OrginalFieldType'][$i] == "blob" && $coulmtype['FieldType'][$i] != "text"){
                           if($rowvalue[$i] == ''){
                             echo "<td><img src='images/default.png' style='width:80px;height:80px;border-radius: 10px;'/></td>";
                            }else{
                                 echo "<td><img src='data:image/jpeg;base64,".base64_encode( $rowvalue[$i])."' style='width:80px;height:80px;border-radius: 10px;'/></td>";   
                            }
                        }else{
                            echo "<td>".substr($rowvalue[$i], 0, 40)."</td>";
                        }
                    }                  

                 }//end of primary key               
                // add the edit and delete at the end of columns
                if($i==(count($rowvalue)-1)){
                    echo "<input  type='hidden' name='tablename' value='$table' />
                           <input  type='hidden' name='mainid' value='$rowvalue[0]' />";
                    echo "<td><a onclick=\"window.open('authentication/ineredit.php?tablename=$table&edit=$rowvalue[0]','Update Recors','scrollbars=1,resizable=1,width=600,height=640')\" style=\"cursor: pointer;\">Edit</a></td><td><input  form='myform_$counter' type='submit' name='delete' value='Delete' class=\"btn btn-danger\"  style=\"cursor: pointer;\" /></td>";
                }
            }

        }else{                
              for($i = 0; $i < 8 ; $i++) {
                //get primry key for the fields less than 8 
                 $prima=mysqli_get_foregin_key($con,$table,$coulmtype['FieldsName'][$i]);
                if($prima != ''){
                    //get FK tablename and primary key for the forgien key and the display name if exsist and its value
                    $FK = GetForeginKey_TableName($con,$table,$prima);
                    $Tablename_FK  = substr($FK[$prima], 0, strpos($FK[$prima], '.'));
                    // add the button to get all info for this primary key from the related table 
                    @$fktables = GetForgienTablename_ForSpecific_Tablename($table); 
                    @$fktablesname = substr($fktables[$limtbuttonrepeat], 0, strpos($fktables[$limtbuttonrepeat], '.'));
                    @$fkidname =  end( explode( ".", $fktables[$limtbuttonrepeat] ));
                    if($limtbuttonrepeat < count($fktables) && $fktablesname !=''){
                       echo "<a id='displayrelatedrecords' onclick=\"window.open('authentication/displayrelatedinfo.php?tablename=$table&relatedinfo=$fktablesname&fkfieldname=$fkidname&relatedid=$rowvalue[0]&true','Display Related Info','scrollbars=1,resizable=1,width=1200,height=640')\" style=\"cursor: pointer;margin-bottom:10px;margin-right:10px;display:none\" class='btn btn-info'>Display "." ".ucfirst($fktablesname)."</a> ";
                    }
                    $limtbuttonrepeat++;
                    $PK_Name_For_FK = end( explode( ".", $FK[$prima] ) );
                    $FKNAME = $coulmtype['FieldsName'][$i];
                    $PK_Value_For_FK  = $rowvalue[$i];
                     if(!empty($Forgien_Key_Display_Field)){
                         if(array_key_exists($Tablename_FK, $Forgien_Key_Display_Field)){                   
                            $FK_Field_Display = $Forgien_Key_Display_Field[$Tablename_FK];
                            @$FK_Query = QueryResult($con,"SELECT * FROM $Tablename_FK  WHERE `$PK_Name_For_FK` = '$PK_Value_For_FK' ");
                            while(@$FKRow = mysqli_fetch_array(@$FK_Query)){
                                echo "<td>".$FKRow[$FK_Field_Display]."</td>";
                            }
                            echo "<input  type=\"hidden\" name=\"Tablename_FK\" prim_key=\"$PK_Value_For_FK\" display_name=\"$FK_Field_Display\" value=\"$Tablename_FK\">";
                        }else{

                            @$FK_Query = QueryResult($con,"SELECT * FROM $Tablename_FK  WHERE `$PK_Name_For_FK` = '$PK_Value_For_FK' ");
                            while(@$FKRow = mysqli_fetch_array(@$FK_Query)){
                                echo "<td>".substr($FKRow[0], 0, 60)."</td>";
                            }
                            echo "<input  type=\"hidden\" name=\"Tablename_FK\" prim_key=\"$PK_Value_For_FK\"  value=\"$Tablename_FK\">";                                                  
                        }//end of array has no value for this tablename 

                    }else{

                        $FK_Query = QueryResult($con,"SELECT * FROM $Tablename_FK  WHERE `$PK_Name_For_FK` = '$PK_Value_For_FK' ");
                        while($FKRow = mysqli_fetch_array($FK_Query)){
                            echo "<td>".substr($FKRow[0], 0, 60)."</td>";
                        }
                        echo "<input  type=\"hidden\" name=\"Tablename_FK\" prim_key=\"$PK_Value_For_FK\"  value=\"$Tablename_FK\">";
                    }
                 }else{

                     //prepare the variables for youtube and viedo and images 
                    if(count($confObj) > 0){
                        if($confObj['fieldname_image'] != ''){
                            $images  = $confObj['fieldname_image'];
                        }else{
                            $images  = 'Image'; 
                        }
                        if($confObj['youtubefieldname'] != ''){
                            $youtube = $confObj['youtubefieldname'];
                        }else{
                            $youtube = 'YouTube';
                        }

                        if($confObj['viedofieldname'] != ''){
                            $viedo   = $confObj['viedofieldname'];
                        }else{
                            $viedo   = 'Video';
                        }

                    }else{
                        $youtube = 'YouTube';
                        $viedo   = 'Video';
                        $images  = 'Image';   
                    }
                    
                      //check for youtube              
                    if(preg_match('/'.$youtube.'/',$coulmtype['FieldsName'][$i])){
                        if(@$rowvalue[$i] !=''){
                                  echo"<td><iframe src='$rowvalue[$i]' width='130' height='100' frameborder='0' scrolling='no' allowfullscreen></iframe></td>";
                        }else{
                                  echo "<td><img src='images/youtube.png' style='width:130px;height:80px;border-radius: 10px;'/></td>";
                        }
                    }else if(preg_match('/'.$viedo.'/',$coulmtype['FieldsName'][$i])){
                        if(@$rowvalue[$i] !=''){
                                  echo"<td><video width='320' height='240' controls><source src='$rowvalue[$i]' type='video/mp4'></video>  </td>";
                        }else{
                                  echo "<td><img src='images/video.png' style='width:130px;height:80px;border-radius: 10px;'/></td>";
                        }
                    }else if(preg_match('/'.$images.'/',$coulmtype['FieldsName'][$i]) && $coulmtype['OrginalFieldType'][$i] != "blob"  && $coulmtype['FieldType'][$i] != "text"){
                        //same code for the blob type but we check for the name incase the type is not blob
                        if($rowvalue[$i] == ''){
                            echo "<td><img src='images/default.png' style='width:80px;height:80px;border-radius: 10px;'/></td>";

                        }else{
                             echo "<td><img src='authentication/uploads/$rowvalue[$i]' style='width:80px;height:80px;border-radius: 10px;'/></td>";     
                        }

                    }else{
                        if($coulmtype['OrginalFieldType'][$i] == "blob" && $coulmtype['FieldType'][$i] != "text"){
                           if($rowvalue[$i] == ''){
                             echo "<td><img src='images/default.png' style='width:80px;height:80px;border-radius: 10px;'/></td>";
                            }else{
                                 echo "<td><img src='data:image/jpeg;base64,".base64_encode( $rowvalue[$i])."' style='width:80px;height:80px;border-radius: 10px;'/></td>";    
                            }
                        }else{
                            echo "<td>".substr($rowvalue[$i], 0, 40)."</td>";
                         }
                    }
                 }//end of primary key 
               
                // add the edit and delete at the end of columns
                if($i==(8-1)){              
                   echo "<input  type='hidden' name='tablename' value='$table' />
                           <input  type='hidden' name='mainid' value='$rowvalue[0]' />
                           <td><a onclick=\"window.open('authentication/ineredit.php?tablename=$table&edit=$rowvalue[0]','Update Records','scrollbars=1,resizable=1,width=600,height=640')\" style=\"cursor: pointer;\">Edit</a></td><td><input  form='myform_$counter' type='submit' name='delete' value='Delete' class=\"btn btn-danger\"  style=\"cursor: pointer;\" /></td>";
                }
            }

        }//end of if number of col more less than 8 

        echo "</tr></form>";
        $counter++;

    }//end of while loop 

    // displaying paginaiton.
    echo pagination($con,$statement,$per_page,$page,$url='?',$table);
}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

function GetCoulmsInfo($con,$table){
$tableObject  =   array();
$tablename    = $table;
//get coulms number 
$columname    = QueryResult($con,"SHOW COLUMNS FROM $tablename");
$columnnumber = mysqli_num_rows($columname);
//end of get coulms number 
//get coulm type and name 
$columinfo    = QueryResult($con,"SELECT *  FROM $tablename ");
                for ($i=0; $i < $columnnumber; $i++) {
                    $orginalfieldtype[]  = mysqli_fetch_field_direct($columinfo, $i)->type; 
                    $fieldsname[] = mysqli_fetch_field_direct($columinfo,$i)->name;    
                }
//this query to get the orginal data_type where in the above query the data type return blob for both (blob,text);
$OrginalDataType = QueryResult($con,"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tablename' ");
    while ($row = mysqli_fetch_array($OrginalDataType)) {
       $fieldtype[] =  $row['DATA_TYPE'];
    }
//define varibal to get the ids for each tables columns  and store it in session 
$primrykeyname = mysqli_fetch_field_direct($columinfo, 0)->name; 
$tableObject['FieldType']           = @$fieldtype;
$tableObject['OrginalFieldType']    = @$orginalfieldtype;
$tableObject['FieldsName']          = @$fieldsname;
$tableObject['primrykeyname']       = @$primrykeyname;
$tableObject['columnnumber']        = @$columnnumber;

return $tableObject;

}


?>
