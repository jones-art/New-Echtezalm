<?php $page = 'collection';
include 'head.php' ?>

<?php
  include 'includes/connection.php';
  $getDetails = $connect2db->prepare("SELECT * FROM pages WHERE page_name = ? AND status = ?");
  $getDetails->execute([$page, 1]);
  if ($getDetails->rowcount()>0) {
    $data = $getDetails->fetch();

    $title = $data->page_title;
    $banner = 'admin/'.$data->file1;
  } else{

    $title = 'A Special Experience Of Taste And Tradition';
    $banner = 'images/slider/1.png';
  }
?>

<section >
	<div class="carousel carousel-slider" style="height: 658px;">
    <div class="carousel-fixed-item center">  

      <h5 data-aos="flip-up" data-aos-duration="2000"><?php echo $title ?></h5>
        <div style="margin-top: 76px; margin-bottom: 157px;" data-aos="flip-right" data-aos-duration="1000">
          <!-- <a class="btn planbtn2">Get Started</a> -->
          <a class="btn planbtn center" 
      href="<?php if (isset($_SESSION['email'])){echo'select_plan.php';}else{ echo'login.php';} ?>">Collection</a>
       <!--  <a class="btn planbtn"></a> -->
        
    </div>
    </div>
    <!-- <div><a class="btn-floating white"><i class="material-icons black-text">add</i></a></div> -->
    <div class="carousel-item carousel-img " href="#one!" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(<?php echo($banner);?>);">
  
    </div>
    
  </div>
  </div>
</section>

<!-- How to use Section Starts -->
<section style="margin-top: 72px">
	<div class="container red" style="margin-top:27px"></div>
	<div class="container">
		<h5 class="center">Hoe het werkt</h5>
		  <div class="row"  data-aos="zoom-out" data-aos-duration="1000">
            <div class="col s6 l4 m6">
              <div class="center promo promo-example">
                <img src="images/icon/box.png"/>
                <h5 class="promo-caption">Bouw je eigen doos</h5>
                <hr class="hr">
                <p class="light center white-text">Kies uit onze selectie en creëer uw perfecte box</p>
              </div>
          </div>

            <div class="col s6 l4 m6">
              <div class="center promo promo-example">
                <img src="images/icon/delivery.png"/>
                <h5 class="promo-caption">Laat uw doos bezorgen</h5>
                <hr class="hr">
                <p class="light center">Uw bestelling is klaar om te worden verzonden en bij u afgeleverd</p>
              </div>
          </div>

            <div class="col s6 l4 m6">
              <div class="center promo promo-example">
               <img src="images/icon/meat.png"/>
                <h5 class="promo-caption">Geniet van je zalmvis</h5>
                <hr class="hr">
                <p class="light center">Geniet van een smaakvol gerecht bij je favoriete maaltijd</p>
              </div>
          </div>
			<!-- Webshop coloums Ends Here -->
		</div>
	</div>
</section>
<!-- How to use ends here -->

<!-- Why You Should Use EchteZalm? -->
<section style="margin-top: 72px;background:#3A3A3A;">
	<div class="container" style="height:50px"></div>
	<div class="container"  data-aos="zoom-in" data-aos-duration="1000">
		<h5 class="center" style="margin-bottom:62px">Why You Should Use EchteZalm?</h5>
<!--
         <div class="center">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
          </div>
		<p class="white-text center" style="margin-bottom:23px">My favourite place to make order</p>
-->
		<div class="container">
			<p class="center" style="color:#E8E8E8;margin-bottom:39px"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh nibh vestibulum malesuada lorem egestas non id. Amet, tincidunt quisque et non tincidunt pellentesque. Erat laoreet nisl sed dignissim sit est nulla. Id purus, quis porta quis. Sit in nisl viverra nam nulla pharetra. Integer tempor tempor, orci gravida blandit morbi cursus eget. Vestibulum vitae.</p>
		</div>

        <div class="row" style="margin-bottom:71px">
            <div class="col s6 l4 m6"  data-aos="flip-right" data-aos-duration="1000">
              <div class="card"  style="border:solid 1px #fff;margin-bottom:0px;background:transparent">
                <div class="card-content" style="padding-bottom: 22px;padding-right:17px;padding-left:17px">
                    <h6 class="white-text center" style="margin-top:18px;marging-bottom:10px">Bank of Vitamins</h6>
                    <p class="white-text"> Salmon is loaded with vitamins A, D, E and K which has various benefits to us </p>
                  </div>
              </div>
            </div>
            
            <div class="col s6 l4 m6"  data-aos="flip-right" data-aos-duration="1000">
              <div class="card"  style="border:solid 1px #fff;margin-bottom:0px;background:transparent">
                <div class="card-content" style="padding-bottom: 22px;padding-right:17px;padding-left:17px">
                    <h6 class="white-text center" style="margin-top:18px;marging-bottom:10px">Bank of Vitamins</h6>
                    <p class="white-text"> Salmon is loaded with vitamins A, D, E and K which has various benefits to us </p>
                  </div>
              </div>
            </div>
            
            <div class="col s6 l4 m6"  data-aos="flip-right" data-aos-duration="1000">
              <div class="card"  style="border:solid 1px #fff;margin-bottom:0px;background:transparent">
                <div class="card-content" style="padding-bottom: 22px;padding-right:17px;padding-left:17px">
                    <h6 class="white-text center" style="margin-top:18px;marging-bottom:10px">Bank of Vitamins</h6>
                    <p class="white-text"> Salmon is loaded with vitamins A, D, E and K which has various benefits to us </p>
                  </div>
              </div>
            </div>
        </div>
		<div class="container center" style="margin-top:71px;margin-bottom:42px">
			<a class="btn planbtn center" 
      href="<?php if (isset($_SESSION['email'])){echo'select_plan.php';}else{ echo'#';} ?>">Select Your Plan</a>
		</div>
			<!-- Blog coloums Ends Here -->
			<div class="container" style="height:77px"></div>
	</div>
</section>
<!-- Customer comment ends here -->

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
