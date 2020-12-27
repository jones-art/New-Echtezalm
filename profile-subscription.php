<?php $page ='blog'; include 'head.php';
// $id = $_SESSION['id']; ?>
<style>
.active{
  color:#DAC08E;
}
</style>

<!-- Description Section Start -->
<section style="padding-top: 0px;background: #0F0F0F;"> <!-- data-aos="flip-up" data-aos-duration="2000"> -->
	<div class="container">
		<div class="row"  data-aos="flip-down" data-aos-duration="1000">
<!--     <div class="col l4 s12 m4 white-text card" id="black" style="background: #3A3A3A">
        <div class="card" style="padding-left:15px;background:transparent;box-shadow:0px 0px 0px 0px">
            <div class="card-content white-text" style="text-align:left;align-content:left;padding-top:10px">
        <a href="#!">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/user.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img white-text"> <!-- notice the "circle" class -->
     <!--        </div>
            <div class="col s10">
              <span class="white-text">
                Account
              </span>
            </div>
          </div> 
        </a>

        <a href="#!">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/lock.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img white-text"> <!-- notice the "circle" class -->
          <!--   </div>
            <div class="col s10">
              <span class="white-text">
                Orders
              </span>
            </div>
          </div> 
        </a>

        <a href="#!">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/diamond.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img active"> <!-- notice the "circle" class -->
            <!-- </div>
            <div class="col s10">
              <span class="active">
                Subscription
              </span>
            </div>
          </div> 
        </a>
            </div>
            <div class="card-action center">
              <a href="#" class="white-text">Afmelden</a>
            </div>
          </div>
      </div> --> --> --> -->
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
              <img src="images/icon/lock-no.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img white-text"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="white-text">
                Orders
              </span>
            </div>
          </div> 
        </a>

        <a href="profile-subscription.php">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/diamond.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img white-text "> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span style="color:#DAC08E">
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

			<div class="col l8 m12 s12 right-align">
        <div class="card" style="background:transparent;padding:10px;border:1px solid #fff">
          <div class="card-content center white-text">
            <h5 class="left-align"> Mijn abonnement</h5>
            <hr>
            <div class="row" style="margin-bottom:0px">
              <div class="col l12 m12"><p class="white-text">Huidig ​​abonnement</p></div>
            </div>
<?php
$sub = $connect2db->prepare("SELECT s.status,s.id as subID, s.sub_date,s.user_id,s.order_id,s.plan,s.month,s.duration,coll.id as collID, coll.Coll_details,coll.info_details,coll.images FROM subscriber AS s LEFT JOIN collection AS coll ON s.plan = coll.id WHERE user_id=? AND s.status=?");
$sub->execute([$id,'Pending']);
if($sub->rowcount() < 1){?>
          <div class="card-action">
            <div class="row">
              <div class="col l12 m12 center align-center" style="border: 1px dashed rgba(255, 255, 255, 0.7);box-sizing: border-box;height: 164px;">
                  <h6 class="center"> Geen actief abonnement</h6>
                  <p class="center"> Ga naar onze collectiewinkel en abonneer u nu op een van onze unieke collectebussen</p>
              </div>
            </div>
          </div>
<!--   echo "User haven't suscrib to any collection"; -->
<?php
}else{
while($subColl = $sub->fetch()){
  if($subColl->plan == 0){
    $collection_details = 'Custom collection';
    $info_details = 'Product are randomly selected from webshop';
  }else{
    $collection_details = $subColl->Coll_details;
    $info_details = $subColl->info_details;
  }

  $d = $connect2db->prepare("SELECT count(id) as id FROM subscriber WHERE user_id=? AND status=?");
  $d->execute([$id,'Pending']);
  $di = $d->fetch();
  $duration = $di->id;

  $m = $connect2db->prepare("SELECT count(id) as id FROM subscriber WHERE user_id=?");
  $m->execute([$id,]);
  $mi = $m->fetch();
  $monthSub = $mi->id;
?>
            <div class="row center" style="margin-top:25px;padding-left:0px;margin-bottom:0px;margin-top:3px">
              <div class="col l11 m11" style="height:170px">
                  <div class="row">
                    <div class="col l4 s4" style="padding-left:0px">
                      <img src="admin/collection/<?php echo $subColl->images;?>" style="width:130px;height:130px;margin-top:26px">
                    </div>
                    <div class="col l5 s5">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px"><?php echo $collection_details;?></p>
                      <p style="margin-bottom:0px;margin-top:0px"><?php echo $info_details;?></p></div>

                      <div style="margin-top:20px">
                      <p style ="margin-bottom:0px"> <?php echo $monthSub.' ';?> Month Plan</p>
                      <p style="margin-bottom:0px;margin-top:0px;color:#7CF094"> <?php echo $duration.' ';?> Month remaining</p> </div>
                    </div>
                    <div class="col l3 s3" style="padding:10px;"> 
                      <a href="product-suscription-details.php?id=<?php echo $subColl->collID;?>&order=<?php echo $subColl->order_id;?>" class="left" style="color:#DAC08E;position:relative;top:75px;left:65px">Zie de details</a></div>
                  </div>
              </div>  <!-- Left side pane of the right account panel -->
            </div><hr>
            <?php }
            } ?>
            
<!--             <div class="row center" style="padding-left:0px;margin-bottom: 0px">
              <div class="col l11 m11" style="height:197px">
                  <div class="row">
                    <div class="col l4 s4" style="padding-left:0px">
                      <img src="images/dutch-edition.png" style="width:130px;height:130px;margin-top:26px">
                    </div>
                    <div class="col l5 s5">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px">Dutch Edition</p>
                      <p style="margin-bottom:0px;margin-top:0px">wine - 5, 15 or 30 pieces</p></div>

                      <div style="margin-top:20px">
                      <p style ="margin-bottom:0px"> 2 Month Plan</p>
                      <p style="margin-bottom:0px;margin-top:0px;color:#C4C4C4"> Expired</p> </div>
                    </div>
                    <div class="col l3 s3" style="padding:10px;"> 
                      <a href="!#" class="left" style="color:#DAC08E;position:relative;top:75px;left:65px">Zie de details</a></div>
                  </div>
              </div>  -->
              <!-- Left side pane of the right account panel -->
           <!-- </div> -->


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