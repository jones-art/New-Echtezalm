<?php $page ='blog'; include 'head.php' ?>
<!-- <style>
ul, li .account{
  list-style-image: url('images/icon/user.png');
}
</style> -->

<!-- Description Section Start -->
<section style="padding-top: 0px;background: #0F0F0F;"> <!-- data-aos="flip-up" data-aos-duration="2000"> -->
	<div class="container">
		<div class="row"  data-aos="flip-down" data-aos-duration="1000">
			<div class="col l4 s12 m4 white-text card" id="black" style="background: #3A3A3A">
          <div class="card" style="padding-left:15px;background:transparent;box-shadow:0px 0px 0px 0px">
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
                    <img src="images/icon/lock.png"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="profile-orders.php" class="active" style="margin-top:0px;padding-top:0px;">Bestellingen</a>
                  </div>

                </div>
              </li>
              <li>
               <div class="row">
                  <div class="col s2">
                    <img src="images/icon/<?php $page=='psub'?print'diamond.png':print'diamond-no.png';?>"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="profile-subscription.php" class=" <?php $page=='psub'?print'active':print'white-text';?>" style="margin-top:0px;padding-top:0px;">Abonnement</a>
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
			</div>

			<div class="col l8 m12 s12 right-align">
        <div class="card" style="background:transparent;padding:10px;border:1px solid #fff">
          <div class="card-content center white-text">
            <h5 class="left-align"> Mijn bestellingen</h5>
            <hr>
            <div class="row">
              <div class="col l4 m4"><p class="white-text">4 Bestellingen geplaatst in</p></div>
              <div class="col l4 m4"><p class="white-text">Laatste 30 dagen</p></div>
            </div>

            <div class="row center" style="margin-top:25px;padding-left:0px;margin-bottom:0px">
              <div class="col l11 m11" style="height:197px">
                  <div class="row">
                    <div class="col l4 s4" style="padding-left:0px">
                      <img src="images/dutch-edition.png" style="width:130px;height:130px;margin-top:26px">
                    </div>
                    <div class="col l5 s5">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px">Fresh Salmon Fish With Smoked Onions </p></div>

                      <div style="margin-top:20px">
                      <p style ="margin-bottom:0px;color:#C1C1C1"> Placed on 04-02-2020</p>
                      <p style="margin-bottom:2px;margin-top:0px;color:#C1C1C1"> Pending</p> </div>
                    </div>
                    <div class="col l3 s3" style="padding:10px;"> 
                      <a href="!#" class="left" style="color:#DAC08E;position:relative;top:75px;left:65px">Zie de details</a></div>
                  </div>
              </div>  <!-- Left side pane of the right account panel -->
            </div>

            <div class="row center" style="padding-left:0px;margin-bottom: 0px">
              <div class="col l11 m11" style="height:197px">
                  <div class="row">
                    <div class="col l4 s4" style="padding-left:0px">
                      <img src="images/dutch-edition.png" style="width:130px;height:130px;margin-top:26px">
                    </div>
                    <div class="col l5 s5">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px">Fresh Salmon Fish </p></div>
                      <div class="rateyo" id= "rating" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3">

                      <div style="margin-top:20px">
                      <p style ="margin-bottom:0px;"> Placed on 04-02-2020</p>
                      <p style="margin-bottom:2px;margin-top:0px;color:#7CF094"> Delivered 06-03-2020</p> </div>
                    </div>
                    <div class="col l3 s3" style="padding:10px;"> 
                      <a href="!#" class="left" style="color:#DAC08E;position:relative;top:75px;left:65px">Zie de details</a></div>
                  </div>
              </div>  <!-- Left side pane of the right account panel -->
            </div>

            <div class="row center" style="padding-left:0px">
              <div class="col l11 m11" style="height:197px">
                  <div class="row">
                    <div class="col l4 s4" style="padding-left:0px">
                      <img src="images/dutch-edition.png" style="width:130px;height:130px;margin-top:26px">
                    </div>
                    <div class="col l5 s5">
                      <div>
                      <p style="margin-bottom:0px;margin-top:30px">Fresh Salmon Fish With Smoked Onions </p></div>

                      <div style="margin-top:20px">
                      <p style ="margin-bottom:0px;color:#C1C1C1"> Placed on 04-02-2020</p>
                      <p style="margin-bottom:2px;margin-top:0px;color:#F64F4F"> Canceled</p> </div>
                      <p id="ratingOutput">0</p>
                    </div>
                    <div class="col l3 s3" style="padding:10px;"> 
                      <a href="!#" class="left" style="color:#DAC08E;position:relative;top:75px;left:65px">Zie de details</a></div>
                  </div>
                   
                    <span class='result' style="color:#fff;" >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
    <input type="text" name="rating" style="color:#fff;">
         </div>
              </div>  <!-- Left side pane of the right account panel -->
            </div>


          </div>

        </div>
			</div>

		</div>
            <!-- Third Row of the blog -->

	</div>
    <!-- <div class="container" style="height:136px"></div> -->
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
<script src="js/rateyo.min.js"></script>
 <script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $('#ratingOutput').val(rating);
            // alert(rating);
             //add rating value to input field
        });
    });
</script>