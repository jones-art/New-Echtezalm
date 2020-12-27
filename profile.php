<?php $page ='blog'; include 'head.php' ?>
<!-- <style>
ul, li .account{
  list-style-image: url('images/icon/user.png');
}
</style> -->
<?php
$userEmail = $_SESSION['email'];
$s = $connect2db->prepare("SELECT * FROM users WHERE id=? AND email =?");
$s->execute([$id,$userEmail]);
$profile = $s->fetch();

$dl = $connect2db->prepare("SELECT * FROM shipping_details WHERE id=? AND email =?");
$dl->execute([$id,$userEmail]);
$prof= $dl->fetch();

// if(isset($_POST['unit_Data_Id'])){
//   ob_clean();
//   // $newPass = md5($_POST['unit_Data_Id']);
//   $jd = $connect2db->prepare("SELECT password FROM users WHERE id=?");
//   $jd->execute([$id]);
//   $je = $jd->fetch();
//   echo $je->password;
// }


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
<!-- Description Section Start -->
<section style="padding-top: 0px;background: #0F0F0F;"> <!-- data-aos="flip-up" data-aos-duration="2000"> -->
	<div class="container">
		<div class="row"  data-aos="flip-down" data-aos-duration="1000">
    <div class="col l4 s12 m4 white-text card" id="black" style="background: #3A3A3A">
        <div class="card" style="padding-left:15px;background:transparent;box-shadow:0px 0px 0px 0px">
            <div class="card-content white-text" style="text-align:left;align-content:left;padding-top:10px">
        <a href="profile.php">
          <div class="row valign-wrapper">
            <div class="col s2 right-align">
              <img src="images/icon/user.png" style="width:20px;height:20px;margin-top:3px" alt="" class="responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span style="color:#DAC08E">
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

			<div class="col l8 m12 s12 right-align">
        <div class="card" style="background:transparent;padding:10px;border:1px solid #fff">
          <div class="card-content center white-text">
            <h5 class="left-align"> Mijn rekening</h5>
            <hr>
            <div class="row center" style="margin-top:25px">
              <div class="col l6 m6" style="border:1px solid #fff;margin-left:20px;height:197px">
                  <div class="collection left-align" style="border:0px">
                    <div class="collection-item" style="background:transparent;"> 
                      <a href="register.php?user_id=<?php echo $id;?>" class="secondary-conten left-align white-text" style="background:transparent"> Accountgegevens <img src="images/icon/edit.png"style="width:20px;height:20px;margin-top:0px" class="right"></a>
                    </div>
                  </div>
                  <div class="accordian" style="margin-bottom: 20px;padding-left:20px">
                    <p> <?php echo $profile->fname .' '. $profile->lname; ?> </p>
                    <p> <?php echo $userEmail;?></p>
                    <p style="margin-top:20px;"><a class="modal-trigger" style="color:#DAC08E" href="#modal1">Wachtwoord wijzigen</a> </p>
                  </div>
              </div>  <!-- Left side pane of the right account panel -->
              <div class="col l5 m5" style="border:1px solid #fff;margin-left:10px;height:197px">
                  <div class="collection left-align" style="border:0px">
                    <div class="collection-item" style="background:transparent;"> 
                      <a href="checkout.php?user_id=<?php echo $id;?>" class="secondary-conten left-align white-text" style="background:transparent"> afleveradres <img src="images/icon/edit.png"style="width:20px;height:20px;margin-top:0px" class="right"></a>
                    </div>
                  </div>
                  <div class="accordian" style="margin-bottom: 20px;padding-left:20px">
                    <p> <?php echo $prof->apartment.', '. $prof->lga; ?> </p>
                    <p> <?php echo $prof->state;?> , <?php echo $prof->country;?></p>
                    <p> <?php echo $prof->phone;?></p>
                  </div>
              </div> <!-- right side pane of the right account panel -->
            </div>
          </div>
<?php
$sub = $connect2db->prepare("SELECT s.status,s.id as subID, s.sub_date,s.user_id,s.order_id,s.plan,s.month,s.duration,coll.id as collID, coll.Coll_details,coll.info_details,coll.images FROM subscriber AS s LEFT JOIN collection AS coll ON s.plan = coll.id WHERE user_id=?");
$sub->execute([$id]);
if($sub->rowcount() <1){?>
          <div class="card-action">
            <div class="row">
              <div class="col l12 m12 center align-center" style="border: 1px dashed rgba(255, 255, 255, 0.7);box-sizing: border-box;height: 164px;">
                  <h6 class="center"> Geen actief abonnement</h6>
                  <p class="center"> Ga naar onze collectiewinkel en abonneer u nu op een van onze unieke collectebussen</p>
              </div>
            </div>
          </div>
<?php 
}else{
?>      

          <div class="card-action">
            <div class="row">
              <div class="col l12 m12 center align-center" style="border: 1px dashed rgba(255, 255, 255, 0.7);box-sizing: border-box;height: 260px;">
                  <h6 class="center"> Actief abonnement</h6>
                  <hr>
    <?php 
while($su = $sub->fetch()){
    ?>
                  <div class="row">
                    <div class="col l4 s4">
                      <img src="admin/collection/<?php echo $su->images;?>" style="width:130px;height:130px;margin-top:26px">
                    </div>
                    <div class="col l7 s7">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px"><?php echo $su->Coll_details;?></p>
                      <p style="margin-bottom:0px;margin-top:0px"><?php echo $su->info_details;?></p> </div>

                      <div style="margin-top:10px">
                      <p style ="margin-bottom:0px"> 2 Month Plan</p>
                      <p style="margin-bottom:2px;margin-top:0px;color:#7CF094"> 1 Month remaining </p> </div>
                    </div>
                    <div class="col l1 s1" style="padding:10px;"> 
                      <a href="!#" class="left" style="color:#DAC08E;position:relative;top:75px;right:50px">Visie</a></div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
<?php } ?>
          <p class="white-text center"> 03d: 03u: 24m tot volgende verzending</p>
        </div>
			</div>

		</div>
            <!-- Third Row of the blog -->

	</div>
    <div class="container" style="height:136px"></div>
</section>
<!-- Description Section End -->
  <!-- Modal Structure -->
  <div id="modal1" class="modal" style="width:200px">
    <div class="modal-content" style="background:#000">
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
      
    </div>
    <div class="modal-footer" style="background:#000">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat btn">Close</a>
      <button type="submit" class="btn waves-effect" name="update" id="updButton" style="padding-top:0px;line-height:16px;background:#DAC08E;display:none;"> Update</button>
    </div> 
  </form>
  </div>
</div>
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


// $('.modal-trigger').on('click',function(){
//   let oldPass = $(this).data('pass');
// });
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

// $('#opass').on('keydown',function(){
//   let userID = '<?php //echo $id; ?>';
//   $.ajax({
//     type: 'POST',
//     data: {unit_Data_Id:userID},
//     success: function(data) {
//       //console.log(data);
//       $('#oPassInfo').html(data);
//       //alert(data);
//     }
//   });
//   let oldPass = $('#opass').val();
//   let newPassword = '<?php //echo md5(); ?>';
//   alert (newPassword);
// })
</script>
<?php include 'script.php' ?>
