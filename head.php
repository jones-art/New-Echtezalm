<?php 
ob_start();
session_start();
if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  include 'includes/connection.php';

  $getOrderID = $connect2db->prepare("SELECT order_id FROM tbl_order WHERE user_id = ? AND payment_status = ?");
    $getOrderID->execute([$id, 'Pending']);
    $getID = $getOrderID->fetch();
    $order_id = $getID->order_id;

    $getOrder = $connect2db->prepare("SELECT count(id) AS prod_count FROM prd_order WHERE user_id = ? AND order_id = ?");
    $getOrder->execute([$id, $order_id]);
    $count = $getOrder->fetch();
    $num = $count->prod_count;
    
    } 

?>
<!DOCTYPE html>
<html>
  <head>
  <title>Welcome to ::| echtezalm</title>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"/>
    <!-- Custom CSS -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <!-- Include favicon -->
    <link rel="icon" type="images/png" href="images/favicon.png">
    <!-- viewport for responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="css/poppins.css">
    <link rel="stylesheet" type="text/css" href="css/playfair.css">

    <!-- Animation on Scroll -->
    <link href="css/aos.min.css" rel="stylesheet">
    <!-- rateyo css -->
    <link rel="stylesheet" href="css/rateyo.min.css">

</head>
<body>
<!-- Big Nav Head -->
<nav class="d-flex">
    <div class="nav-wrapper container">
      <a href="#" data-target="mobile-demo" class="sidenav-trigger" style="padding-top: 31px;"><img src="images/icon/menu.png"></a>
      <a href="#" class="brand-logo center"><img src="images/logo-white.png" class="responsive-img"></a>
      <ul id="nav-mobile" class="right">
        <li>
          <a href="cart.php">
            <img src="images/cart.png">
            <button style=" 
                  position: relative;
                  top: -15px;
                  right: 16px;
                  width: 30px;
                  height: 30px;
                  color: #fff;
                  background-color: #AD976E;
                  border-radius: 30px;
                  text-align:center;border:solid 1px #AD976E" 
                  class="center align-center" id="cart">
                    <?php if (isset($_SESSION['id'])) {
                     echo $num ; # code...
                    } ?>
                  </button>
          </a>
        </li>
        
      </ul>
    </div>
  </nav>

  <!-- Big nav Head Stop -->

  <!-- Menu Nav -->

  <nav class="hide-on-med-and-down black nav-center" role="navigation">
    <div class="nav-wrapper menu container-fluid ">
      <ul class="" id="menu">
        <li class="">
          <a class="<?php $page=='home'?print'active':print'';?>" id="home" href="index.php">Home </a>
        </li>

        <li> 
          <a href="collection.php" id="col" class="<?php $page=='collection'?print'active':print'';?>">Collection</a>
        </li>

        <li> 
          <a href="webshop.php" class="<?php $page=='webshop'?print'active':print'';?>">Web Shop</a>
        </li>

        <li>
          <a href="aboutUs.php" class="<?php $page=='about'?print'active':print'';?>">About Us</a>
        </li>

        <li><a href="blog.php" class="<?php $page=='blog'?print'active':print'';?>">Blog</a></li>
        <li><a href="contact.php" class="<?php $page=='contact'?print'active':print'';?>">Contact</a></li>
       
        <li class="dropdown">
          <a class="dropdown-trigger" href="#!" data-target="account">
           <?php if (isset($_SESSION['email'])) {
             echo($_SESSION['email']);
           } else{
            echo "My Account";
           }?>
          </a>
        </li>
        <li> <a href="" class="bt"> DE</a></li>
        <!-- <i><img src="images/icon/globe.png"></i> -->
         <?php 
         if (isset($_SESSION['role']) && $_SESSION['role']=='Admin'){?>
          <li><a href="admin/dashboard.php" class="bt">Dashboard</a></li>
       <?php }?>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a class="<?php $page=='home'?print'active':print'';?>" id="home" href="index.php">Home </a></li>
    <li><a href="webshop.php" class="<?php $page=='webshop'?print'active':print'';?>">Web Shop</a></li>
    <li><a href="aboutUs.php" class="<?php $page=='about'?print'active':print'';?>">About Us</a></li>
    <li><a href="blog.php" class="<?php $page=='blog'?print'active':print'';?>">Blog</a></li>
    <li><a href="contact.php" class="<?php $page=='contact'?print'active':print'';?>">Contact</a></li>
  </ul>

<!-- Dropdown Structure -->
<ul id="account" class="dropdown-content right" style="background: black;padding-top:0px;margin-top:0px">
  <?php 
    if (isset($_SESSION['email']) && isset($_SESSION['email']) !='') {
     echo ' <li ><a class="" href="profile.php" style="color: white">My Account</a></li><br>
            <li ><a class="" href="profile-orders.php" style="color: white">My Order</a></li><br>
            <li ><a class="" href="profile-subscription.php" style="color: white">My Suscription</a></li><br>
            <li ><a class="" href="logout.php" style="color: white">Logout</a></li>';
      }
   else{echo'
      <li ><a class="" href="login.php" style="color: white" >Login</a></li><br>
  <li ><a class="" href="register.php" style="color: white">Register</a></li>';
   }
  ?>
  
</ul>



<script type="text/javascript">
  <?php if (!isset($_SESSION['id'])) {?>
  const cart = document.getElementById('cart');
  let no = 0;
  if (JSON.parse(localStorage.getItem('items')) !== null) {
      JSON.parse(localStorage.getItem('items')).map(data=>{
      no = no+data.qty
    });
  }
  
  cart.innerHTML = no;
 <?php }?>
</script>





<!--<script type="text/javascript">
  const currentLocation = location.href;
  var fileName = location.pathname.split("/").slice(-1)
  const menuItem = document.getElementsByClassName('bt');
  const menuLength = menuItem.length;
  for(let i = 0; i<menuLength; i++){
    const menu = menuItem[i].innerHTML
    console.log(menu)
      console.log(fileName[0])
    if (menu === fileName[0]) {
      menuItem[i].className='active';
      console.log(menu);
      
    }
    // console.log(currentLocation);
   // console.log(menu)
  }

  // const currentPage = 'http://localhost/finalProject/echtezalm/'+fileName[0];

</script> -->