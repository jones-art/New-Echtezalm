<?php
session_start(); 
ob_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!='Admin') {
  header('location:../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- white-version/index.html  Wed, 31 Oct 2018 03:20:42 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Welcome to ::| echtezalm</title>

  <!--favicon-->
  <!-- <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon"> -->
<!-- Calender Css -->
  <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet'/>
  <!-- tables css -->
  <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  <!-- Poppins font style -->
  <link href="assets/css/poppins.css" rel="stylesheet"/>
  <!-- Single Select -->
   <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />

   <!--Switchery-->
  <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />

  <link href="assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/dist/summernote-bs4.css"/>
   <!-- Dropzone css -->
  <link href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css">
    <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  
</head>

<body style="background: #2B2B2B;">

<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" style="background: #3A3A3A; color: white;">
     <div class="brand-logo" style="height: 124px; display: table;">
      <a href="../index.php" style="display: table-cell;vertical-align: middle;padding-left:15px;">
       <img src="images/logo-white.png"  alt="logo icon">
       <h5 class="logo-text"></h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
    <?php 
      if (!is_file('no_delete.php')) {
        echo "A file is Missing";
      }else{
        include'../includes/connection.php';
        $id = $_SESSION['id'];
        $getMenu = $connect2db->prepare("SELECT menu.menu_name,menu.link,menu.icon_name,menu.id,user_role_management.menu_id,user_role_management.user_id, menu.level FROM menu JOIN user_role_management ON menu.id =user_role_management.menu_id WHERE menu.level = 1 AND user_role_management.user_id = $id ");
        $getMenu->execute();
        while ($menu = $getMenu->fetch()) {?>
          <li>
        <a href="<?php echo $menu->link?>" class="waves-effect" style="color:#fff">
          <i class="<?php echo($menu->icon_name)?>"></i> <span><?php echo $menu->menu_name?></span>
          <small class="badge float-right badge-info">New</small>
        </a>
      </li>
        <?php }
      }
    ?>
      <!-- <li style="background:#2B2B2B;">
        <a href="dashboard.php" class="waves-effect" style="color:#DAC08E">
          <i class="icon-home active"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
        </a>

        
      </li>
      
      <li>
        <a href="order.php" class="waves-effect" style="color:#fff">
          <i class="icon-calendar"></i> <span>Orders</span>
          <small class="badge float-right badge-info">New</small>
        </a>
      </li>
    
     <li>
        <a href="subscriber.php" class="waves-effect" style="color:#fff">
          <i class="icon-event"></i> <span>Subscribers</span>
          <small class="badge float-right badge-danger">10</small>
        </a>
      </li>
         
     <li>
        <a href="customer.php" class="waves-effect" style="color:#fff">
          <i class="icon-event"></i> <span>Customers</span>
          <small class="badge float-right badge-danger">10</small>
        </a>
      </li>
    
       <li>
        <a href="invoice.php" class="waves-effect" style="color:#fff">
          <i class="icon-event"></i> <span>Invoices</span>
           <small class="badge float-right badge-danger">10</small> 
        </a>
      </li>
     
     <li>
        <a href="widgets.html" class="waves-effect" style="color:#fff">
          <i class="icon-event"></i> <span>Quotes</span>
          <!-- <small class="badge float-right badge-danger">10</small> 
        </a>
     </li>

     <li>
        <a href="widgets.html" class="waves-effect" style="color:#fff">
          <i class="icon-event"></i> <span>Live Chat</span>
          <small class="badge float-right badge-danger">10</small>
        </a>
      </li>

     <li>
        <a href="widgets.html" class="waves-effect" style="color:#fff">
          <i class="icon-event"></i> <span>Customers Feedback</span>
          <!-- <small class="badge float-right badge-danger">10</small> 
        </a>
      </li>
 -->
      <div class="divider"></div>
      <hr class="mt-3">
      <li><h6 class="ml-3 text-light mb-4 mt-4">CMS</h6></li>
    <?php 
      if (!is_file('no_delete.php')) {
        echo "A file is Missing";
      }else{
        include'../includes/connection.php';
        $id = $_SESSION['id'];
        $getMenu = $connect2db->prepare("SELECT menu.menu_name,menu.link,menu.icon_name,menu.id,user_role_management.menu_id,user_role_management.user_id, menu.level FROM menu JOIN user_role_management ON menu.id =user_role_management.menu_id WHERE menu.level = 2 AND user_role_management.user_id = $id ");
        $getMenu->execute();
        while ($menu = $getMenu->fetch()) {?>
          <li>
        <a href="<?php echo $menu->link?>" class="waves-effect" style="color:#fff">
          <i class="<?php echo($menu->icon_name)?>"></i> <span><?php echo $menu->menu_name?></span>
          <small class="badge float-right badge-info">New</small>
        </a>
      </li>
        <?php }
      }
    ?>

  

      <div class="divider"></div>
      <hr class="mt-3">
      <li><h6 class="ml-3 text-light mb-4 mt-4">HR Management</h6></li>
    <?php 
      if (!is_file('no_delete.php')) {
        echo "A file is Missing";
      }else{
        include'../includes/connection.php';
        $id = $_SESSION['id'];
        $getMenu = $connect2db->prepare("SELECT menu.menu_name,menu.link,menu.icon_name,menu.id,user_role_management.menu_id,user_role_management.user_id, menu.level FROM menu JOIN user_role_management ON menu.id =user_role_management.menu_id WHERE menu.level = 3 AND user_role_management.user_id = $id ");
        $getMenu->execute();
        while ($menu = $getMenu->fetch()) {?>
          <li>
        <a href="<?php echo $menu->link?>" class="waves-effect" style="color:#fff">
          <i class="<?php echo($menu->icon_name)?>"></i> <span><?php echo $menu->menu_name?></span>
          <small class="badge float-right badge-info">New</small>
        </a>
      </li>
        <?php }
      }
    ?>

      <hr class="mt-3">

      <li><h6 class="ml-3 text-light mb-4 mt-4">Administration</h6></li>
    <?php 
      if (!is_file('no_delete.php')) {
        echo "A file is Missing";
      }else{
        include'../includes/connection.php';
        $id = $_SESSION['id'];
        $getMenu = $connect2db->prepare("SELECT menu.menu_name,menu.link,menu.icon_name,menu.id,user_role_management.menu_id,user_role_management.user_id, menu.level FROM menu JOIN user_role_management ON menu.id =user_role_management.menu_id WHERE menu.level = 4 AND user_role_management.user_id = $id ");
        $getMenu->execute();
        while ($menu = $getMenu->fetch()) {?>
          <li>
        <a href="<?php echo $menu->link?>" class="waves-effect" style="color:#fff">
          <i class="<?php echo($menu->icon_name)?>"></i> <span><?php echo $menu->menu_name?></span>
          <small class="badge float-right badge-info">New</small>
        </a>
      </li>
        <?php }
      }
    ?>

      <br><br>
      
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav" >
 <nav class="navbar navbar-expand fixed-top" style="height: 124px; background: #3A3A3A;">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
<!--     <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="icon-envelope-open"></i><span class="badge badge-danger badge-up">24</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
         <li class="list-group-item d-flex justify-content-between align-items-center">
          You have 24 new messages
          <span class="badge badge-danger">24</span>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-1.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Jhon Deo</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Today, 4:10 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-2.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Sara Jen</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Yesterday, 8:30 AM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-3.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Dannish Josh</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
             <small>5/11/2018, 2:50 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-4.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Katrina Mccoy</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet.</p>
            <small>1/11/2018, 2:50 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item"><a href="javaScript:void();">See All Messages</a></li>
        </ul>
        </div>
    </li> -->
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
    <i class="icon-bell text-white"></i><span class="badge badge-up" style="background:#DAC08E; color: #fff;">10</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
          You have 10 Notifications
          <span class="badge badge-primary">10</span>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="icon-people fa-2x mr-3 text-info"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">New Registered Users</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="icon-cup fa-2x mr-3 text-warning"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">New Received Orders</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="icon-bell fa-2x mr-3 text-danger"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">New Updates</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item"><a href="javaScript:void();">See All Notifications</a></li>
        </ul>
      </div>
    </li>
<!--     <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="#"><i class="flag-icon flag-icon-gb"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li> -->
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <div style="border-left: 1px solid rgba(255, 255, 255, 0.2);padding:5px;text-transform: capitalize; text-align: right;">
          <span class="user-profile">
            <!-- <img src="assets/images/avatars/avatar-17.png" class="img-circle" alt="user avatar"> -->
            <h6 class="text-muted">Welcome:</h6>
            <h5 class="text-white"><?php echo $_SESSION['fullname'];?></h5>
          </span>
        </div>
        
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar">
              <img class="align-self-start mr-3" src="assets/images/avatars/avatar-17.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $_SESSION['fullname'];?></h6>
            <p class="user-subtitle"><?php echo $_SESSION['email'];?></p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="logout.php"><i class="icon-power mr-2"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>