<?php $page = 'home'; include 'head.php'; ?>
<!-- Red Navbar -->
<?php
	include 'includes/connection.php';
	$getDetails = $connect2db->prepare("SELECT * FROM pages WHERE page_name = ? AND status = ?");
	$getDetails->execute([$page, 1]);
	if ($getDetails->rowcount()>0) {
		$data = $getDetails->fetch();

		$title = $data->page_title;
		$slider1 = 'admin/'.$data->file1;
		$slider2 = 'admin/'.$data->file2;
		$slider3 = 'admin/'.$data->file3;
	} else{

		$title = 'A Special Experience Of Taste And Tradition';
		$slider1 = 'images/slider/2.png';
		$slider2 = 'images/slider/2.png';
		$slider3 = 'images/slider/2.png';
	}

	if (isset($_POST['status']) && $_POST['status']=='stop') {
		$endChat = $connect2db->prepare("UPDATE chat SET status = 2 WHERE sender = '$id' OR receiver = '$id' ");
		$endChat->execute();
	}
	

	if (isset($_POST['message']) && !empty($_POST['message']) && $_POST['message'] !== " ") {
		ob_clean();
		$message = trim($_POST['message']);
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$sender = $_SESSION['id'];

		$sendMsg = $connect2db->prepare("INSERT INTO chat (sender,message,m_date,m_time) VALUES (?,?,?,?)");
		$sendMsg->execute([$sender, $message, $date, $time]);
		if ($sendMsg) {
			echo "Sent";
			exit();
		} else{
			echo "error";
			exit();
		}

		// // echo 'passed';
		// exit();
	}

	
?>

<style type="text/css">
	.sender{
		background-color:#fff;
		color:#3A3A3A;
		font-family: Poppins;
		font-style: normal;
		font-weight: normal;
		font-size: 15px;
		line-height: 19px;
		align-items: center;
		padding: 7px 20px 7px 20px; 
		margin:2px 20px 0px 20px;
		border-radius:10px 0px 10px 10px;
	}
	.admin{
		font-family: Poppins;
		font-style: normal;
		font-weight: normal;
		font-size: 13px;
		line-height: 19px;
		border: 1px solid #FFFFFF;
		box-sizing: border-box;
		border-radius: 0px 10px 10px 10px;
		padding: 7px 20px 10px 20px;
		margin:2px 46px 0px 10px;
		color:#fff;
			}
</style>
<section>
  <nav class="black nav-center" role="navigation" style="height: 45px;">
    <div class="nav-wrapper menu container-fluid " style="background: #F44336;margin-bottom: 5px;">
    	<h4 class="navRed center" id="demo">  </h4>
    </div>
  </nav>
  <div id="output"></div>
</section>

<section >
	<div class="carousel carousel-slider" style="height: 658px;">
    <div class="carousel-fixed-item center">	

      <h5 data-aos="flip-up" data-aos-duration="2000"><?php echo $title ?></h5>
        <div style="margin-top: 76px; margin-bottom: 157px;" data-aos="flip-right" data-aos-duration="1000">
          <a class="btn planbtn2" href="webshop.php">Get Started</a>
        <a class="btn planbtn" href="collection.php">Collection</a>
        
    </div>
    </div>
    <!-- <div><a class="btn-floating white"><i class="material-icons black-text">add</i></a></div> -->
    <div class="carousel-item carousel-img" href="#one!" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(<?php echo($slider1);?>);">
  
    </div>
    
    <!-- <div class="carousel-item carousel-img  white-text" href="#three!" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(<?php// echo($slider2);?>);">
      
    </div>
    <div class="carousel-item carousel-img white-text" href="#four!" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(<?php //echo($slider3);?>);">
      
    </div> -->
  </div>
  
</section>

<!-- Carousel Section End -->

<!-- Description Section Start -->
<section style="padding-top: 59px;">
	<div class="container">
		<div class="row">
			<div class="col l6 s12 m12 white-text" data-aos='flip-right' data-aos-duration='1000' style="margin-top: 59px;">
				<h5>Echte zalm; een delicatesse of een mooi gelegenheidscadeau.</h5>
				<div class="desc" style="margin-top: 33px;margin-right:70px;text-align:justify;">
					Deze traditioneel gerookte zalm is een bijzondere beleving van smaak en traditie. Een zalm die anders wordt gerookt dan de koud gerookte zalm die je kent van speciaalzaken of supermarkten. Deze zalm is anders, lekkerder en exclusief. De traditionele manier van roken en stomen houdt in dat de zalm op de huid wordt gerookt bij een temperatuur van 80 graden, waardoor zowel de structuur als de smaak van de zalm behouden blijft. Dit maakt de zalm tot een smakelijke, gezonde traktatie en een delicatesse van hoge kwaliteit voor iedereen die van sfeer en gezelligheid houdt; de Bourgondische manier van leven.
				</div>
			</div>

			<div class="col l6 m12 s12 right-align" data-aos='flip-left' data-aos-duration='1000' style="height:347px; margin-top: 59px;">
				<!-- <img src="images/description.png" class="responsive-img"> -->
				<iframe src="images/intro.mp4" style="width:100%;height:347px;margin-top: 30px;border: 0px;" ></iframe>
			</div>
		</div>
	</div>
</section>

<!-- Description Section End -->

<!-- Collection Section Starts -->
<section style="margin-top: 72px;">
	<div class="container">
		<h5 class="center">Onze collectie</h5>
		<p class="white-text center">Onze exclusieve collectie speciaal voor jou</p>
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
<!-- collection section ends here -->
<!-- Webshop Section Starts -->
<section >
	<div class="container"  style="margin-top: 83px;">>
		<h5 class="center">Bekijk onze WebShop</h5>
		<p class="white-text center">Hier kunt u uw verse gerookte zalm bestellen</p>
	<div class="row" style="margin-top:72px">
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

	</div>
</section>
<!-- Webshop ends here -->

<!-- How to use Section Starts -->
<section style="margin-top: 72px">
	<div class="container red" style="margin-top:27px"></div>
	<div class="container">
		<h5 class="center">Eenvoudige abonnementsgids</h5>
		<p class="white-text center">Inschrijven was nog nooit zo eenvoudig</p>
		  <div class="row"  data-aos="zoom-out" data-aos-duration="1000">
            <div class="col s6 l3 m6">
              <div class="center promo promo-example">
                <img src="images/icon/open.png"/>
                <h5 class="promo-caption">Inschrijven</h5>
                <hr class="hr">
                <p class="light center">Registreer om toegang te krijgen tot meer vanaf onze website</p>
              </div>
          </div>

            <div class="col s6 l3 m6">
              <div class="center promo promo-example">
                <img src="images/icon/sushi.png"/>
                <h5 class="promo-caption">Selecteer een collectie</h5>
                <hr class="hr">
                <p class="light center">We hebben een geweldige collectie zalmvissen, we hebben iets voor je</p>
              </div>
          </div>

            <div class="col s6 l3 m6">
              <div class="center promo promo-example">
               <img src="images/icon/fish.png"/>
                <h5 class="promo-caption">Verse salmons</h5>
                <hr class="hr">
                <p class="light center">We zorgen ervoor dat we alleen de meest verse salmons voor u leveren</p>
              </div>
          </div>

            <div class="col s6 l3 m6">
              <div class="center promo promo-example">
                <img src="images/icon/ride.png"/>
                <h5 class="promo-caption">Laat uw doos bezorgen</h5>
                <hr class="hr">
                <p class="light center">Laat je maandelijkse Box van Echte thuisbezorgen</p>
              </div>
          </div>
			<!-- Webshop coloums Ends Here -->
		</div>
	</div>
</section>
<!-- How to use ends here -->

<!-- Client Comment Section Starts -->
<section style="margin-top: 72px;background:#3A3A3A;">
	<div class="container" style="height:27px"></div>
	<div class="container"  data-aos="zoom-in" data-aos-duration="1000">
		<h5 class="center">Wat onze klanten denken</h5>
         <div class="center">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
          </div>
		<p class="white-text center" style="margin-bottom:23px">My favourite place to make order</p>
		<div class="container">
			<p class="center" style="color:#E8E8E8;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar arcu non a, fringilla mi donec vulputate. Quis in dignissim ac risus. Amet purus gravida massa venenatis. Diam viverra malesuada lacus, ante sed pharetra. Vitae cum ornare metus, vel, pharetra morbi eget vel.
			Massa sapien sed scelerisque ullamcorper ante id aliquam tortor et. Lectus mollis non vel quis eget mus.</p>
		</div>

		<div class="container">
			<h6 class="white-text center">Username</h6>
		</div>
			<!-- Blog coloums Ends Here -->
			<div class="container" style="height:77px"></div>
	</div>
</section>
<!-- Customer comment ends here -->

<!-- Blog Section Starts -->
<!-- <section style="margin-top: 72px;background:#0f0f0f">
	<div class="container">
		<h5>Blog</h5>
		<p class="white-text" style="margin-bottom:23px">Bekijk meer geweldige inhoud van ons</p>
		<div class="row"  data-aos="flip-left" data-aos-duration="1000">
	      <div class="col s12 l6 m6">
	          <div class="row">
	            <div class="col m2 center blogCol black">
	              <h5 class="bh6">20</h5>
	              <h6 class="bh6" style="margin-top:0px">AUG</h6>
	            </div>
	            <div class="col m10 ">
	                <p class="grey-text text-lighten-5 text-center">
	                44 gezondheidsvoordelen van het eten van zalm met Bruine rijst en het recept en de beste koks die er zijn.</p>
	            </div>
	          </div>     
	      </div>

	      <div class="col s12 l6 m6">
	          <div class="row">
	            <div class="col m2 center blogCol black">
	              <h5 class="bh6">20</h5>
	              <h6 class="bh6" style="margin-top:0px">AUG</h6>
	            </div>
	            <div class="col m10 ">
	                <p class="grey-text text-lighten-5 text-center">
	                44 gezondheidsvoordelen van het eten van zalm met Bruine rijst en het recept en de beste koks die er zijn.</p>
	            </div>
	          </div>     
	      </div>

	      <div class="col s12 l6 m6">
	          <div class="row">
	            <div class="col m2 center blogCol black">
	              <h5 class="bh6">20</h5>
	              <h6 class="bh6" style="margin-top:0px">AUG</h6>
	            </div>
	            <div class="col m10 ">
	                <p class="grey-text text-lighten-5 text-center">
	                44 gezondheidsvoordelen van het eten van zalm met Bruine rijst en het recept en de beste koks die er zijn.</p>
	            </div>
	          </div>     
	      </div>

	      <div class="col s12 l6 m6">
	          <div class="row">
	            <div class="col m2 center blogCol black">
	              <h5 class="bh6">20</h5>
	              <h6 class="bh6" style="margin-top:0px">AUG</h6>
	            </div>
	            <div class="col m10 ">
	                <p class="grey-text text-lighten-5 text-center">
	                44 gezondheidsvoordelen van het eten van zalm met Bruine rijst en het recept en de beste koks die er zijn.</p>
	            </div>
	          </div>     
	      </div>

	      <div class="col s12 l6 m6">
	          <div class="row">
	            <div class="col m2 center blogCol black">
	              <h5 class="bh6">20</h5>
	              <h6 class="bh6" style="margin-top:0px">AUG</h6>
	            </div>
	            <div class="col m10 ">
	                <p class="grey-text text-lighten-5 text-center">
	                44 gezondheidsvoordelen van het eten van zalm met Bruine rijst en het recept en de beste koks die er zijn.</p>
	            </div>
	          </div>     
	      </div>

	      <div class="col s12 l6 m6">
	          <div class="row">
	            <div class="col m2 center blogCol black">
	              <h5 class="bh6">20</h5>
	              <h6 class="bh6" style="margin-top:0px">AUG</h6>
	            </div>
	            <div class="col m10 ">
	                <p class="grey-text text-lighten-5 text-center">
	                44 gezondheidsvoordelen van het eten van zalm met Bruine rijst en het recept en de beste koks die er zijn.</p>
	            </div>
	          </div>     
	      </div>
		</div>
	</div>
</section>
 -->

<div style="margin:0px;position:fixed;bottom:5%;right:0px;position:absolute;z-index: 10000;">
  <a class="btn-floating chat btn-large white modal-trigger" style="border-radius: 40px 0px 0px 40px;padding:15px;width:76px;height:78px" href="<?php (isset($_SESSION['id']))?print '#chat-modal':print'login.php'?>">
    <img src="images/icon/live-chat.png" class="responsive-img" style="margin-left:3px;margin-top: 5px;">
  </a>
  <a class="btn-floating stop btn-large white modal-close" style="border-radius: 40px 0px 0px 40px;padding:15px;width:76px;height:78px;display:none;" href="#!">
    <img src="images/icon/close.png" class="responsive-img" style="margin-left:3px;margin-top: 5px;">
  </a>
</div>


  <div id="chat-modal" class="modal" style="width:331px;height:454px;background-color:#3A3A3A;position:fixed;right:1px">
  	<div class="modal-header center" style="background-color:#AD976E;color:white;position:fixed;top:0px;width:100%">
  		<h6 class="center" style="margin-bottom:0px;padding-bottom:0px;">Echte Zalm Support</h6>
  		<p class="center" style="margin-top:0px;padding-top:0px;margin-bottom:0px;padding-bottom:8px;">How can we help you?</p>
  	</div>
    <div class="modal-content"><br><br>
      <p class="center" style="padding-top:11px"><?php echo date('F d')?></p>
      <div id="chat" style="display:flex;overflow-y:scroll;height:250px;flex-direction:column-reverse;" ></div>
    </div>
    <div class="modal-footer" style="bottom:0px;background-color:#3A3A3A;position:fixed;">
      <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="close"></a> -->
      <hr>
      <div class="row">
      	<div class="col s9">
      		<form id="message">
	      		<input type="text" id="msg" class="browser-default" style="width:100%;height:40px;border:0px;color:#a7a7a7;background-color:#3A3A3A;outline-style:none;" name="message" placeholder="Type a Message Here">
	      		<!-- <input type="submit" name=""> -->
	      </div>

      	<div class="col s3" style="padding-top:12px;padding-left:1px;">
      		<img src="images/icon/camera.png">
      	</div>

      	</form>
      </div>
    </div>
  </div>
<!-- Blog post ends here -->


<?php include ('footer.php'); ?>

<script type="text/javascript">

	$(document).on('keypress', function(event){
		if (event.key === "Enter") {
			event.preventDefault();
			let data = $('#message').serialize();
			if ($('#msg').val() !="" && $('#msg').val() !=" ") {
				$.ajax({
			    type:'POST',
	            data: data,
	            success:function(data){
	                // alert(data);
	                $('#message')[0].reset();
	            }
	        });
			}
		}
	});
	
	function getChat(){
            $.ajax({
                method:'POST',
                url:'getchat.php',
                success:function(data){
                    $('#chat').html(data);
                    // alert(data)
                }
            });
        }
setInterval(getChat,3000);
	// let start = null;
	$('.chat').on('click', function(){
		start = event.timeStamp/1000;
		console.log(start);
		$(this).hide();
		$('.modal').show();
		$('.stop').show();
	});
	$('.stop').on('click', function(){
		$.ajax({
			type:'POST',
			data:{status:'stop'},
			success:function(data){
				$('.stop').hide();
				$('.modal').hide();
				$('.chat').show();
			}
		})
		
	})
	// 		var timer;
	// var timerStart;
	// var timeSpentOnSite = getTimeSpentOnSite();

	// function getTimeSpentOnSite(){
	//     timeSpentOnSite = parseInt(localStorage.getItem('timeSpentOnSite'));
	//     timeSpentOnSite = isNaN(timeSpentOnSite) ? 0 : timeSpentOnSite;
	//     return timeSpentOnSite;
	// }

	// function startCounting(){
	//     timerStart = Date.now();
	//     timer = setInterval(function(){
	//         timeSpentOnSite = getTimeSpentOnSite()+(Date.now()-timerStart);
	//         localStorage.setItem('timeSpentOnSite',timeSpentOnSite);
	//         timerStart = parseInt(Date.now());
	//         // Convert to seconds
	//         console.log(parseInt(timeSpentOnSite/1000));
	//         $('#output').html(parseInt(timeSpentOnSite/1000))
	//     },1000);
	// }
	// // startCounting();
	// });

	// $('.stop').on('click', function(){
	// 	let stop = (event.timeStamp/1000) ;
	// 	console.log(stop);
	// 	console.log(Number(stop) - Number(start))
	// })

</script>

<script>
<?php if (isset($_SESSION['id'])) {
	$getDate = $connect2db->prepare("SELECT del_date FROM tbl_order WHERE user_id =? AND del_status = ? ");
	$getDate->execute([$id, 'Processing']);
	$getDelDate = $getDate->fetch();
	$delDate = $getDelDate->del_date;
	
	} ?>
// Set the date we're counting down to
let date = <?php echo "'$delDate'"; ?>;
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
  document.getElementById("demo").innerHTML = days + "d: " + hours + "h: "
  + minutes + "m: " + seconds + "s till next shipping";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

