<?php $page='about'; include 'head.php' ?>

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
	<div class="carousel carousel-slider center">
	    <div class="carousel-item about-img" href="#one!" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(<?php echo($banner);?>);">
	  		<h5><?php echo $title?></h5>
	    </div>
  </div>
</section>

<!-- Description Section Start -->
<section data-aos="flip-up" data-aos-duration="2000">
	<div class="container" style="margin-top:101px">
		<div class="row">
            <div class="col l6 m12 s12 right-align">
				<img src="images/about1.png" class="responsive-img" style="margin-top:0px">
			</div>
			<div class="col l6 s12 m12 white-text" style="padding-left:30px">
				<h5 style="text-align:left">Exclusive, traditionally smoked salmon.</h5>
                <p style="text-align:left;margin-top:30px">
				Deze traditioneel gerookte zalm is een bijzondere beleving van smaak en traditie. Een zalm die anders wordt gerookt dan de koud gerookte zalm die je kent van speciaalzaken of supermarkten. Deze zalm is anders, lekkerder en exclusief. De traditionele manier van roken en stomen houdt in dat de zalm op de huid wordt gerookt bij een temperatuur van 80 graden, waardoor zowel de structuur als de smaak van de zalm behouden blijft. Dit maakt de zalm tot een smakelijke, gezonde traktatie en een delicatesse van hoge kwaliteit voor iedereen die van sfeer en gezelligheid houdt; de Bourgondische manier van leven.
                </p>
			</div>


		</div>
	</div>
</section>
<!-- Description Section End -->
<!-- Description Section Start -->
<section data-aos="flip-up" data-aos-duration="2000">
	<div class="container" style="margin-top:120px">
		<div class="row">
			<div class="col l6 s12 m12 white-text" style="padding-right:55px">
				<h5 style="text-align:left;marging-top:126px">Exclusive, traditionally smoked salmon.</h5>
                <p style="text-align:left;margin-top:30px">
				Deze traditioneel gerookte zalm is een bijzondere beleving van smaak en traditie. Een zalm die anders wordt gerookt dan de koud gerookte zalm die je kent van speciaalzaken of supermarkten. Deze zalm is anders, lekkerder en exclusief. De traditionele manier van roken en stomen houdt in dat de zalm op de huid wordt gerookt bij een temperatuur van 80 graden, waardoor zowel de structuur als de smaak van de zalm behouden blijft. Dit maakt de zalm tot een smakelijke, gezonde traktatie en een delicatesse van hoge kwaliteit voor iedereen die van sfeer en gezelligheid houdt; de Bourgondische manier van leven.
                </p>
			</div>

			<div class="col l6 m12 s12 right-align">
				<img src="images/about2.png" class="responsive-img" style="margin-top:5px">
			</div>
		</div>
	</div>
</section>
<!-- Description Section End -->

                                                                    <!-- Description Section Start -->
<section data-aos="flip-up" data-aos-duration="2000">
	<div class="container" style="margin-top:150px;">
		<div class="row">
            <div class="col l6 m12 s12 right-align">
				<img src="images/about3.png" class="responsive-img" style="margin-top:0px">
			</div>
			<div class="col l6 s12 m12 white-text" style="padding-left:109px;padding-top:71px">
				<h5 style="text-align:left">Our process.</h5>
                <ul>
                    <li style="list-style:square;
                               margin-top:30px;font-family: Poppins;
                               font-size: 16px;
                               font-style: normal;
                               font-weight: 500;
                               line-height: 24px;
                               letter-spacing: 0.05em;
                               text-align: left;
                               list-style-image: url(images/icon/list-box.png);	
                               "> This traditionally smoked salmon is aexperience of taste and tradition. A salmon that is smoked differently than the cold smoked.</li>
                    <li style="list-style:square;
                               margin-top:30px;font-family: Poppins;
                               font-size: 16px;
                               font-style: normal;
                               font-weight: 500;
                               line-height: 24px;
                               letter-spacing: 0.05em;
                               text-align: left;
                               list-style-image: url(images/icon/list-box.png);
                               "> Salmon that you know from specialty shops or supermarkets. This salmon is different, tastier and exclusive. </li>
                    <li style="list-style:square;
                    			margin-top:30px;
                               font-family: Poppins;
                               font-size: 16px;
                               font-style: normal;
                               font-weight: 500;
                               line-height: 24px;
                               letter-spacing: 0.05em;
                               text-align: left;
                               list-style-image: url(images/icon/list-box.png);
                               "> Smoking and steaming means that the salmon is smoked on the skin at a  of 80 degrees, which preserves both the structure and the taste of the </li>
                </ul>
			</div>

		</div>
	</div>
</section>

<!-- Description Section End -->
<!-- Our Partners Section Starts -->
<section  style="margin-bottom:90px;background: #0F0F0F;">
    <hr  style="margin-top:0px">
	<div class="container center" style="margin-top:90px">
		<h5 class="center">Our Partners</h5>
		<div class="center" style="width: 100%">
      <h6 style="width:900px;font-family:Poppins;font-style:normal;font-weight:300;font-size:15px;line-height:22px;text-align:center;letter-spacing:0.05em;" class="center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Libero cras diam turpis amet amet sed molestie hendrerit malesuada. Tincidunt vulputate porta consectetur cum. Tempus cras fermentum bibendum tortor.</h6>
    </div>
	<div class="row" style="margin-top:60px">
        <?php
        include'includes/connection.php';
        $select = $connect2db->query("SELECT * FROM sponsors");
        while ($row = $select->fetch()) {
      ?>
		<div class="col s16 m4" >
	       <img src="<?php echo ('admin/'.$row ->file_name); ?>" style="margin-top: 0px">
		</div>
    <?php
        }
      
    ?>
<!-- 		<div class="col s4 l3 m4" data-aos="flip-right" data-aos-duration="1000">
	       <img src="images/partner/partner2.png" style="margin-top: 0px">
		</div>

		<div class="col s4 l3 m4" data-aos="flip-right" data-aos-duration="1000">
	       <img src="images/partner/partner3.png" style="margin-top: 0px">
		</div>

		<div class="col s4 l3 m4" data-aos="flip-right" data-aos-duration="1000">
	       <img src="images/partner/partner4.png" style="margin-top: 0px">
		</div>
        
		<div class="col s4 l3 m4" data-aos="flip-right" data-aos-duration="1000">
	       <img src="images/partner/partner5.png" style="margin-top: 70px">
		</div>

		<div class="col s4 l3 m4" data-aos="flip-right" data-aos-duration="1000">
	       <img src="images/partner/partner6.png" style="margin-top: 70px">
		</div>

		<div class="col s4 l3 m4" data-aos="flip-right" data-aos-duration="1000">
	       <img src="images/partner/partner7.png" style="margin-top:70px;margin-left:100px">
		</div>

		<div class="col s4 l3 m4" data-aos="flip-right" data-aos-duration="1000">
	       <img src="images/partner/partner8.png" style="margin-top: 70px">
		</div> -->
        
	</div>
	</div>
    <div class="container" style="height:90px;background: #0F0F0F"></div><hr style="margin-bottom:0px">
</section>
<!-- Our Partners ends here -->


<!-- Sign Up Section Starts -->
<section style="background: #0F0F0F;">
	<div class="container" style="">
		<div class="row" data-aos="flip-down" data-aos-duration="1000">
			<!-- Black Edition -->
			<div class="col l6 s12 m4 white-text" id="black" style="marging-right:62px">
                <h5 style="font-weight:400;font-size:28px;letter:5%;line-height:37.32px;text-align:left;color:#fff"> Sign Up now for our Discount product</h5>
			</div>
			<!-- Black Edition End Here -->

			<!-- Form section start -->
			<div class="col l6 s12 m4 white-text" id="dutch">
              <div class="row">
                    <div class="input-field col s6">
                        <input type="text" placeholder="Johndoe@gmail.com" id="first_name" class="validate txtScr browser-default" style="background: transparent; color: #fff; width:275px;height: 50px;border:solid 2px #ad976e; padding-left: 20px;">
                    </div>

                    <style type="text/css">
                    	.scbBtn{
    width: 198px;
    height: 50px;
 	background: #AD976E;
 	color: #fff;
  	margin-left: 26px;
    border:solid 2px #ad976e;
    font-family: 'Poppins';
    font-weight:500;
    font-size: 18px;
    line-height: 24px;
    margin-left: 20px;
 }
.scbBtn:hover{
 	background: rgba(255, 255, 255, 0.5);
 	color: #AD976E;
 }
                    </style>

                    <div class="input-field col s5" style="margin-left:20px">
                      <button class="scbBtn" type="submit">Subscribe</button>
                    </div>
                  </div>
				</div>
			</div>
			<!-- Form section -->

		</div>
	</div>
    <div class="container" style="height:35px;background: #0F0F0F"></div>
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
<script type="text/javascript">
	let singlemenu = "";
  const currentLocation = location.href;
  const menuItem = document.querySelectorAll('a');
  console.log(currentLocation);
  // console.log(menuItem);
  const menuLength = menuItem.length;
  for(let i in menuItem){
    if (menuItem[i]===currentLocation) {
      menuItem[i].className='active';
      
      console.log(currentLocation);
    }
    singlemenu = menuItem[i];
  }
  console.log(singlemenu)
</script>