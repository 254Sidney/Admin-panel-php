<?php


include '../authentication/FK_Config.php';
include '../authentication/function.php';
include '../authentication/connection.php';


?>
<!DOCTYPE html>
<html>
<head>

<!-- Title -->
<title>Dynamic | Admin Dashboard Template</title>

<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="UTF-8">
<meta name="description" content="Admin Dashboard Template" />
<meta name="keywords" content="admin,dashboard" />
<meta name="author" content="Steelcoders" />

<!-- Styles -->
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
<link href="../../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>

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

<style type="text/css">
.disabled{
display: none!important;
}
</style>

</head>
<body class="page-header-fixed">

<?php
if (isset($_POST[''])) {
# code...
}


?>
<div class="overlay"></div>
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
<h3><span class="pull-left">Chat</span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
<div class="slimscroll">
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
<a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
</div>
</nav>


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
<a href="#" class="logo-text"><span style="font-size:18px;">Configuration </span></a>
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

</div><!-- Top Menu -->
</div>
</div>
</div><!-- Navbar -->
<div class="page-sidebar sidebar">
<div class="page-sidebar-inner slimscroll">
<div class="sidebar-header">
<div class="sidebar-profile">
<a href="javascript:void(0);" id="profile-menu-link">
<div class="sidebar-profile-image">
<img src="../../assets/images/avater.png" class="img-circle img-responsive" alt="">
</div>
<div class="sidebar-profile-details">
<span><small>User</small></span>
</div>
</a>
</div>
</div>

</div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->
<div class="page-inner">
<?php
if(isset($_GET['config'])){


echo "<div class='page-title'>

<h3>Configuration</h3>
<div class='page-breadcrumb'>
<ol class='breadcrumb'>
<li><a href='#'>Home</a></li>
<li class='active'>Config Your Admin Content</li>
</ol>
</div>";

}else{
echo "<div class='page-title'>

<h3>Dashboard</h3>
<div class='page-breadcrumb'>
<ol class='breadcrumb'>
<li><a href='#'>Home</a></li>
<li class='active'>Dashboard</li>
</ol>
</div>";

}

?>
</div>


<div id="main-wrapper">

<?php
if(isset($_GET['config'])){
$DB = $_SESSION['DataBase_Name'];
$AllFKInfo = GetAllForeginKey_Info($con,$DB);
$Tables = Tables($con);

echo "<div class='col-md-12'>
<div class='panel panel-white'>
<div class='panel-body'>
<div id='rootwizard'>
    <ul class='nav nav-tabs' role='tablist'>
        <li role='presentation'><a href='#tab1' data-toggle='tab'><i class='fa fa-truck m-r-xs'></i>Forgien Key Settings</a></li>
        <li role='presentation'><a href='#tab2' data-toggle='tab'><i class='fa fa-truck m-r-xs'></i>Media Settings</a></li>
        <li role='presentation'><a href='#tab3' data-toggle='tab'><i class='fa fa-truck m-r-xs'></i>Statistics Settings</a></li>
        <li role='presentation'><a href='#tab4' data-toggle='tab'><i class='fa fa-truck m-r-xs'></i>Login Settings</a></li>
        <li role='presentation'><a href='#tab5' data-toggle='tab'><i class='fa fa-truck m-r-xs'></i>Project Name Settings</a></li>
        <li role='presentation'><a href='#tab6' data-toggle='tab'><i class='fa fa-check m-r-xs'></i>Finish</a></li>
    
    </ul>


    <div class='progress progress-sm m-t-sm'>
        <div class='progress-bar progress-bar-primary' role='progressbar' aria-valuenow='20' aria-valuemin='0' aria-valuemax='100' style='width: 25%;'>
        </div>
    </div>
    <form id='wizardForm' novalidate='novalidate' action='wrtieconfigsettings.php' method='POST' >
        <div class='tab-content'>
         
            <div class='tab-pane fade' id='tab1'>
                <div class='row'><div class='col-md-8'>
                        <h3>Forgien Key Display Settings</h3>
                        <p>Forgien key relation is most important settings , by selecting the tablename, that has primary key as forgien key in other table , then select the display name you want insteade of this primary key </p>
                        <p><label style='color:red;font-weight:bold;'>Note If you didn't choice any , then the default value will display (Primary Key).</label></p>
                    </div>
                   
                    <div class='col-md-12'>";
                 foreach ($AllFKInfo as $key => $value) {
                     $All_FK_TableName = @array_pop(explode('.', $value));
                     $All_FK_PrimaryID = substr($value, 0, strrpos($value, '.'));
                     $All_FK_DisplayFields =  QueryResult($con,"SHOW COLUMNS FROM $All_FK_TableName");
                   echo "<div class='form-group col-md-4'>
                            <label for='fktablename'>Forgien Key Table</label>
                            <select class='form-control' name='fktablename_".$key."' id='fktablename'>
                            <option>Select Table</option>
                            <option value='".$All_FK_TableName."_".$key."' >$All_FK_TableName</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='fkname'>Forgien Key  </label>
                            <select class='form-control' name='fkname_$key' id='fkname'>
                            <option>Select Table</option>
                            <option value='".$All_FK_PrimaryID."_".$key."' >$All_FK_PrimaryID</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='fkallfieldsname'>Display Field  </label>
                            <select class='form-control' name='fkallfieldsname_$key' id='fkallfieldsname'>
                            <option>Select Table</option>";
                           while($row=mysqli_fetch_array($All_FK_DisplayFields)){
                                if($row[0] != $All_FK_PrimaryID ){
                                   echo "<option value='".$row[0]."_".$key."'>$row[0]</option>"; 
                                }
                                  
                            }
                    echo "</select>

                        </div>";
                        }
                        if(count($AllFKInfo) == 0){
                            echo "<h3 style='color:red;font-weight:bold;'>You Dont have any relationship between your database tables . !</h3>";

                        }
                    echo "</div>
                    
                </div>
            </div>
            <div class='tab-pane fade' id='tab2'>
                <div class='row'>
                 <div class='col-md-12'>
                      <p><label style='color:red;font-weight:bold;'>Note: If you didn't choice any , then the default value  will be handled.</label></p>

                        <h3>Images Settings</h3>
                        <p>Images has default settings .<br/>
                             1- blob datatype (varchar and text are consider as blob ,  make sure the image field is not type of text ) is handeled as images upload (image link isn't physical exsist).<br/>
                             2- fieldname_Image  is default value to  handled  images upload (physical exsist in default path (uploads/) folder ).<br/>
                             3- if you want to change the default  (uploads/) directory please define it down.<br/>
                        </p>
                    </div>
                    <div class='col-md-12'>
                        <div class='form-group col-md-12'>
                            <label for='fieldname_image'>Fieldname _Value</label>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <input type='text' class='form-control' name='fieldname_image' id='fieldname_image' placeholder='define your image field (Optional)'>
                                </div>
                            
                            </div>
                        </div> 
                        <div class='form-group col-md-12'>
                            <label for='uploaddirectory'>Upload Directory</label>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <input type='text' class='form-control' name='uploaddirectory' id='uploaddirectory' placeholder='uploads/ (Optional)'>
                                </div>
                            
                            </div>
                        </div> 
                    </div>
                </div>

                    <div class='row'>
                 <div class='col-md-12'>
                      <p><label style='color:red;font-weight:bold;'>Note: If you didn't choice any , then the default value  will be handled.</label></p>

                        <h3>Viedos Settings</h3>
                        <p>Viedos has default settings .<br/>
                             1- fieldname_Youtube or fieldname_youtube are handled as  youtube embedded (physical are not exsist on your own media server).<br/>
                             2- fieldname_Viedo or fieldname_viedo are handled as media server  , that you upload at  (default define as fieldname_Viedo or fieldname_Viedo) .<br/>
                             3- if you want to change the default  fieldname_Viedo   please define it down.<br/>
                        </p>

                         <div class='form-group col-md-12'>
                            <label for='youtubefieldname'>YouTube Field Name</label>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <input type='text' class='form-control' name='youtubefieldname' id='youtubefieldname' placeholder='define your YouTube field (Optional)'>
                                </div>
                            
                            </div>
                        </div> 
                        <div class='form-group col-md-12'>
                            <label for='viedofieldname'>Viedo Field Name</label>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <input type='text' class='form-control' name='viedofieldname' id='viedofieldname' placeholder='define your Viedo field (Optional)'>
                                </div>
                            
                            </div>
                        </div> 
                    </div>
                    <div class='col-md-12'>

                          <h3>Password Field Settings</h3>
                        <p>Password has default settings .<br/>
                             1- fieldname_Password or Password Field Name  are handled as  type Password .
                        </p>

                         <div class='form-group col-md-12'>
                            <label for='passwordfieldname'>Password Field Name</label>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <input type='text' class='form-control' name='passwordfieldname' id='passwordfieldname' placeholder='define your Password field (Optional)'>
                                </div>
                            
                            </div>
                        </div> 

                    </div>
                   
                </div>
            </div>
             <div class='tab-pane fade' id='tab3'>
                <div class='row'>
                 <div class='col-md-8' style='margin-left:10px;'>
                        <h3>Statistics Settings</h3>
                        <p> You should select the table name , method , field name that you want to have a statistics information . <br/> <label style='color:red;'> Note : You can Select more than one table </label> </p>
                    </div>
                   
                    <div class='col-md-12'>";
                    $AllTables = Tables($con);
                 foreach ($AllTables as $key => $value) {
                  
                   echo "<div class='form-group col-md-4'>
                            <label for='fktablename'>Table Name</label>
                            <select class='form-control' name='statisticstablename_".$key."' id='sttablename'>
                            <option>Select Table</option>
                            <option value='$value' >$value</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='fkname'>Statistics Method </label>
                            <select class='form-control' name='statisticsmethod_".$key."' id='stmethodname'>
                            <option>Select Method</option>
                            <option value='sum' >Sum</option>
                            <option value='count' >Count</option>
                            </select>
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='fkname'>Tables Fields </label>
                            <select class='form-control' name='statisticstablefield_".$key."' id='tablefield'>
                            <option>Select Field</option>";

                        $selecttablefield = mysqli_query($con,"SHOW COLUMNS FROM $value");
                        while ($row = mysqli_fetch_array($selecttablefield)) {
                            echo "<option value='$row[0]' >$row[0]</option>";
                            
                        }

                        echo "</select></div>";

                    }
      
                    echo "</div>
                   
                </div>
            </div>
            <div class='tab-pane fade' id='tab4'>
                
                <div class='form-group col-md-12'>
                    <div class='col-md-8' style='margin-left:10px;'>
                            <h3>Login Settings</h3>
                            <p>You Should Define The User Table Name , To Enable Login Functionality .</p>
                            <p style='color:red'>Note : If You Didn't Select The Table Name For Users , You Cant Enable Login functionality . </p>
                    </div>
                   <div class='form-group col-md-4' style='margin-left: 1%;' >
                                <label for='usertable'>Table Name </label>
                                <select class='form-control' name='usertable' id='usertable' >
                                <option>Select User Table Name</option>";
                                $AllTables = Tables($con);  
                                 foreach ($AllTables as $key => $value) {
                                    echo "<option value='$value' >$value</option>";
                                }
                                
                                echo "</select>
                    </div>
                    <div class='form-group col-md-12' id='usertablefield' >



                    </div>
                </div>
             </div>

             <div class='tab-pane fade' id='tab5'>
                <div class='col-md-8' style='margin-left:10px;'>
                    <h3>Project Name Settings</h3>
                    <p>You Should Provide Your Project Name (Default Project Name Is Project.</p>
                </div>
                  <div class='form-group col-md-12'>
                    <label for='projectname'>Project Name</label>
                    <div class='row'>
                        <div class='col-md-4'>
                            <input type='text' class='form-control' name='projectname' id='projectname' placeholder='define your Project Name (Optional)'>
                        </div>
                    
                    </div>
                </div> 
            </div>

            <div class='tab-pane fade' id='tab6'>
                <h2 class='no-s'>Thank You !</h2>
                <div class='alert alert-info m-t-sm m-b-lg' role='alert'>
                    Congratulations ! You got the last step.
                </div>
                <input type='submit' name='configsubmit' class='btn btn-default' style='float: right;margin-right: 0px;' />
            </div>


            <ul class='pager wizard'>
                <li class='previous disabled'><a href='#' class='btn btn-default'>Previous</a></li>
                <li class='next'><a href='#' class='btn btn-default'>Next</a></li>
            </ul>
        </div>
    </form>
</div>
</div>
</div>
</div>";


}


?>

</div><!-- Main Wrapper -->
<div class="page-footer">
<p class="no-s">2015 &copy; UX / Open Source Team.</p>
</div>
</div><!-- Page Inner -->
</main><!-- Page Content -->

<div class="cd-overlay"></div>


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
<script src="../../assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="../../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../../assets/js/modern.min.js"></script>
<script src="../../assets/js/pages/form-wizard.js"></script>

<script type="text/javascript">

$('[name="usertable"]').on('change',function(){
var usertable = $(this).val();
$.ajax({
type: 'POST',
url: 'usertablecolumn.php',
data: {usertable:usertable},
success: function(data) {
$('#usertablefield').html(data);
$('#usertablefield').fadeIn(); //Fade in the data given by the insert.php file
$('#usertablefield').load(data);
}
});
});

</script>



</body>
</html>