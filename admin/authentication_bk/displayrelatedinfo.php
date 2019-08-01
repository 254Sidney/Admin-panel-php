<?php


include 'FK_Config.php';
include 'function.php';
include 'connection.php';


?>
<!DOCTYPE html>
<html>
    <head>
        
              <title>Dynamic | Admin Dashboard </title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard,generic,dynamic admin,php admin,website content mangment,CRM, PHP CRM , generic mangment , free admin, free website admin, free website php admin, free generic admin " />
        <meta name="author" content="ali alroomi" />
        
        <!-- Styles -->
        <link href='fonts/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
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
        <link href="../../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>   
        <link href="../../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>  
        <link href="../../assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>    
            
        <!-- Theme Styles -->
        <link href="../../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        
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

            .page-header-fixed:not(.page-sidebar-fixed):not(.page-horizontal-bar) .page-inner {
                padding: 0px 0 0px;
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
        //recursive_remove_directory('admin/install/');

    ?>
        <div class="overlay"></div>
   
        
        <main class="page-content content-wrap" >
            
           
            <div class="page-inner" style="padding:0px;">
            <?php
                 if(isset($_GET['tablename'])){

                        //get the table name 
                        $table     = $_GET['relatedinfo'];
                echo "<div class='page-title'>

                    <h3>".strtoupper($table)."</h3>
                    <div class='page-breadcrumb'>
                        <ol class='breadcrumb'>
                            <li><a href='index.html'>Home</a></li>
                            <li class='active'>".ucfirst($table)."</li>
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
                        $table     = mysqli_real_escape_string($con,$_GET['relatedinfo']);
                        $tableinfo = GetCoulmsInfo($con,$table);
                        $primry    = mysqli_real_escape_string($con,$_GET['relatedid']);
                        $primaryname = mysqli_real_escape_string($con,$_GET['fkfieldname']);

                        //var_dump($tableinfo['columnnumber']);

                       

                        echo "<div class='col-md-12'>
                            <div class='panel panel-white'>
                                <div class='panel-heading clearfix'>
                                    <h4 class='panel-title'><a onclick=\"window.open('ineraddnewrecord.php?tablename=$table&relatedinfo=$table&relatedid=$primry&fkfieldname=$primaryname&newrecord','Update Records','scrollbars=1,resizable=1,width=600,height=640')\" style=\"cursor: pointer;\">Add New Record</a></h4>
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
                                                  

                                                   GetcolumnValue($con,$table,@$Forgien_Key_Display_Field,$primaryname,$primry);
                                                    
                                                echo "
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>";


                    }else{

                        echo "      <div class='row'>
                        <div class='col-lg-3 col-md-6'>
                            <div class='panel info-box panel-white'>
                                <div class='panel-body'>
                                    <div class='info-box-stats'>
                                        <p class='counter'>107,200</p>
                                        <span class='info-box-title'>User activity this month</span>
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
                        </div>
                        <div class='col-lg-3 col-md-6'>
                            <div class='panel info-box panel-white'>
                                <div class='panel-body'>
                                    <div class='info-box-stats'>
                                        <p class='counter'>340,230</p>
                                        <span class='info-box-title'>Page views</span>
                                    </div>
                                    <div class='info-box-icon'>
                                        <i class='icon-eye'></i>
                                    </div>
                                    <div class='info-box-progress'>
                                        <div class='progress progress-xs progress-squared bs-n'>
                                            <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 80%'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-md-6'>
                            <div class='panel info-box panel-white'>
                                <div class='panel-body'>
                                    <div class='info-box-stats'>
                                        <p>$<span class='counter'>653,000</span></p>
                                        <span class='info-box-title'>Monthly revenue goal</span>
                                    </div>
                                    <div class='info-box-icon'>
                                        <i class='icon-basket'></i>
                                    </div>
                                    <div class='info-box-progress'>
                                        <div class='progress progress-xs progress-squared bs-n'>
                                            <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 60%'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-md-6'>
                            <div class='panel info-box panel-white'>
                                <div class='panel-body'>
                                    <div class='info-box-stats'>
                                        <p class='counter'>47,500</p>
                                        <span class='info-box-title'>New emails recieved</span>
                                    </div>
                                    <div class='info-box-icon'>
                                        <i class='icon-envelope'></i>
                                    </div>
                                    <div class='info-box-progress'>
                                        <div class='progress progress-xs progress-squared bs-n'>
                                            <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100' style='width: 50%'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                    <div class='row'>
                        <div class='col-lg-9 col-md-12'>
                            <div class='panel panel-white'>
                                <div class='row'>
                                    <div class='col-sm-8'>
                                        <div class='visitors-chart'>
                                            <div class='panel-heading'>
                                                <h4 class='panel-title'>Visitors</h4>
                                            </div>
                                            <div class='panel-body'>
                                                <div id='flotchart1'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-4'>
                                        <div class='stats-info'>
                                            <div class='panel-heading'>
                                                <h4 class='panel-title'>Browser Stats</h4>
                                            </div>
                                            <div class='panel-body'>
                                                <ul class='list-unstyled'>
                                                    <li>Google Chrome<div class='text-success pull-right'>32%<i class='fa fa-level-up'></i></div></li>
                                                    <li>Firefox<div class='text-success pull-right'>25%<i class='fa fa-level-up'></i></div></li>
                                                    <li>Internet Explorer<div class='text-success pull-right'>16%<i class='fa fa-level-up'></i></div></li>
                                                    <li>Safari<div class='text-danger pull-right'>13%<i class='fa fa-level-down'></i></div></li>
                                                    <li>Opera<div class='text-danger pull-right'>7%<i class='fa fa-level-down'></i></div></li>
                                                    <li>Mobile &amp; tablet<div class='text-success pull-right'>4%<i class='fa fa-level-up'></i></div></li>
                                                    <li>Others<div class='text-success pull-right'>3%<i class='fa fa-level-up'></i></div></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-md-6'>
                            <div class='panel panel-white' style='height: 100%;'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'>Server Load</h4>
                                    <div class='panel-control'>
                                        <a href='javascript:void(0);' data-toggle='tooltip' data-placement='top' title='Expand/Collapse' class='panel-collapse'><i class='icon-arrow-down'></i></a>
                                        <a href='javascript:void(0);' data-toggle='tooltip' data-placement='top' title='Reload' class='panel-reload'><i class='icon-reload'></i></a>
                                    </div>
                                </div>
                                <div class='panel-body'>
                                    <div class='server-load'>
                                        <div class='server-stat'>
                                            <span>Total Usage</span>
                                            <p>67GB</p>
                                        </div>
                                        <div class='server-stat'>
                                            <span>Total Space</span>
                                            <p>320GB</p>
                                        </div>
                                        <div class='server-stat'>
                                            <span>CPU</span>
                                            <p>57%</p>
                                        </div>
                                    </div>
                                    <div id='flotchart2'></div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-5 col-md-6'>
                            <div class='panel panel-white'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'>Weather</h4>
                                    <div class='panel-control'>
                                        <a href='javascript:void(0);' data-toggle='tooltip' data-placement='top' title='Reload' class='panel-reload'><i class='icon-reload'></i></a>
                                    </div>
                                </div>
                                <div class='panel-body'>
                                    <div class='weather-widget'>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <div class='weather-top'>
                                                    <div class='weather-current pull-left'>
                                                        <i class='wi wi-day-cloudy weather-icon'></i>
                                                        <p><span>83<sup>&deg;F</sup></span></p>
                                                    </div>
                                                    <h2 class='weather-day pull-right'>Miami, FL<br><small><b>13th April, 2015</b></small></h2>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <ul class='list-unstyled weather-info'>
                                                    <li>Wind <span class='pull-right'><b>ESE 16 mph</b></span></li>
                                                    <li>Humidity <span class='pull-right'><b>64%</b></span></li>
                                                    <li>Pressure <span class='pull-right'><b>30.15 in</b></span></li>
                                                    <li>UV Index <span class='pull-right'><b>6</b></span></li>
                                                </ul>
                                            </div>
                                            <div class='col-md-6'>
                                                <ul class='list-unstyled weather-info'>
                                                    <li>Cloud Cover <span class='pull-right'><b>60%</b></span></li>
                                                    <li>Ceiling <span class='pull-right'><b>17800 ft</b></span></li>
                                                    <li>Dew Point <span class='pull-right'><b>70° F</b></span></li>
                                                    <li>Visibility <span class='pull-right'><b>10 mi</b></span></li>
                                                </ul>
                                            </div>
                                            <div class='col-md-12'>
                                                <ul class='list-unstyled weather-days row'>
                                                    <li class='col-xs-4 col-sm-2'><span>12:00</span><i class='wi wi-day-cloudy'></i><span>82<sup>&deg;F</sup></span></li>
                                                    <li class='col-xs-4 col-sm-2'><span>13:00</span><i class='wi wi-day-cloudy'></i><span>82<sup>&deg;F</sup></span></li>
                                                    <li class='col-xs-4 col-sm-2'><span>14:00</span><i class='wi wi-day-cloudy'></i><span>82<sup>&deg;F</sup></span></li>
                                                    <li class='col-xs-4 col-sm-2'><span>15:00</span><i class='wi wi-day-cloudy'></i><span>83<sup>&deg;F</sup></span></li>
                                                    <li class='col-xs-4 col-sm-2'><span>16:00</span><i class='wi wi-day-cloudy'></i><span>82<sup>&deg;F</sup></span></li>
                                                    <li class='col-xs-4 col-sm-2'><span>17:00</span><i class='wi wi-day-sunny-overcast'></i><span>82<sup>&deg;F</sup></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-6'>
                            <div class='panel panel-white'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'>Inbox</h4>
                                    <div class='panel-control'>
                                        <a href='javascript:void(0);' data-toggle='tooltip' data-placement='top' title='Reload' class='panel-reload'><i class='icon-reload'></i></a>
                                    </div>
                                </div>
                                <div class='panel-body'>
                                    <div class='inbox-widget slimscroll'>
                                        <a href='#'>
                                            <div class='inbox-item'>
                                                <div class='inbox-item-img'><img src='assets/images/avatar2.png' class='img-circle' alt=''></div>
                                                <p class='inbox-item-author'>Sandra Smith</p>
                                                <p class='inbox-item-text'>Hey! I'm working on your...</p>
                                                <p class='inbox-item-date'>13:40 PM</p>
                                            </div>
                                        </a>
                                        <a href='#'>
                                            <div class='inbox-item'>
                                                <div class='inbox-item-img'><img src='assets/images/avatar3.png' class='img-circle' alt=''></div>
                                                <p class='inbox-item-author'>Christopher</p>
                                                <p class='inbox-item-text'>I've finished it! See you so...</p>
                                                <p class='inbox-item-date'>13:34 PM</p>
                                            </div>
                                        </a>
                                        <a href='#'>
                                            <div class='inbox-item'>
                                                <div class='inbox-item-img'><img src='assets/images/avatar4.png' class='img-circle' alt=''></div>
                                                <p class='inbox-item-author'>Amily Lee</p>
                                                <p class='inbox-item-text'>This theme is awesome!</p>
                                                <p class='inbox-item-date'>13:17 PM</p>
                                            </div>
                                        </a>
                                        <a href='#'>
                                            <div class='inbox-item'>
                                                <div class='inbox-item-img'><img src='assets/images/avatar5.png' class='img-circle' alt=''></div>
                                                <p class='inbox-item-author'>Nick Doe</p>
                                                <p class='inbox-item-text'>Nice to meet you</p>
                                                <p class='inbox-item-date'>12:20 PM</p>
                                            </div>
                                        </a>
                                        <a href='#'>
                                            <div class='inbox-item'>
                                                <div class='inbox-item-img'><img src='assets/images/avatar2.png' class='img-circle' alt=''></div>
                                                <p class='inbox-item-author'>Sandra Smith</p>
                                                <p class='inbox-item-text'>Hey! I'm working on your...</p>
                                                <p class='inbox-item-date'>10:15 AM</p>
                                            </div>
                                        </a>
                                        <a href='#'>
                                            <div class='inbox-item'>
                                                <div class='inbox-item-img'><img src='assets/images/avatar4.png' class='img-circle' alt=''></div>
                                                <p class='inbox-item-author'>Amily Lee</p>
                                                <p class='inbox-item-text'>This theme is awesome!</p>
                                                <p class='inbox-item-date'>9:56 AM</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-md-6'>
                            <div class='panel twitter-box'>
                                <div class='panel-body'>
                                    <div class='live-tile' data-mode='flip' data-speed='750' data-delay='3000'>
                                        <span class='tile-title pull-right'>New Tweets</span>
                                        <i class='fa fa-twitter'></i>
                                        <div><h2 class='no-m'>It’s kind of fun to do the impossible...</h2><span class='tile-date'>10 April, 2015</span></div>
                                        <div><h2 class='no-m'>Sometimes by losing a battle you find a new way to win the war...</h2><span class='tile-date'>6 April, 2015</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class='panel facebook-box'>
                                <div class='panel-body'>
                                    <div class='live-tile' data-mode='carousel' data-direction='horizontal' data-speed='750' data-delay='4500'>
                                        <span class='tile-title pull-right'>Facebook Feed</span>
                                        <i class='fa fa-facebook'></i>
                                        <div><h2 class='no-m'>If you're going through hell, keep going...</h2><span class='tile-date'>23 March, 2015</span></div>
                                        <div><h2 class='no-m'>To improve is to change; to be perfect is to change often...</h2><span class='tile-date'>15 March, 2015</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-12 col-md-12'>
                            <div class='panel panel-white'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'>Project Stats</h4>
                                </div>
                                <div class='panel-body'>
                                    <div class='table-responsive project-stats'>  
                                       <table class='table'>
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Project</th>
                                                   <th>Status</th>
                                                   <th>Manager</th>
                                                   <th>Progress</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <tr>
                                                   <th scope='row'>452</th>
                                                   <td>Mailbox Template</td>
                                                   <td><span class='label label-info'>Pending</span></td>
                                                   <td>David Green</td>
                                                   <td>
                                                   <div class='btn-group'>
                                            <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                                Action <span class='caret'></span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='#'>Action</a></li>
                                                <li><a href='#'>Another action</a></li>
                                                <li class='divider'></li>
                                                <li><a href='#'>Separated link</a></li>
                                            </ul>
                                        </div>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope='row'>327</th>
                                                   <td>Wordpress Theme</td>
                                                   <td><span class='label label-primary'>In Progress</span></td>
                                                   <td>Sandra Smith</td>
                                                   <td>
                                                       <div class='progress progress-sm'>
                                                           <div class='progress-bar progress-bar-primary' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 60%'>
                                                           </div>
                                                       </div>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope='row'>226</th>
                                                   <td>Modern Admin Template</td>
                                                   <td><span class='label label-success'>Finished</span></td>
                                                   <td>Chritopher Palmer</td>
                                                   <td>
                                                       <div class='progress progress-sm'>
                                                           <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                                                           </div>
                                                       </div>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope='row'>178</th>
                                                   <td>eCommerce template</td>
                                                   <td><span class='label label-danger'>Canceled</span></td>
                                                   <td>Amily Lee</td>
                                                   <td>
                                                       <div class='progress progress-sm'>
                                                           <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='20' aria-valuemin='0' aria-valuemax='100' style='width: 20%'>
                                                           </div>
                                                       </div>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope='row'>157</th>
                                                   <td>Website PSD</td>
                                                   <td><span class='label label-info'>Testing</span></td>
                                                   <td>Nick Doe</td>
                                                   <td>
                                                       <div class='progress progress-sm'>
                                                           <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100' style='width: 50%'>
                                                           </div>
                                                       </div>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope='row'>157</th>
                                                   <td>Fronted Theme</td>
                                                   <td><span class='label label-warning'>Waiting</span></td>
                                                   <td>David Green</td>
                                                   <td>
                                                       <div class='progress progress-sm'>
                                                           <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100' style='width: 70%'>
                                                           </div>
                                                       </div>
                                                   </td>
                                               </tr>
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";


                    }//end of exsist of query string tablename 



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
        <script src="../../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="../../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="../../assets/plugins/pace-master/pace.min.js"></script>
        <script src="../../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../../assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="../../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="../../assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="../../assets/plugins/waves/waves.min.js"></script>
        <script src="../../assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="../../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../../assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="../../assets/plugins/toastr/toastr.min.js"></script>
        <script src="../../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../../assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="../../assets/js/modern.min.js"></script>
        <!--<script src="assets/js/pages/dashboard.js"></script>-->

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
                            Error = 'This Field Is Already Used in Other Table !!'
                        }
                        $('.toast-message,.UpdateMSG,.SubmitMSG').text('');
                        $('.toast-message,.UpdateMSG,.SubmitMSG').append(Error);
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
                console.log($displayblock.length);
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