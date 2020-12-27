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
	
if (isset($_POST['user']) && isset($_POST['prd_id'])) {
		ob_end_clean();
		$user_id = $_POST['user'];
		$id = $_POST['prd_id'];
		$order_id = "";

		$getOrderId = $connect2db->prepare("SELECT order_id FROM tbl_order WHERE user_id = ? AND payment_status = ?");
		$getOrderId->execute([$user_id, 'Pending']);

		if ($getOrderId->rowcount()>0) {
			$getId = $getOrderId->fetch();
			$order_id = $getId->order_id;
		}else{
			$order_id = rand(00000,99999);
			$payment_status = 'Pending';
			$date = date("Y-m-d");
			$createNewOrder = $connect2db->prepare("INSERT INTO tbl_order (order_id,user_id,payment_status,del_status,ord_date) VALUES (?,?,?,?,?) ");
			$createNewOrder->execute([$order_id, $user_id, $payment_status, $payment_status, $date]);
			
		}
		

		$getData = $connect2db->prepare("SELECT price FROM product WHERE id = ? ");
		$getData->execute([$id]);
		$records = $getData->fetch();
		$price = $records->price;

		$qty = 1;
		$order_date = date('Y-m-d');
		$status = 'Pending';
		$total = $price * $qty;
		$getPrv = $connect2db->prepare("SELECT  product_id, quantity FROM prd_order WHERE order_id = ? AND product_id = ? AND user_id = ?");
        $getPrv->execute([$order_id, $id, $user_id]);
        if($getPrv->rowcount() > 0){
            $list = $getPrv->fetch();
            $quantity = $list->quantity;
                 
            $newQty = ($quantity + $qty);
            echo $quantity." ".$newQty." ".$qty;
            $updPrd = $connect2db->prepare("UPDATE prd_order SET quantity = ? WHERE order_id = ? AND product_id = ? AND user_id = ? ");
            $updPrd->execute([$newQty, $order_id, $id, $user_id]);
//            echo $total;
//            ." ".$qty." ".$newQty." ".$order_id." ".$id;
            ($updPrd) ?
            print("<script>alert('Product Added to cart');</script>"):
            print("<script>alert('Error Adding Product');</script>");
        }else{

            $sql = "INSERT INTO prd_order (user_id,product_id,quantity,order_date,status,total_amount,order_id) VALUES (?, ?, ?, ?, ?, ?,?)";
            $createOrder = $connect2db->prepare($sql);
            $createOrder->execute([$user_id, $id, $qty, $order_date, $status, $total, $order_id]);
            ($createOrder) ?
            print("<script>alert('Product Added to cart');</script>"):
            print("<script>alert('Error Adding Product');</script>");
        }
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
  <nav class="red nav-center" role="navigation" style="height: 45px;">
    <div class="container-fluid " style="background: #F44336;margin-bottom: 5px;">
        <h4 class="navRed center" id="demo" style="margin-top:0px">  </h4>
    </div>
  </nav>
  <div id="output"></div>
</section>

<section >
    <div class="carousel carousel-slider" style="">
    <div class="carousel-fixed-item center">	

      <h5 class="text-flow"><?php echo $title ?></h5>
        <div style="" class="home-btn" >
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
				<div class="desc" style="margin-top: 33px;text-align:justify;">
					Deze traditioneel gerookte zalm is een bijzondere beleving van smaak en traditie. Een zalm die anders wordt gerookt dan de koud gerookte zalm die je kent van speciaalzaken of supermarkten. Deze zalm is anders, lekkerder en exclusief. De traditionele manier van roken en stomen houdt in dat de zalm op de huid wordt gerookt bij een temperatuur van 80 graden, waardoor zowel de structuur als de smaak van de zalm behouden blijft. Dit maakt de zalm tot een smakelijke, gezonde traktatie en een delicatesse van hoge kwaliteit voor iedereen die van sfeer en gezelligheid houdt; de Bourgondische manier van leven.
				</div>
			</div>

			<div class="col l6 m12 s12 right-align" data-aos='flip-left' data-aos-duration='1000' style="height:347px; margin-top: 59px;">
				<!-- <img src="images/description.png" class="responsive-img"> -->
				<iframe src="images/video/echtezalm.mp4" style="width:100%;height:347px;margin-top: 30px;border: 0px;" ></iframe>
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
					 <iframe src="images/video/black.mp4" style="width:100%;margin-top: 30px;border: 0px;" ></iframe>
<!--					<div class="white-text card-title center">Black Edition</div>-->
				</div>
			</div>
			<!-- Black Edition End Here -->

			<!-- Dutch Edition -->
			<div class="col l4 s12 m4 white-text card black" id="dutch">
				<div class="card-image">
					<iframe src="images/video/dutch.mp4" style="width:100%;margin-top: 30px;border: 0px;" ></iframe>
<!--					<div class="white-text card-title center-align">Dutch Edition</div>-->
				</div>
			</div>
			<!-- Dutch Edition End Here -->

			<!-- Classic Edition -->
			<div class="col l4 s12 m4 white-text card black" id="classic">
				<div class="card-image">
					<iframe src="images/video/classic.mp4" style="width:100%;margin-top: 30px;border: 0px;" ></iframe>
<!--					<div class="white-text card-title center-align">Classic Edition</div>-->
				</div>		
			</div>
			<!-- Classic Edition Ends Here -->
		</div>
	</div>
</section>
<!-- collection section ends here -->
<!-- Webshop Section Starts -->
<section >
	<div class="container"  style="margin-top: 23px;">>
		<h5 class="center">Bekijk onze WebShop</h5>
		<p class="white-text center">Hier kunt u uw verse gerookte zalm bestellen</p>
		<!-- Second Row Ends Here -->

	<div class="row" style="margin-top: 60px;">
        		<?php 
  include 'includes/connection.php';
          $getCollection = $connect2db->prepare("SELECT * FROM product ORDER BY RAND() LIMIT 0,4 ");
          $getCollection->execute();
          if ($getCollection->rowcount() > 0) {
            while ($row = $getCollection->fetch()) {
              $data = (($row->id*123456789*987)/789);
              $url = urlencode(base64_encode($data)); ?>


		<div class="col s12 l3 m6" data-aos="flip-right" data-aos-duration="1000" style="margin-bottom:30px">
	      <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
	        <div class="card-image">
	          <img src="admin/product/<?php echo($row->image) ?>" style="margin-top:0px;width:100%;height:230px">
	        </div>
	        <div class="card-content" style="padding-bottom: 16px">
	        	<h6 class=" center"><a class="white-text" href="product_page_description.php?id=<?php echo $url ?>"><?php echo($row->prd_name) ?></a></h6>
	          	<h6 style="margin-bottom: 15px"> € <?php echo number_format($row->price, 2) ?></h6>
	          	<a id="<?php echo($row->id) ?>" class="webBtn center <?php isset($_SESSION['email']) ? print'webshop': print 'localStorage'; ?>" style="cursor:pointer;">
	          		Voeg toe aan winkelkar
	          	</a>
	        </div>

	      </div>
		</div>
		<?php 
			}
		}
	?>
		
    </div>
		<!-- Third Row Ends Here -->
        
	</div>
    <!-- Pagination goes here-->

    <div style="margin-right: 95px; margin-left: 95px;"><hr style="width:100%; "></div>
    <!--Pagination ends here-->
	
</section>
<!-- Webshop ends here -->

<!-- How to use Section Starts -->
<section style="margin-top: 72px">
	<div class="container red" style="margin-top:27px"></div>
	<div class="container">
		<h5 class="center">Eenvoudige abonnementsgids</h5>
		<p class="white-text center">Inschrijven was nog nooit zo eenvoudig</p>
		  <div class="row"  data-aos="zoom-out" data-aos-duration="1000">
            <div class="col s12 l3 m6">
              <div class="center promo promo-example">
                <img src="images/icon/open.png"/>
                <h5 class="promo-caption">Inschrijven</h5>
                <hr class="hr">
                <p class="light center">Registreer om toegang te krijgen tot meer vanaf onze website</p>
              </div>
          </div>

            <div class="col s12 l3 m6">
              <div class="center promo promo-example">
                <img src="images/icon/sushi.png"/>
                <h5 class="promo-caption">Selecteer een collectie</h5>
                <hr class="hr">
                <p class="light center">We hebben een geweldige collectie zalmvissen, we hebben iets voor je</p>
              </div>
          </div>

            <div class="col s12 l3 m6">
              <div class="center promo promo-example">
               <img src="images/icon/fish.png"/>
                <h5 class="promo-caption">Verse salmons</h5>
                <hr class="hr">
                <p class="light center">We zorgen ervoor dat we alleen de meest verse salmons voor u leveren</p>
              </div>
          </div>

            <div class="col s12 l3 m6">
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
  <?php 
  include 'includes/connection.php';
  
  // $getReview = $connect2db->prepare("SELECT * FROM review ORDER BY RAND() LIMIT 1 ");
  $getReview = $connect2db->prepare("SELECT r.id as reviewID, r.user_id,r.rating,r.title,r.prd_id,r.status,r.message,r.created,u.fname,u.lname,u.id,p.id,p.prd_name,p.image,c.Coll_details,c.images FROM review as r INNER JOIN users as u ON r.user_id=u.id INNER JOIN product as p ON p.id=r.prd_id INNER JOIN collection as c ON r.prd_id=c.id ORDER BY RAND() LIMIT 1");
  $getReview->execute();
  if ($getReview->rowcount() > 0) {
        $rev = $getReview->fetch();?>
         <div class="center">
         	<?php
              for($i=1;$i<=$rev->rating;$i++){
                  echo "<img src='images/icon/star.png'>";
                }
              ?>
<!--             <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png">
            <img src="images/icon/star.png"> -->
          </div>
		<p class="white-text center" style="margin-bottom:23px"><?php echo $rev->title;?>.</p>
		<div class="container">
			<p class="center text-flow" style="color:#E8E8E8;"> <?php echo $rev->message;?>.</p>
		</div>

		<div class="container">
			<h6 class="white-text center"><?php echo $rev->fname.' '. $rev->lname;?>.</h6>
		</div>

	<?php } ?>
			<!-- Blog coloums Ends Here -->
			<div class="container" style="height:45px"></div>
	</div>
</section>
<!-- Customer comment ends here -->


<div style="margin:0px;position:fixed;bottom:5%;right:0px;position:fixed;z-index: 10000;">
  <a class="btn-floating chat btn-large white <?php (isset($_SESSION['id']))?print 'modal-trigger':print''?>" style="border-radius: 40px 0px 0px 40px;padding:15px;width:76px;height:78px" href="<?php (isset($_SESSION['id']))?print '#chat-modal':print'login.php'?>">
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
	

</script>

<script>
<?php if (isset($_SESSION['id'])) {
	$getDate = $connect2db->prepare("SELECT delv_date FROM delivery WHERE user_id =? AND status = ? ");
	$getDate->execute([$id, 'Processing']);
    $delDate = "";
//    echo "<script>alert('".$delDate."');</script>";
    if($getDate->rowcount()>0){
	$getDelDate = $getDate->fetch();
	$delDate = $getDelDate->delv_date;
	} else{
        $delDate = '0';
    }
    
}
	?>
// Set the date we're counting down to
let date = <?php echo "'$delDate'"; ?>;
//alert(date);
if(date==0){
    document.getElementById("demo").innerHTML = 'No Active Order'
}else{
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
    }
    
</script>

<script>
    $('.localStorage').each(function(){
		let items = []
		$(this).on('click', function(){
			let prd_id = $(this).attr('id');
			let qty = 1;
			if (typeof(Storage !== 'undefined')) {
				let item = {
					id: prd_id,
					qty: qty
				};
				if (JSON.parse(localStorage.getItem('items')) === null) {
					items.push(item);
					localStorage.setItem('items', JSON.stringify(items))
					$(this).val("Added To Cart")
					window.location.reload();
				}else{
					const localItem = JSON.parse(localStorage.getItem('items'));
					localItem.map(data=>{
						if (item.id == data.id) {
							item.qty = data.qty + 1;
						} else{
							items.push(data);	
						}
					});

					items.push(item);
					// console.log(items)
					localStorage.setItem('items', JSON.stringify(items));
					window.location.reload();
				}
			}
		});
	});

	<?php if (isset($_SESSION['id'])) {?>
	$('.webshop').on('click', function(){
         $(this).html('Added to Cart');
         $(this).attr('disabled', true);
		let prd_id = $(this).attr('id');
		let user = <?php echo $_SESSION['id']; ?>;
		$.ajax({
			type:"POST",
		  		data: {prd_id:prd_id, user:user},
		  		dataType: 'text',
		  		success:function(data){
		  			let catvalue = $('#cart').html();
		  			catvalue = parseInt(catvalue);
		  			catvalue = catvalue+1;
		  			$('#cart').html(catvalue);
		  			// alert(data);
		  		}
		});
        

	});
<?php } ?>
    </script>

