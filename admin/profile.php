<?php $page ='profile'; include 'head.php' ;
  $getData = $connect2db->prepare("SELECT * FROM users WHERE id = ?");
  $getData->execute([$id]);
  if ($getData->rowcount() > 0) {
    $data = $getData->fetch();

    $name = $data->fname." ".$data->lname;
    $email = $data->email;
    $country = $data->country;

  }

  $activeSub = $connect2db->prepare("SELECT count(id) as sub FROM subscriber WHERE user_id = ? and status != ? ");
  $activeSub->execute([$id, 'Expired']);
  $getCount = $activeSub->fetch();
  $count = $getCount->sub;

  $getShipAdd = $connect2db->prepare("SELECT phone, country, state, apartment FROM shipping_details WHERE user_id = '$id' ");
  $getShipAdd->execute();
  $getAdd = $getShipAdd->fetch();
  $pnum = $getAdd->phone;
  $country = $getAdd->country;
  $state = $getAdd->state;
  $apartment = (is_null($getAdd->apartment))?print'-------':print $getAdd->apartment;

if(isset($_POST['update'])){
  $oldPassword = md5($_POST['opass']);
  $newPassword = md5($_POST['newPass']);
  $s = $connect2db->prepare("SELECT password FROM users WHERE id=? AND password=?");
  $s->execute([$id,$oldPassword]);
  if($s->rowcount() > 0){
      $upd = $connect2db->prepare("UPDATE users SET
        password='$newPassword'
        WHERE id=?
        ");
      $upd->execute([$id]);
      if($upd){
      // header('location: profile.php');
       echo "<script> alert('Updated Successfully')</script>";
      }
  }else{
    echo "<script> alert('<-- You entered an incorrect old password, try again !!! --->')</script>";
  }
}
?>

<?php if (isset($_SESSION['id'])) {
  $getDate = $connect2db->prepare("SELECT delv_date FROM delivery WHERE user_id =? AND status = ?  ");
  $getDate->execute([$id, 'Processing']);
  $getDelDate = $getDate->fetch();
  $delDate = $getDelDate->delv_date;
  
  } ?>

<section style="padding-top: 0px;background: #0F0F0F;"> <!-- data-aos="flip-up" data-aos-duration="2000"> -->
	<div class="container">
		<div class="row"  data-aos="flip-down" data-aos-duration="1000">
			<div class="col m4 s12 white-text card" id="black" style="background: #3A3A3A">
          <div class="card" style="padding-left:15px;background:transparent;box-shadow:0px 0px 0px 0px">
            <div class="card-content" style="text-align:left;align-content:left">
              <span class="card-title">&nbsp;</span>
              <ul class="side-nav">
              <li class="account active">
                <div class="row">
                  <div class="col s2">
                    <img src="images/icon/<?php $page=='profile'?print'user.png':print'user-no.png';?>"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="profile.php" class=" <?php $page=='profile'?print'active':print'white-text';?>" style="margin-top:0px;padding-top:0px;">Account <?php //echo $delDate; ?></a>
                  </div>

                </div>
                
              </li>
              <li>
                <div class="row">
                  <div class="col s2">
                    <img src="images/icon/lock-no.png"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="myOrder.php" class="white-text" style="margin-top:0px;padding-top:0px;">Bestellingen</a>
                  </div>

                </div>
              </li>
              <li>
               <div class="row">
                  <div class="col s2">
                    <img src="images/icon/diamond-no.png"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="profile-subscription.php" class=" white-text" style="margin-top:0px;padding-top:0px;">Abonnement</a>
                  </div>

                </div>
              </li>
            </ul>
            </div>
            <div class="card-action center">
              <a href="logout.php" class="white-text">Afmelden</a>
            </div>
          </div>


			</div>

			<div class="col l8 m12 s12 right">
        <div class="card" style="background:transparent;padding:10px;border:1px solid #fff">
          <div class="card-content center white-text">
            <h5 class="left-align"> Mijn rekening</h5>
            <hr>
            <div class="row center" style="margin-top:25px">
                
              <div class="col l6 s12" style="border:1px solid #fff;margin-left:20px;">
                  <div class="collection left-align" style="border:0px">
                    <div class="collection-item" style="background:transparent;"> 
                     <a href="register.php?user_id=<?php echo $id;?>" class="secondary-conten left-align white-text" style="background:transparent"> Accountgegevens <img src="images/icon/edit.png"style="width:20px;height:20px;margin-top:0px" class="right"></a>
                    </div>
                  </div>
                  <div class="" style="margin-bottom: 20px;padding-left:20px">
                    <p> <?php echo $name;?></p>
                    <p> <?php echo $email;?></p>
                    <p style="margin-top:20px;"><a class="modal-trigger" style="color:#DAC08E" href="#modal1">Wachtwoord wijzigen</a> </p>
                  </div>
              </div>  
                <!-- Left side pane of the right account panel -->
              <div class="col l5 s12" style="border:1px solid #fff;margin-left:10px;height:197px">
                  <div class="collection left-align" style="border:0px">
                    <div class="collection-item" style="background:transparent;"> 
                     <a href="checkout.php?user_id=<?php echo $id;?>" class="secondary-conten left-align white-text" style="background:transparent"> afleveradres <img src="images/icon/edit.png"style="width:20px;height:20px;margin-top:0px" class="right"></a>
                    </div>
                  </div>
                  <div class="accordian" style="margin-bottom: 20px;padding-left:20px">
                    <p> <?php echo $apartment?></p>
                    <p> <?php echo $state?>, <?php echo $country?></p>
                    <p> <?php echo $pnum?></p>
                  </div>
              </div> <!-- right side pane of the right account panel -->
            </div>
          </div>

          <?php 
            if ($count == 0) {?>
              <div class="card-action">
                <div class="row">
                  <div class="col s12 center align-center" style="border: 1px dashed rgba(255, 255, 255, 0.7);box-sizing: border-box;height: 164px;">
                      <h6 class="center"> Geen actief abonnement</h6>
                      <p class="center"> Ga naar onze collectiewinkel en abonneer u nu op een van onze unieke collectebussen</p>
                  </div>
                </div>
              </div>
            <?php
          } else{?>
             <div class="card-action">
            <div class="row">
              <div class="col l12 m12 center align-center" style="border: 1px dashed rgba(255, 255, 255, 0.7);box-sizing: border-box;">
                  <h6 class="center"> Actief abonnement</h6>
                  <hr>
                  <?php
            $getSub = $connect2db->prepare("SELECT sub.plan, sub.month,sub.payment_status, sub.id AS collID,sub.duration,sub.order_id,coll.Coll_details, coll.id, coll.price,coll.images,coll.info_details FROM subscriber as sub INNER JOIN collection as coll ON sub.plan=coll.id WHERE sub.user_id=? AND sub.status!=? ORDER BY sub.id DESC LIMIT 0,1 ");
            $getSub->execute([$id, 'Expired']);


            while ($getSubData = $getSub->fetch()) {
                  $order_id = $getSubData->order_id;?>

              <div class="row">
                    <div class="col l4 s12">
                      <img src="admin/collection/<?php echo $getSubData->images?>" class="responsive-img" style="width:130px;height:130px;margin-top:26px">
                    </div>
                    <div class="col l6 s12 center">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px"><?php echo $getSubData->Coll_details;?></p>
                      <p style="margin-bottom:0px;margin-top:0px"><?php echo $getSubData->info_details;?></p> </div>

                      <div style="margin-top:10px">
                      <p style ="margin-bottom:0px"> <?php echo $getSubData->duration;?> Month Plan</p>
                      <?php 
                        

            $getDelLeft= $connect2db->prepare("SELECT count(id) as remain FROM sub_duration WHERE sub_id = ? AND user = ?  AND delv_status=?");
            $getDelLeft->execute([$order_id, $id, 'Pending']);
            $delLeft = $getDelLeft->fetch();
            $deleviriesLeft= $delLeft->remain;
                      ?>
                      <p style="margin-bottom:2px;margin-top:0px;color:#7CF094"> <?php echo $deleviriesLeft;?> Month remaining  </p> </div>
                    </div>
                    <div class="col l1 s12" style="padding:10px;"> 
                      <a href="product-suscription-details.php?id=<?php echo $getSubData->collID;?>&order=<?php echo $order_id;?>" class="center" style="color:#DAC08E;display:flex;align-items:center;justify-content:center">Visie</a></div>
                  </div>
              </div>
            </div>
          </div>
           <?php  }
            ?>

             
                  

          <p class="white-text center" id="delv"> </p>
         <?php }
          ?>
          

          
        </div>
			</div>

		</div>
            <!-- Third Row of the blog -->

	</div>
    <!-- <div class="container" style="height:136px"></div> -->
</section>
<!-- Description Section End -->

<!-- Description Section End -->
  <!-- Modal Structure -->
  <div id="modal1" class="modal" style="width:200px">
    <div class="modal-content" style="background:#000">
        <a href="#!" class="modal-close waves-effect waves-gold btn-large btn white-text" style="background:transparent;font-size:18px;">&times;</a>
      <h4 class="white-text">Change Password</h4>
        <div class="row">
    <form class="col s12" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input id="opass" type="password" class="white-text browser-default input" name="opass">
          <!-- <small style="color: red" id="oPassInfo"> old password is incorrect </small> -->
          <label for="opass"> Old Password</label>
        </div>
      </div>      
      <div class="row">
        <div class="input-field col s6">
          <input id="newPass" type="password" class="white-text browser-default input" name="newPass">
          <label for="newPass"> Enter New Password</label>
        </div>
        <div class="input-field col s6">
          <input id="confPass" type="password" class="white-text browser-default input" name="confPass">
          <small id="passInfo">  </small>
          <label for="confPass"> Confirm Password</label>
        </div>
      </div>
      
    
    <div class="modal-footer" style="background:#000">
      
      <button type="submit" class="btn waves-effect" name="update" id="updButton" style="padding-top:0px;line-height:16px;background:#DAC08E;display:none;"> Update</button>
    </div> 
  </form>
    </div>
  </div>
</div>

<!-- <img src="images/icon/user.png"style="width:24px;height:24px"> -->
<?php include ('footer.php'); ?>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card -->
<script type="text/javascript" src="js/flip.min.js"></script>


<script>
AOS.init();
    $('#confPass').on('change',function(){
  let pass = $('#newPass').val();
  let cPass = $('#confPass').val();
  let passInfo = $('#passInfo');
  if(pass == cPass){
    passInfo.html('password matched');
    $('#passInfo').css('color', 'green');
    $('#updButton').css('display', 'inline-block');
  }else{
    passInfo.html('password mismatched');
    $('#passInfo').css('color', 'red');
    $('#updButton').css('display', 'none');
  }
});
// Set the date we're counting down to
let date = <?php echo "'$delDate'"; ?>;
//alert(date);

var countDownDate = new Date(date).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
//    document.getElementById("delv").innerHTML = days +" "+ hours +" "+ minutes+" "+ seconds;
  document.getElementById("delv").innerHTML = Number(days) + "d: " + Number(hours) + "h: " + Number(minutes) + "m: " + Number(seconds) + "s till next shipping";
//alert(typeof(minutes));
  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("delv").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<?php include 'script.php' ?>
