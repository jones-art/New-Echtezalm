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
<?php
  $p = $connect2db->query("SELECT count(id) as id FROM tbl_order WHERE user_id=$id AND MONTH(ord_date)=MONTH(CURRENT_DATE()) AND payment_status = 'Paid'");
  // $curMonth = MONTH(CURRENT_DATE());
  // $p->execute([$id,$curMonth]);
  $pf = $p->fetch();
?>
			<div class="col l8 m8 s12 right-align">
        <div class="card" style="background:transparent;padding:10px;border:1px solid #fff;">
          <div class="card-content center white-text">
            <h5 class="left-align"> Mijn bestellingen </h5>
            <hr>
            <div class="row">
              <div class="col l4 m4"><p class="white-text"><?php echo $pf->id; ?> Bestellingen geplaatst in</p></div>
              <div class="col l4 m4"><p class="white-text">Laatste 30 dagen</p></div>
            </div>

            <div class="row center" style="margin-top:25px;padding-left:0px;margin-bottom:0px">
              <div class="col s12">
                  <div class="row">
<?php
  $prd = $connect2db->prepare("SELECT * FROM tbl_order WHERE user_id=? AND payment_status = ?");
  $prd->execute([$id, 'Paid']);
  while($fprd = $prd->fetch()){
?>                    <div class="col l12 s12" style="border:1px solid #fff;margin:10px;max-width:90%">
                          <div class="row">
                            <div class="col m4 s12">Order ID:</div>
                            <div class="col m4 s12"><?php echo $fprd->order_id; ?></div>
                            <div class="col m4 s12"></div>
                      </div>
                      
                          <div class="row">    
                            <div class="col m4 s12">Placed On:</div>
                            <div class="col m4 s12"><?php echo $fprd->ord_date;; ?></div>
                            <div class="col m4 s12"></div>
                        </div>
                              
                        <div class="row">
                            <div class="col m4 s12">Total Items:</div>
                            <div class="col m4 s12"><?php $order = $fprd->order_id;
                                $items = $connect2db->query("SELECT count(id) as id FROM prd_order WHERE user_id=$id AND order_id = $order ");
                                $itm = $items->fetch(); echo $itm->id;?></div>
                            <div class="col m4 s12"></div>  
                      </div>
                              
                      <div class="row">
                            <div class="col m4 s12">Status:</div>
                            <div class="col m4 s12"style="color:<?php if($fprd->del_status=='Pending'){echo '#c1c1c1;font-weight:300';}elseif($fprd->del_status=='Canceled'){echo '#F64F4F';}else{echo '#7CF094';}?>"> <?php echo $fprd->del_status; ?></div>
                            <div class="col m4 s12"></div>
                      </div>
                      
                      <div class="col s12"><a href="preview-order.php?product_id=<?php echo $fprd->order_id;?>" class="left" style="color:#DAC08E;position:relative;left:15%">Zie de details</a></div>

                      <?php 
                      if($fprd->del_status == 'Delivered'){?>
                       <button type="submit" style="width:100%;height: 41px;background:#3A3A3A;color:#7CF094;margin-bottom:15px"> Delivered on: <?php echo $fprd->del_date; ?></button>
                     <?php } ?>
                    </div>
          <?php } ?>
                              
                          </div>
                       
                      
                  </div>
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