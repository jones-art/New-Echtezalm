<?php $page='webshop'; include 'head.php' ?>
<style>
/*@media screen and (max-width: 767px) {*/
/*@media only screen and (max-width: 601px) {*/
/*
  .carousel-fixed-item h4 {
    line-height:30px;
      width: 90%;
  }
}
*/
@media only screen and (min-width: 767px) {
  h4 {
    width: 75%;
    line-height:0px;
  }
}
</style>
<?php 
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
?>
<section >
	<div class="carousel carousel-slider center" style="height: 570px;">
    <div class="carousel-fixed-item center">	

      <h4>Gezond leven begint hier met Nutritious Salmons die speciaal voor jou zijn gemaakt</h4>
        <div style="margin-top: 76px; margin-bottom: 157px;" data-aos="flip-right" data-aos-duration="1000">
          <!-- <a class="btn planbtn2">Get Started</a> -->
        <a class="btn planbtn">Winkel nu</a>
        
            </div>
    </div>
    <div class="carousel-item" style="background: url('images/webshop_banner.png');">
  
    </div>
   
  </div>
</section>

<!-- Webshop Section Starts -->
<section >

	<div class="container"  style="margin-top: 23px;">>
		<h5 class="center">Bekijk onze WebShop</h5>
		<p class="white-text center">Hier kunt u uw verse gerookte zalm bestellen</p>
	<div class="row" style="margin-top:72px">
		<?php 
  include 'includes/connection.php';
			if (isset($_GET['pageno'])) {
			    $pageno = $_GET['pageno'];
			} else {
			    $pageno = 1;
			}
            $no_of_records_per_page = 12;
            $offset = ($pageno-1) * $no_of_records_per_page;
          
          $s = $connect2db->query("SELECT COUNT(id) as proID FROM product");
          $total_row = $s->fetch()->proID;
          $total_page = ceil($total_row / $no_of_records_per_page);

          $getCollection = $connect2db->prepare("SELECT * FROM product LIMIT $offset, $no_of_records_per_page");
          $getCollection->execute();
          if ($getCollection->rowcount() > 0) {
            while ($row = $getCollection->fetch()) {
              $data = (($row->id*123456789*987)/789);
              $url = urlencode(base64_encode($data)); 
              
              ?>


		<div class="col s12 l3 m6" data-aos="flip-right" data-aos-duration="1000" style="margin-bottom:30px">
	      <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
	        <div class="card-image">
	          <img src="admin/product/<?php echo($row->image) ?>" style="margin-top:0px;width:100%;height:230px">
	        </div>
	        <div class="card-content" style="padding-bottom: 16px">
	        	<h6 class=" center"><a class="white-text" href="product_page_description.php?id=<?php echo $url ?>"><?php echo($row->prd_name) ?></a></h6>
	          	<h6 style="margin-bottom: 15px"> € <?php echo number_format($row->price, 2) ?></h6>
	          	<a id="<?php echo($row->id) ?>" class="webBtn center <?php isset($_SESSION['email']) ? print'addToCart': print 'localStorage'; ?>" style="cursor:pointer;">
	          		Voeg toe aan winkelkar
	          	</a>
	        </div>

	      </div>
		</div>
		<?php 
			}
		}
	?>

		<!--  -->
	</div>
		<!-- Third Row Ends Here -->
        
	</div>
    <!-- Pagination goes here-->
   <?php if($total_page >1){?>
      <ul class="pagination center" style="margin-top:54px;margin-bottom:47px">
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        	<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" >
        		<img src="images/icon/chevron_left.png" style="margin-right: 27px;">
        	</a>
        </li>
        <?php for($i=1; $i<=$total_page;$i++){?>
        <li class="waves-effect">
        	<a href="?pageno=<?php echo $i; ?>" class="white-text btn black"> <?php echo $i; ?></a>
        </li>
    <?php } ?>
        <li class="<?php if($pageno >= $total_page){ echo 'disabled'; } ?>">
        	<a href="<?php if($pageno >= $total_page){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">
        		<img src="images/icon/chevron_right.png" style="margin-left: 27px;">
        	</a>
        </li>
      </ul>
<?php }?>
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

// let catvalue = $('#cart').html();
// $('.add2cart').click(function(){
// 	alert(catvalue);	
// })


</script>

<script type="text/javascript">
	$('#addToCart').on('click', function(event){
		event.preventDefault();
		  	$('#addToCart').html('Loading...');
		  	let data = $('#product').serialize();
		  	$.ajax({
		  		type:"POST",
		  		data: data,
		  		dataType: 'text',
		  		success:function(data){
		  			let catvalue = $('#cart').html();
		  			catvalue = parseInt(catvalue);
		  			catvalue = catvalue+1;
		  			$('#cart').html(catvalue);
		  			// alert(data);

		  	$('#addToCart').html('Added to Cart');
		  	$('#addToCart').attr('disabled', true);
		  		}
		  	});
		  
	});

	// ############# Insert Product Into Local Storage
	

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
	$('.addToCart').on('click', function(){
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
<?php include 'script.php' ?>
