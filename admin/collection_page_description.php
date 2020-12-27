<?php include 'head.php' ?>
<?php
	if (isset($_GET['id'])) {
        $encId = $_GET['id'];
		$data = urldecode(base64_decode($_GET['id']));
		$data = (($data/123456789/987)*789);
		include 'includes/connection.php';
		$getData = $connect2db->prepare("SELECT * FROM collection WHERE id = ? ");
		$getData->execute([$data]);
		$records = $getData->fetch();


	}
 ?>
<section style="padding-top: 59px;">
	<div class="container">
		<div class="row">
			<div class="col l6 m12 s12 right-align" data-aos='flip-left' data-aos-duration='1000' style="margin-top: 8px;">
				<a href="select_plan.php" style="color:#AD976E" class="right-align">< back </a>
				<img src="admin/collection/<?php echo $records->images;?>" class="responsive-img">
<!--
				<div class="row">
					<div class="col l4 s4 m4">
						<img src="images/collection/black-edition.png" class="responsive-img" style="margin-top:0px;padding-top:0px">
					</div>
					<div class="col l4 s4 m4">
						<img src="images/collection/black-edition.png" class="responsive-img" style="margin-top:0px;padding-top:0px">
					</div>
					<div class="col l4 s4 m4">
						<img src="images/collection/black-edition.png" class="responsive-img" style="margin-top:0px;padding-top:0px">
					</div>
				</div>
-->
			</div>

			<div class="col l6 s12 m12 white-text" data-aos='flip-right' data-aos-duration='1000' style="margin-top: 59px;">
				<?php echo'<h5>'. $records->Coll_details.'</h5>'; ?>
			<strong> Includes:</strong>
				<div class="desc" style="margin-top:13px;margin-right:30px;align-content:justify;">
					<?php echo $records->highlight;?>
				</div>

				<div class="card" style="background-color:transparent;margin-top: 51px;">
					<h5>€<?php echo $records->price ?></h5>
					<div style="margin-top:19px"><a href="custom_collection_checkout.php?id=<?php echo $encId;?>" class="webShpBtn center" style="width:198px;height:40px;border-radius:0px"> 
											 Select a plan</a></div>
					  
				</div>
			</div>

		</div>

<!-- Description crad -->
  <div class="row">
    <div class="col s12 m6 l7 offset5">
      <div class="card" style="background:transparent;">
        <div class="card-content white-text">
          <div class="card-title left-align" style="margin-bottom:30px">
          	<a href="#" class="webShpBtn center" style="background-color:transparent;"> Description</a>
          	<a href="<?php if (isset($_SESSION['email'])) {
                      echo 'collection_page_review.php?id='.$encId;}else{echo 'login.php';}?>"class="webShpBtn center">Reviews</a>
          </div>
          <p class="left-align" style="align-content:justify">
          	<?php echo $records->description;?>
			</p>
        </div>
      </div>
    </div>
  </div>

	</div>
</section>

<!-- Description Section End -->
<!-- Webshop Section Starts 
<section >
	<div class="container"  style="margin-top: 83px;">>
		<h5 class="center">Bekijk onze WebShop</h5>
		<p class="white-text center">Hier kunt u uw verse gerookte zalm bestellen</p>
		<!-- Second Row Ends Here 

	<div class="row" style="margin-top: 60px;">
		<div class="col s6 l3 m6" data-aos="flip-right" data-aos-duration="1000">
	      <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
	        <div class="card-image">
	          <img src="images/webshop.png" style="margin-top: 0px">
	        </div>
	        <div class="card-content" style="padding-bottom: 16px">
	        	<h6 class="white-text center">Product Name</h6>
	          	<h6 style="margin-bottom: 15px"> €39.95</h6>
	          	<a href="#"class="webBtn center">Voeg toe aan winkelkar</a>
	        </div>

	      </div>
		</div>

		<div class="col s6 l3 m6"  data-aos="flip-left" data-aos-duration="1000">
	      <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
	        <div class="card-image">
	          <img src="images/webshop.png" style="margin-top: 0px">
	        </div>
	        <div class="card-content" style="padding-bottom: 16px">
	        	<h6 class="white-text center">Product Name</h6>
	          	<h6 style="margin-bottom: 15px"> €39.95</h6>
	          	<a href="#"class="webBtn center">Voeg toe aan winkelkar</a>
	        </div>

	      </div>
		</div>

		<div class="col s6 l3 m6"  data-aos="flip-right" data-aos-duration="1000">
	      <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
	        <div class="card-image">
	          <img src="images/webshop.png" style="margin-top: 0px">
	        </div>
	        <div class="card-content" style="padding-bottom: 16px">
	        	<h6 class="white-text center">Product Name</h6>
	          	<h6 style="margin-bottom: 15px"> €39.95</h6>
	          	<a href="#"class="webBtn center">Voeg toe aan winkelkar</a>
	        </div>

	      </div>
		</div>

		<div class="col s6 l3 m6"  data-aos="flip-left" data-aos-duration="1000">
	      <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
	        <div class="card-image">
	          <img src="images/webshop.png" style="margin-top: 0px">
	        </div>
	        <div class="card-content" style="padding-bottom: 16px">
	        	<h6 class="white-text center">Product Name</h6>
	          	<h6 style="margin-bottom: 15px"> €39.95</h6>
	          	<a href="#"class="webBtn center">Voeg toe aan winkelkar</a>
	        </div>

	      </div>
		</div>
	</div>
		<!-- Third Row Ends Here 
        
	</div>
    <!-- Pagination goes here
      <ul class="pagination center" style="margin-top:144px;margin-bottom:47px">
        <li class=""><a href="#!" ><img src="images/icon/chevron_left.png" style="margin-right: 27px;"></a></li>
        <li class="waves-effect"><a href="#!" class="white-text btn black">1</a></li>
        <li class="waves-effect"><a href="#!" class="white-text btn black">2</a></li>
        <li class="waves-effect"><a class="white-text btn black" href="#!">3</a></li>
        <li class="waves-effect"><a class="white-text btn black"  href="#!">4</a></li>
        <li class="waves-effect"><a class="white-text btn black"  href="#!">5</a></li>
        <li class="waves-effect"><a class="white-text btn black"  href="#!">6</a></li>
        <li class="waves-effect"><a class="white-text btn black"  href="#!">7</a></li>
        <li class="waves-effect"><a class="white-text btn black"  href="#!">8</a></li>
        <li class="waves-effect"><a class="white-text btn black"  href="#!">9</a></li>
        <li class="waves-effect"><a class="white-text btn black"  href="#!"> 10</a></li>
        <li class=""><a href="#!"><img src="images/icon/chevron_right.png" style="margin-left: 27px;"></a></li>
      </ul>

    <div style="margin-right: 95px; margin-left: 95px;"><hr style="width:100%; "></div>
    <!--Pagination ends here
	</div>
</section>
<!-- Webshop ends here -->

<!-- Collection Section Starts -->
<section style="margin-top: 72px;">
	<div class="container">
		<h5 class="center">Meer pakketplan nodig?</h5>
		<p class="white-text center">Bekijk onze collectie, waar je voor elk plan het beste krijgt</p>
		<div class="row"  data-aos="flip-down" data-aos-duration="1000">
			<!-- Black Edition -->
			<div class="col l4 s12 m4 white-text card black" id="black">
				<div class="card-image">
					<img src="images/black-edition.png">
					<div class="white-text card-title center">Black Edition</div>
				</div>
			</div>
			<!-- Black Edition End Here -->

			<!-- Dutch Edition -->
			<div class="col l4 s12 m4 white-text card black" id="dutch">
				<div class="card-image">
					<img src="images/dutch-edition.png">
					<div class="white-text card-title center-align">Dutch Edition</div>
				</div>
			</div>
			<!-- Dutch Edition End Here -->

			<!-- Classic Edition -->
			<div class="col l4 s12 m4 white-text card black" id="classic">
				<div class="card-image">
					<img src="images/classic-edition.png">
					<div class="white-text card-title center-align">Classic Edition</div>
				</div>		
			</div>
			<!-- Classic Edition Ends Here -->
		</div>
	</div>
</section>

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
