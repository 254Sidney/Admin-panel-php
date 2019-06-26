<?php


include 'authentication/FK_Config.php';
include 'authentication/function.php';
include 'authentication/connection.php';

if (!loggedin()) {

header('Location: ' . 'login.php');
//echo "this is the session".$_SESSION['user_id'];
} else {

?>
<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>Dynamic | Admin Dashboard </title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard,generic,dynamic admin,php admin,website content mangment,CRM, PHP CRM , generic mangment , free admin, free website admin, free website php admin, free generic admin " />
        <meta name="author" content="ali alroomi" />
        
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

        <!--pagination css -->

        <style type="text/css">
            ul.pagination {
                text-align:center;
                color:#829994;
            }
            ul.pagination li {
                display:inline;
                padding:0 3px;
            }
            ul.pagination a {
                color:#0d7963;
                display:inline-block;
                padding:5px 10px;
                border:1px solid #cde0dc;
                text-decoration:none;
            }
            ul.pagination a:hover, 
            ul.pagination a.current {
                background:#0d7963;
                color:#fff; 
            }

        </style>
        
    </head>
    <body class="page-header-fixed">
    <?php
        if(isset($_GET['Done']) || isset($_GET['error'])){
            echo"<style>#toast-container{display:block!important}</style>";
        }else if(isset($_GET['Updated'])){
            echo"<style>.UpdateMSG{display:block!important}</style>";
        }else if(isset($_GET['Submited'])){
            echo"<style>.SubmitMSG{display:block!important}</style>";
        }

        //delete settings folder 
        recursive_remove_directory('install/');

    ?>
        <div class="overlay"></div>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
            <h3><span class="pull-left">Chat</span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
            <div class="slimscroll">
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="../assets/images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
            </div>
        </nav>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
            <h3><span class="pull-left">Sandra Smith</span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
            <div class="slimscroll chat">
                <div class="chat-item chat-item-left">
                    <div class="chat-image">
                        <img src="../assets/images/avatar2.png" alt="">
                    </div>
                    <div class="chat-message">
                        Hi There!
                    </div>
                </div>
                <div class="chat-item chat-item-right">
                    <div class="chat-message">
                        Hi! How are you?
                    </div>
                </div>
                <div class="chat-item chat-item-left">
                    <div class="chat-image">
                        <img src="../assets/images/avatar2.png" alt="">
                    </div>
                    <div class="chat-message">
                        Fine! do you like my project?
                    </div>
                </div>
                <div class="chat-item chat-item-right">
                    <div class="chat-message">
                        Yes, It's clean and creative, good job!
                    </div>
                </div>
                <div class="chat-item chat-item-left">
                    <div class="chat-image">
                        <img src="../assets/images/avatar2.png" alt="">
                    </div>
                    <div class="chat-message">
                        Thanks, I tried!
                    </div>
                </div>
                <div class="chat-item chat-item-right">
                    <div class="chat-message">
                        Good luck with your sales!
                    </div>
                </div>
            </div>
            <div class="chat-write">
                <form class="form-horizontal" action="javascript:void(0);">
                    <input type="text" class="form-control" placeholder="Say something">
                </form>
            </div>
        </nav>
        <div class="menu-wrap">
            <nav class="profile-menu">
                <div class="profile">
               

                 <img src="../assets/images/profile-menu-image.png" width="60" alt="David Green"/>

                 <span>David Green</span>

                 </div>
                <div class="profile-menu-list">
                    <a href="#"><i class="fa fa-star"></i><span>Favorites</span></a>
                    <a href="#"><i class="fa fa-bell"></i><span>Alerts</span></a>
                    <a href="#"><i class="fa fa-envelope"></i><span>Messages</span></a>
                    <a href="#"><i class="fa fa-comment"></i><span>Comments</span></a>
                </div>
            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>
        <form class="search-form" action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div><!-- Input Group -->
        </form><!-- Search Form -->
        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="#" class="logo-text"><span>
                        <?php
                            //check project name 
                            @$getprojectname = mysqli_query($con,"SELECT projectname from configuer_settings_projectname WHERE `projectid` = 1 ");
                            @$result = mysqli_result($getprojectname, 0);
                            if($result != ''){
                                echo $result ;  
                            }else{

                                echo "Project";
                            }
                        ?>
                        

                        </span></a>
                    </div><!-- Logo Box -->
                    <div class="search-button">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                    </div>
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-left">
                                <li>        
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                                </li>
                                <li>
                                    <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-diamond"></i></a>
                                </li>
                                <li>        
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                                        <li class="li-group">
                                            <ul class="list-unstyled">
                                                <li class="no-link" role="presentation">
                                                    Fixed Header 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right fixed-header-check" checked>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li-group">
                                            <ul class="list-unstyled">
                                                <li class="no-link" role="presentation">
                                                    Fixed Sidebar 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right fixed-sidebar-check">
                                                    </div>
                                                </li>
                                                <li class="no-link" role="presentation">
                                                    Horizontal bar 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right horizontal-bar-check">
                                                    </div>
                                                </li>
                                                <li class="no-link" role="presentation">
                                                    Toggle Sidebar 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right toggle-sidebar-check">
                                                    </div>
                                                </li>
                                                <li class="no-link" role="presentation">
                                                    Compact Menu 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right compact-menu-check">
                                                    </div>
                                                </li>
                                                <li class="no-link" role="presentation">
                                                    Hover Menu 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right hover-menu-check">
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li-group">
                                            <ul class="list-unstyled">
                                                <li class="no-link" role="presentation">
                                                    Boxed Layout 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right boxed-layout-check">
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li-group">
                                            <ul class="list-unstyled">
                                                <li class="no-link" role="presentation">
                                                    Choose Theme Color
                                                    <div class="color-switcher">
                                                        <a class="colorbox color-blue" href="?theme=blue" title="Blue Theme" data-css="blue"></a>
                                                        <a class="colorbox color-green" href="?theme=green" title="Green Theme" data-css="green"></a>
                                                        <a class="colorbox color-red" href="?theme=red" title="Red Theme" data-css="red"></a>
                                                        <a class="colorbox color-white" href="?theme=white" title="White Theme" data-css="white"></a>
                                                        <a class="colorbox color-purple" href="?theme=purple" title="purple Theme" data-css="purple"></a>
                                                        <a class="colorbox color-dark" href="?theme=dark" title="Dark Theme" data-css="dark"></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="no-link"><button class="btn btn-default reset-options">Reset Options</button></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                               
                                <li>
                                    <a href="logout.php" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                    </a>
                                </li>
                                <li style="display:none">
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic" id="showRight">
                                        <i class="fa fa-comments"></i>
                                    </a>
                                </li>
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->
            <div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <div class="sidebar-header">
                        <div class="sidebar-profile">
                            <a href="javascript:void(0);" id="profile-menu-link">
                            <?php

                                @$userinfo  = GetUserInfo($con);
                                @$uservalue =  $userinfo[0];
                               
                                @$confObj = CheckconfigInfo($con);
                                //prepare the variables for youtube and viedo and images 
                                if(count($confObj) > 0){
                                    if(@$confObj['uploaddirectory'] != ''){
                                        @$uploads  = $confObj['uploaddirectory'];
                                    }else{
                                       @ $uploads  = 'uploads/'; 
                                    }
                                }else{
                                    @$uploads  = 'uploads/';

                                }
                                
                                if (preg_match('/___/',$uservalue)) {
                                    @$username  = substr($uservalue, 0, strpos($uservalue, '___'));
                                    @$userimage  = substr($uservalue, strpos($uservalue, '_') + 3);
                                    @$userimage  = substr($userimage, 0, strpos($userimage, '___'));
                                    @$userimagefieldtype = end(explode( "___", $uservalue));

                                    if($userimagefieldtype == 'blob'){    
                                        echo "<div class='sidebar-profile-image'>
                                            <img src='data:image/jpeg;base64,".base64_encode(@$userimage)."' class='img-circle img-responsive' alt=''>
                                        </div>
                                        <div class='sidebar-profile-details'>
                                            <span><small>$username</small></span>
                                        </div>";

                                    }else{
                                        echo "<div class='sidebar-profile-image'>
                                            <img src='authentication/".@$uploads.@$userimage."' class='img-circle img-responsive' alt=''>
                                        </div>
                                        <div class='sidebar-profile-details'>
                                            <span><small>$username</small></span>
                                        </div>";
                                    }
                                    
                                }else{
                                    echo "<div class='sidebar-profile-image'>
                                        <img src='../assets/images/avater.png' class='img-circle img-responsive' alt=''>
                                    </div>
                                    <div class='sidebar-profile-details'>
                                        <span>$uservalue<br><small>administrator</small></span>
                                    </div>";
                                }

                                

                                ?>
                            </a>
                        </div>
                    </div>
                    <ul class="menu accordion-menu">
                        <li class="active"><a href="index.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

                       <?php

                             DisplyTables($con);
                      ?>
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div><!-- Page Sidebar -->
            <div class="page-inner">
            <?php
                 if(isset($_GET['tablename'])){

                        //get the table name 
                        $table     = $_GET['tablename'];
                echo "<div class='page-title'>

                    <h3>".ucfirst(str_replace('_', ' ', $table))."</h3>
                    <div class='page-breadcrumb'>
                        <ol class='breadcrumb'>
                            <li><a href='index.html'>Home</a></li>
                            <li class='active'>".ucfirst(str_replace('_', ' ', $table))."</li>
                        </ol>
                    </div>";

                }else{
                     echo "<div class='page-title'>

                    <h3>Dashboard</h3>
                    <div class='page-breadcrumb'>
                        <ol class='breadcrumb'>
                            <li><a href='index.html'>Home</a></li>
                            <li class='active'>Dashboard</li>
                        </ol>
                    </div>";

                }

                    ?>
                </div>

                <div id="toast-container" class="toast-top-full-width DeleteMSG" aria-live="polite" role="alert" style="display:none"><div class="toast toast-info"><div class="toast-message">Sucssesfully Record  Deleted!</div></div></div>
                <div id="toast-container" class="toast-top-full-width UpdateMSG" aria-live="polite" role="alert" style="display:none"><div class="toast toast-info"><div class="toast-message">Sucssesfully Records Updated!</div></div></div>
                <div id="toast-container" class="toast-top-full-width SubmitMSG" aria-live="polite" role="alert" style="display:none"><div class="toast toast-info"><div class="toast-message">Sucssesfully Records Submited!</div></div></div>

                <div id="main-wrapper">
                
                <?php
                    if(isset($_GET['tablename'])){

                        //get the table name 
                        $table     = $_GET['tablename'];
                        $tableinfo = GetCoulmsInfo($con,$table);
                        //var_dump($tableinfo['columnnumber']);

                       

                        echo "<div class='col-md-12'>
                            <div class='panel panel-white'>
                                <div class='panel-heading clearfix'>
                                    <h4 class='panel-title'><a onclick=\"window.open('authentication/addnewrecord.php?tablename=$table&newrecord','Update Records','scrollbars=1,resizable=1,width=600,height=640')\" style=\"cursor: pointer;\">Add New Record</a></h4>
                                </div>
                                <div class='panel-body'>
                                    <div class='table-responsive'>
                                        <table class='table table-bordered'>
                                            <thead>
                                                <tr>
                                                    <th> Display </th>";
                                                  GetCloumName($con,$table);
                                                echo "<th>Edit</th>
                                                <th>Delete</th></tr>
                                            </thead>
                                            <tbody>";
                                                  

                                                   GetcolumnValue($con,$table,@$Forgien_Key_Display_Field);
                                                    
                                                echo "
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>";


                    }else{

                        //check statistics table 
                        @$statistics  = mysqli_query($con,"SELECT * FROM statistics_settings_genericadmin");
                        @$statisticstable = mysqli_num_rows(mysqli_query($con,"SELECT * FROM statistics_settings_genericadmin"));
                        if(@$statisticstable != 0){
                                        echo "<div class='row'>";
                                            while ($statrow = mysqli_fetch_array($statistics)) {
                                                $statmethod = $statrow['methodname'];
                                                $tablename  = $statrow['tablename'];
                                                $fieldname  = $statrow['fieldname'];
                                                if($statmethod == 'count'){
                                                    //get count for the field from the table 
                                                    $statfortablesum = mysqli_query($con,"SELECT count($fieldname) FROM $tablename ");
                                                    $count = mysqli_result($statfortablesum,0);
                                                    $percent_friendly = $count;
                                                    echo "<div class='col-lg-3 col-md-6'>
                                                        <div class='panel info-box panel-white'>
                                                            <div class='panel-body'>
                                                                <div class='info-box-stats'>
                                                                    <p class='counter'>$percent_friendly</p>
                                                                    <span class='info-box-title'>Number of $tablename</span>
                                                                </div>
                                                                <div class='info-box-icon'>
                                                                    <i class='icon-users'></i>
                                                                </div>
                                                                <div class='info-box-progress'>
                                                                    <div class='progress progress-xs progress-squared bs-n'>
                                                                        <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width: 40%'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";

                                                }else{

                                                    //get the sum of the specific field 
                                                    $statfortableamount = mysqli_query($con,"SELECT * FROM $tablename ");
                                                    $mount = 0;
                                                    while ($rowmount = mysqli_fetch_array($statfortableamount)) {
                                                        $mount = $mount + $rowmount[$fieldname];
                                                    }

                                                     
                                                    echo "<div class='col-lg-3 col-md-6'>
                                                        <div class='panel info-box panel-white'>
                                                            <div class='panel-body'>
                                                                <div class='info-box-stats'>
                                                                    <p class='counter'>$mount </p>
                                                                    <span class='info-box-title'>$statrow[tablename]</span>
                                                                </div>
                                                                <div class='info-box-icon'>
                                                                    <i class='icon-users'></i>
                                                                </div>
                                                                <div class='info-box-progress'>
                                                                    <div class='progress progress-xs progress-squared bs-n'>
                                                                        <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width: 40%'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";

                                                }
                                                
                                            }
                               echo "</div><!-- Row -->
                                        <div class='row'>                    
                                    </div>";
                        }else{

                            if(isset($_COOKIE['AboutVisit']))  {  $last = $_COOKIE['AboutVisit']; }
                              $year = 31536000 + time() ;  //this adds one year to the current time, for the cookie expiration  
                            setcookie('AboutVisit', time (), $year) ; 
                             if (isset ($last))  {  
                                    $change = time () - (int)$last;  
                                    if ( $change > 86400)  { 
                                        echo "Welcome back! <br> You last visited on ". date("F jS - g:i a") ;  // Tells the user when they last visited if it was over a day ago
                                    }  else  {  
                                        echo "Thanks for using our site!";  
                                     //Gives the user a message if they are visiting again in the same day  
                                    }  
                               } else  {  
                                    echo "Welcome to our site!";  //Greets a first time user
                                 } 
                            echo "<div class='col-lg-3 col-md-6'>
                                    <div id='toast-container' class='toast-top-full-width Statistic' aria-live='polite' role='alert' >
                                        <div class='toast toast-info'>
                                            <div class='toast-message'>You Didn't Configure Statistics Settings</div>
                                        </div>
                                    </div>
                                 </div>";

                        }//end of statistics table is not empty  
                        

                    }//end of exsist of query string tablenam



                ?>
             
                </div><!-- Main Wrapper -->
                <div class="page-footer">
                    <p class="no-s">2015 &copy; Modern by Steelcoders.</p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        <nav class="cd-nav-container" id="cd-nav">
            <header>
                <h3>Navigation</h3>
                <a href="#0" class="cd-close-nav">Close</a>
            </header>
            <ul class="cd-nav list-unstyled">
                <li class="cd-selected" data-menu="index">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-home"></i>
                        </span>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li data-menu="profile">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <p>Profile</p>
                    </a>
                </li>
                <li data-menu="inbox">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                        <p>Mailbox</p>
                    </a>
                </li>
                <li data-menu="#">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-tasks"></i>
                        </span>
                        <p>Tasks</p>
                    </a>
                </li>
                <li data-menu="#">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-cog"></i>
                        </span>
                        <p>Settings</p>
                    </a>
                </li>
                <li data-menu="calendar">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                        <p>Calendar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="cd-overlay"></div>
    

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
        <script src="../assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="../assets/plugins/waves/waves.min.js"></script>
        <script src="../assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/toastr/toastr.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="../assets/js/modern.min.js"></script>
        <!--<script src="../assets/js/pages/dashboard.js"></script>-->

        <script type="text/javascript">
            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                    results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }


            $(document).ready(function(){

                if(window.location.href.indexOf("Done") > -1 || window.location.href.indexOf("Updated") > -1 || window.location.href.indexOf("Submited") > -1 ){
                     setInterval(function () {
                        $('.DeleteMSG,.UpdateMSG,.SubmitMSG').remove();
                        var uri = window.location.toString();
                        if (uri.indexOf("&") > 0) {
                            var clean_uri = uri.substring(0, uri.indexOf("&"));
                            window.history.replaceState({}, document.title, clean_uri);
                        }
                    }, 4000);

                }else if(window.location.href.indexOf("error") > -1){
                    var Error = getParameterByName('error');
                        if(Error.indexOf('Cannot delete or update a parent row: a foreign key constraint fails') > -1){
                            Error ='';
                            Error = 'This Field Is Already Used in Other Table !!'
                        }
                       $('.toast-message,.UpdateMSG,.SubmitMSG').text('');
                       $('.DeleteMSG .toast-message').append(Error);
                    setInterval(function () {
                        $('.DeleteMSG,.UpdateMSG,.SubmitMSG').remove();
                        var uri = window.location.toString();
                        if (uri.indexOf("&") > 0) {
                            var clean_uri = uri.substring(0, uri.indexOf("&"));
                            window.history.replaceState({}, document.title, clean_uri);
                        }
                    }, 3000);
                    

                }
               

                $('[data-form="true"]').submit(function() {
                    var c = confirm("Are You sure , Want To Delete This Record?");
                    return c; //you can just return c because it will be true or false
                });

                $('input[type="radio"]').on('click',function(){
                        //display blocks for realted info 
                        $('a#displayrelatedrecords').each(function(){
                            $(this).css('display','inline-block');
                        });
                        var Checked = $(this).val();
                        $('.table-responsive').find('a').each(function(){
                             var RelatedInfo = $(this).attr('onclick');
                             var RelatdID   = $(this).attr('id');
                             if(RelatdID  == 'displayrelatedrecords'){
                                 var firstPos = RelatedInfo.indexOf("&relatedid=");
                                 var lastPos = RelatedInfo.indexOf("&true");
                                 var y = RelatedInfo.substring(0,firstPos) + "&relatedid="+Checked + RelatedInfo.substring(lastPos);
                               // RelatedInfo = RelatedInfo.replace('relatedidvalue',Checked);
                                 $(this).attr('onclick',y);  
                             }  
                        })
                });


                //remove the radio button if has no fk 

                var $displayblock = $('a#displayrelatedrecords');
                if($displayblock.length > 0){
                    $('input[type="radio"]').each(function(){
                        $(this).closest('div').attr('style','display:block!important');
                        $(this).attr('style','margin-top: -2px;opacity: 1;margin-left: 0px;position: inherit;display:block!important');    
                    });

                     $('span#hash').each(function(){
                            $(this).attr('style','display:none!important'); 
                         });

                };

               
             
                


            });

        </script>

    </body>
</html>

<?php
}

?>