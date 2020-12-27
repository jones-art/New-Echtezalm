<footer class="container-fluid" style="background: black; color: white;">
	<div class="container" style="height:20px"></div>
<div class="container">
		<div class="row">
		<div class="col l3 s12 m6">
			<h4 style="font-family:playfair" class="text-white font-weight-bold left-align" style="width:240px;">Verbind je met ons</h4>
			<img src="images/icon/arrow-right.png">
		</div>
		<div class="col l3 s12 m6" >
		<h4 style="font-family:playfair" class="text-white font-weight-bold left-align" style="width:230px">Sitemap</h4>
    <div style="width:178px">
      <p><a href="index.php" class="text-muted"> Huis</a> </p>
      <p><a href="webshop.php" class="text-muted"> Online winkel</a> </p>
      <p><a href="" class="text-muted"> Voor zaken</a> </pp>
      <p><a href="aboutUs.php" class="text-muted"> Over ons</a> </p>
      <p><a href="blog.php" class="text-muted"> Blog</a> </p>
      <p><a href="" class="text-muted"> Betalen</a> </p>
      <p><a href="profile.php" class="text-muted"> Mijn rekening</a> </p>
      <p><a href="cart.php" class="text-muted"> Winkelmand</a> </p>   
    </div>

	</div>
	<div class="col l3 s12 m6" >
			<h4 style="font-family:playfair;text-align:left;" class="text-white font-weight-bold" style="width:122px">Blog</h4>
			<p class="text-muted">Lancering van nieuwe website</p>
		</div>
	<div class="col l3 s12 m6">
			<h4 style="font-family:playfair" class="text-white left-align font-weight-bold" style="width:230px">Social media</h4>
			<div>
				<img src="images/icon/facebook.png"> &nbsp &nbsp
				<img src="images/icon/linkedin.png">
			</div>
		</div>
	</div>
</div>

<div class="container" style="height:89px"></div>
</footer>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card 
<script type="text/javascript" src="js/flip.min.js"></script>-->
<!-- RateYo -->
 <script src="js/rateyo.min.js"></script>
 <script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
</script> 


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

