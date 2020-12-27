<?php include 'head.php' ?>
<?php
	if (isset($_GET['id'])) {
		$data = urldecode(base64_decode($_GET['id']));
		$data = (($data/123456789/987)*789);
		include 'includes/connection.php';
		$getData = $connect2db->prepare("SELECT * FROM product WHERE id = ? ");
		$getData->execute([$data]);
		$records = $getData->fetch();
		$id = $records->id;
		$price = $records->price;

	}

	if (isset($_POST['quantity'])) {
		ob_end_clean();

		$user_id = $_SESSION['id'];
		$qty = $_POST['quantity'];
		$order_date = date('Y-m-d');
		$status = 'Pending';
		$total = $price * $qty;

		$getOrderId = $connect2db->prepare("SELECT order_id FROM tbl_order WHERE user_id = ? AND payment_status = ?");
		$getOrderId->execute([$user_id, $status]);

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

		$sql = "INSERT INTO prd_order (user_id,product_id,quantity,order_date,status,total_amount,order_id) VALUES (?, ?, ?, ?, ?, ?,?)";
		$createOrder = $connect2db->prepare($sql);
		$createOrder->execute([$user_id, $id, $qty, $order_date, $status, $total, $order_id]);
		($createOrder) ?
		print("<script>alert('Product Added to cart');</script>"):
		print("<script>alert('Error Adding Product');</script>");
	}
 ?>
<!-- Description Section Start -->
<section style="padding-top: 59px;">
	<div class="container">
		<div class="row">
			<div class="col l6 m12 s12 left-align" data-aos='flip-left' data-aos-duration='1000' style="margin-top: 8px;">
				<img src="admin/product/<?php echo $records->image ?>" class="responsive-img materialboxed" style="height:350px;width:400px">
				<div class="row">
					<div class="col l4 s4 m4">
						<img src="admin/product/<?php echo $records->image ?>" class="responsive-img materialboxed" style="margin-top:0px;padding-top:0px">
					</div>
					<div class="col l4 s4 m4">
						<img src="admin/product/<?php echo $records->image ?>" class="responsive-img materialboxed" style="margin-top:0px;padding-top:0px">
					</div>
					<div class="col l4 s4 m4">
						<img src="admin/product/<?php echo $records->image ?>" class="responsive-img materialboxed" style="margin-top:0px;padding-top:0px">
					</div>
				</div>
			</div>

			<div class="col l6 s12 m12 white-text" data-aos='flip-right' data-aos-duration='1000' style="margin-top: 59px;">
				<h6><?php echo $records->prd_name?></h6>
				<ul class="desc" style="margin-top: 33px; margin-right: 30px">
					<?php echo $records->highlight?>
				</ul>

				<div class="card" style="background-color:transparent;margin-top: 67px">
					<h5>€ <?php echo $records->price;?></h5>
					  <div class="row">
					    <form class="col s12" id="product">
					      <div class="row">
					        <div class="input-field col s12 l4">
					           <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;" class="min" type="button">-</button>
                        <input type="text" name="quantity" id="quantity" readonly="true" class="white-text browser-default input" style="width:40px;height:40px;padding:5px;text-align:center;border-radius:5px" value="1" >
                        <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;" class="add" type="button">+</button>
					        </div>
					        <div class="input-field col s12 l8">
					          <button type="button" name="addToCart" id="addToCart" style="width:198px;height:40px;background-color:#AD976E;color:#fff;border:solid 1px #AD976E"> 
											 Add to cart</button>
					        </div>
					      </div>
					  </form>
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
                      echo 'product_page_review.php?id=1';}else{echo 'login.php';}?>"class="webShpBtn center" >Reviews</a>
          </div>
          <p class="left-align">
          	<?php echo $records->description?>
			</p>
        </div>
      </div>
    </div>
  </div>

	</div>
</section>

<!-- Description Section End -->
<!-- Webshop Section Starts -->
<section >
	<div class="container"  style="margin-top: 83px;">>
		<h5 class="center">Bekijk onze WebShop</h5>
		<p class="white-text center">Hier kunt u uw verse gerookte zalm bestellen</p>
		<!-- Second Row Ends Here -->

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
		<!-- Third Row Ends Here -->
        
	</div>
    <!-- Pagination goes here-->
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
    <!--Pagination ends here-->
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


		 $('.add').on('click', ()=>{
		    let quantity = $('#quantity').val();
		    quantity = parseInt(quantity);
		   	if (quantity<20) {
		   		 let value = quantity+1;
		    	$('#quantity').val(value);
		   	}
		  });

		  $('.min').on('click', ()=>{
		    let quantity = $('#quantity').val();
		    quantity = parseInt(quantity);
		    if (quantity>1) {
		      let value = quantity-1;
		      $('#quantity').val(value);		 
		    }

		  });
</script>
<script type="text/javascript">
	$('#addToCart').on('click', function(event){
		event.preventDefault();
		  	$('#addToCart').html('Loading...');
		  	let data = $('#product').serialize();
		  	alert(data);
		  	$.ajax({
		  		type:"POST",
		  		data: data,
		  		dataType: 'text',
		  		success:function(data){
		  			let catvalue = $('#cart').html();
		  			catvalue = parseInt(catvalue);
		  			catvalue = catvalue+1;
		  			$('#cart').html(catvalue);
		  			console.log(data);

		  	$('#addToCart').html('Added to Cart');
		  	$('#addToCart').attr('disabled', true);
		  		}
		  	});
		  
	})

</script>
<?php include 'script.php' ?>
