<?php $page ='blog'; include 'head.php' ?>
<!-- Description Section Start -->
<section style="padding-top: 0px;background: #0F0F0F;"> <!-- data-aos="flip-up" data-aos-duration="2000"> -->
	<div class="container">
  <div class="row">
    <div class="col l4 s12 m4 white-text card" id="black" style="background: #3A3A3A">
        <div class="card" style="padding-left:15px;background:transparent;box-shadow:0px 0px 0px 0px">
            <div class="card-content white-text" style="text-align:left;align-content:left;padding-top:10px">
        <a href="profile.php">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/user-no.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="white-text">
                Account
              </span>
            </div>
          </div> 
        </a>

        <a href="myOrder.php">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/lock.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img white-text"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span style="color:#DAC08E">
                Orders
              </span>
            </div>
          </div> 
        </a>

        <a href="profile-subscription.php">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/diamond-no.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img white-text "> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="white-text">
                Subscription
              </span>
            </div>
          </div> 
        </a>
            </div>
            <div class="card-action center">
              <a href="logout.php" class="white-text">Afmelden</a>
            </div>
          </div>
      </div>

			<div class="col l8 m8 s12 right-align">
        <div class="card" style="background:transparent;padding:10px;border:1px solid #fff">
          <div class="card-content center white-text">
            <h5 class="left-align"> Mijn bestellingen </h5>
            <hr>
            <div class="row">
              <div class="col l4 m4 left"><p class="white-text">Products for Order ID:</p></div>
              <div class="col l4 m4 center"><p class="white-text"><?php echo $_GET['product_id'];?></p></div>
            </div>
            <div class="row center" style="margin-top:25px;padding-left:0px;margin-bottom:0px">
              <div class="col l11 m11">
<?php
  if(isset($_GET['product_id'])){
  $prdID = $_GET['product_id'];
  $prd = $connect2db->prepare("SELECT p.id as prodID, p.user_id,p.product_id,p.quantity,p.order_id,p.total_amount,prd.id,prd.prd_name,prd.image FROM prd_order as p INNER JOIN product AS prd ON p.product_id=prd.id WHERE user_id=? AND order_id=?");
  $prd->execute([$id,$prdID]);
  while($fprd = $prd->fetch()){
//      $prdid = $fprd->prod;
    $prodID = $fprd->prodID;
?>               <div class="row center">
                    <div class="col l4 s12" style="padding-left:0px">
                      <img src="admin/product/<?php echo $fprd->image;?>" style="width:130px;height:130px;margin-top:26px" class="responsive-img">
                    </div>
                    <div class="col l5 s12 center">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px"><?php echo $fprd->prd_name;?></p></div>

                      <div style="margin-top:20px">
                        <p style ="margin-bottom:0px;color:#C1C1C1"> <strong>Price: </strong><?php echo number_format($fprd->total_amount,2);?></p>
                      <p style ="margin-bottom:0px;color:#C1C1C1"> <strong>Quantity: </strong>  <em> <?php echo $fprd->quantity;?></em></p>
                      <!-- <p style="margin-bottom:2px;margin-top:0px;color:#C1C1C1"> Pending</p>  --></div>
                    </div>
                    <div class="col l3 s12 center" style="padding:10px;"> 
                      <a href="profile-orders-detail.php?product_id=<?php echo $prodID;?>&order_id=<?php echo $prdID; ?>" class="left" style="color:#DAC08E;">Review</a></div>
                  </div>
          <?php }} ?>
              
              </div>  <!-- Left side pane of the right account panel -->
            </div>




          </div>

        </div>
			</div>

		</div>
            <!-- Third Row of the blog -->

	</div>
    <div class="container" style="height:136px"></div>
</section>
<!-- Description Section End -->
<!-- <img src="images/icon/user.png"style="width:24px;height:24px"> -->
<?php include ('footer.php'); ?>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card -->
<script type="text/javascript" src="js/flip.min.js"></script>

<script type="text/javascript">
	AOS.init();
	$('.carousel').carousel({
    fullWidth: true,
    indicators: true
});

var autoplay = true;

setInterval(function() { 
    if(autoplay) $('.carousel.carousel-slider').carousel('next');
}, 4500);


</script>
<?php include 'script.php' ?>