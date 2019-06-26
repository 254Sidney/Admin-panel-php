<?php

include 'authentication/function.php';
include 'authentication/connection.php';

//get user login table info 


@$getuserlogintableinfo = mysqli_query($con,"SELECT * FROM userlogin_settings_genericadmin WHERE `userlogin_id` = '1' ");
 while ($userrow = mysqli_fetch_array($getuserlogintableinfo)) {                             
         @$usertable         = $userrow['tablename'];
         @$userloginfield    = $userrow['fieldname_username'];
         @$userloginpassword = $userrow['fieldname_password'];
    
 }

 if($usertable == ''){
    echo"<style>.tableMSG{display:block!important}.toast-info { background-color: #E26B7D!important;}</style>";
 }else if ($userloginfield == ''){
    echo"<style>.userfieldMSG{display:block!important}.toast-info { background-color: #E26B7D!important;}</style>";
 }else if($userloginpassword == '' ){
    echo"<style>.passwordfieldMSG{display:block!important}.toast-info { background-color: #E26B7D!important;}</style>";
 }else{

        if (isset($_POST['userlogin'])) {
                if (!empty(isset($_POST['username'])) && !empty(isset($_POST['userpassword']))) {
                    # code...
                    $username     = mysqli_real_escape_string($con,$_POST['username']);
                    $userpassword = mysqli_real_escape_string($con,$_POST['userpassword']);
                    $ASHPassword  = sha1($userpassword);

                    //get primary key 
                    $coulmtype  = GetCoulmsInfo($con,$usertable);
                    $primryname = $coulmtype['FieldsName'][0];

                    $getuserid=mysqli_query($con,"SELECT `$primryname` FROM `$usertable` WHERE `$userloginfield`='$username' AND `$userloginpassword`='$ASHPassword' ");
                    if (!$getuserid) {
                                echo"<style>.wronguserMSG{display:block!important}.toast-info { background-color: #E26B7D!important;}</style>";

                    }else{
                            $checkuserexsist=mysqli_num_rows($getuserid);
                            if ($checkuserexsist==0) {
                                echo"<style>.wronguserMSG{display:block!important}.toast-info { background-color: #E26B7D!important;}</style>";

                            }elseif ($checkuserexsist==1) {                                              
                                 // Fetch the user id from the query
            //$user_id = mysqli_result($getuserid, 0 ,$primryname);

                            mysqli_data_seek($getuserid, 0);
                            if( !empty($primryname) ) {
                              while($finfo = mysqli_fetch_field( $getuserid )) {
                                if( $primryname == $finfo->name ) {
                                  $f = mysqli_fetch_assoc( $getuserid );
                                  $user_id =  $f[ $primryname ];
                                }
                              }
                            } else {
                              $f = mysqli_fetch_array( $getuserid );
                              $user_id = $f[0];
                            } 
                                    // Store the user id in the Session
                                    // Note : The Session is Started in the page Core.inc.php which is included to the index page and has session.start();
                                       $_SESSION['userid'] = $user_id;
                                       $id=$_SESSION['userid'];

                                       $_SESSION['username'] = $username;
                                       
                                    echo "<script>window.location ='index.php'</script>";

                            }
                    }
                }
        }

    }
?>



<!DOCTYPE html>
<html>
<head>

<!-- Title -->
<title>Modern | Login - Sign in</title>

<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="UTF-8">
<meta name="description" content="Admin Dashboard Template" />
<meta name="keywords" content="admin,dashboard" />
<meta name="author" content="Steelcoders" />

<!-- Styles -->
<link href='fonts/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
<link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/> 
<link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>  
<link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>  
<link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/> 
<link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>   
<link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>  
<link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>    

<!-- Theme Styles -->
<link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
<link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>

<script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
<script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="page-login">
<div id="toast-container" class="toast-top-full-width tableMSG" aria-live="polite" role="alert" style="display:none"><div class="toast toast-info"><div class="toast-message">You Didn't Configure User Table !!</div></div></div>
<div id="toast-container" class="toast-top-full-width userfieldMSG" aria-live="polite" role="alert" style="display:none"><div class="toast toast-info"><div class="toast-message">You Didn't Configure User Login Field  !!</div></div></div>
<div id="toast-container" class="toast-top-full-width passwordfieldMSG" aria-live="polite" role="alert" style="display:none"><div class="toast toast-info"><div class="toast-message">You Didn't Configure Password Login Field !!</div></div></div>
<div id="toast-container" class="toast-top-full-width wronguserMSG" aria-live="polite" role="alert" style="display:none"><div class="toast toast-info"><div class="toast-message"><span>Sorry!</span> Invalid username / password !!</div></div></div>

<main class="page-content">
<div class="page-inner">
<div id="main-wrapper">
<div class="row">
<div class="col-md-3 center">
    <div class="login-box">
        <a href="index.html" class="logo-name text-lg text-center">Generic Admin</a>
        <p class="text-center m-t-md">Please login into your dashboard.</p>
        <form class="m-t-md" method ="POST" action="">
            <div class="form-group">
                <input type="text" name="username"  class="form-control" placeholder="User Name" required>
            </div>
            <div class="form-group">
                <input type="password" name="userpassword" class="form-control" placeholder="User Password" required>
            </div>
            <button type="submit" name="userlogin" class="btn btn-success btn-block">Login</button>
                                           
        </form>
        <p class="text-center m-t-xs text-sm">2015 &copy; Generic Admin.</p>
    </div>
</div>
</div><!-- Row -->
</div><!-- Main Wrapper -->
</div><!-- Page Inner -->
</main><!-- Page Content -->


<!-- Javascripts -->
<script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../assets/plugins/pace-master/pace.min.js"></script>
<script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/switchery/switchery.min.js"></script>
<script src="../assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
<script src="../assets/plugins/waves/waves.min.js"></script>
<script src="../assets/js/modern.min.js"></script>

</body>
</html>