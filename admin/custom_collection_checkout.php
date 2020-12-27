<?php 
include 'head.php' ?>
<?php
	if (isset($_GET['id'])) {
		$data = urldecode(base64_decode($_GET['id']));
		$data = (($data/123456789/987)*789);
		include 'includes/connection.php';
		$getData = $connect2db->prepare("SELECT * FROM collection WHERE id = ? ");
		$getData->execute([$data]);
		$records = $getData->fetch();
	}
	if(isset($_POST['submit'])){
			$date=date('Y-m-d');
			$plan = $_POST['plan'];
			$month = $_POST['month'];
			$price = $_POST['price'];
			$myRandom = str_pad(rand(1,999999), 5, '0', STR_PAD_LEFT);
			$sub_total = $month * $price;
		// echo "<script> alert($month); </script>";
			$sql = $connect2db->prepare("SELECT id FROM subscriber WHERE user_id =? AND plan=? AND status=?");
			$sql->execute([$id,$plan,'Pending']);
			if($sql->rowcount() > 0){
				echo "<script> alert('You Already Subscribed for this Plan'); </script>";
			}else{
				$getData = $connect2db->prepare("INSERT INTO subscriber(order_id,status,payment_status,user_id,sub_date,plan,month,sub_total) VALUES(?,?,?,?,?,?,?,?,?)");
				$getData->execute([$myRandom,'Pending','Pending',$id,$date,$plan,$month, $sub_total]);
				if($getData){
					// $msg = 'You Successfully Suscribed to: '.$month.' month,'..' Subscription';
					for($i=1;$i<=$month;$i++){
						$insData = $connect2db->prepare("INSERT INTO sub_duration(sub_id,user,delv_date,delv_status) VALUES(?,?,?,?)");
						$insData ->execute([$myRandom,$id,'0000-00-00','Pending']);
					}
					echo "<script> alert('You Successfully Suscribed to for this Plan '); </script>";
					// $_SESSION['sub_month'] = $month;
					// $_SESSION['sub_plan'] = $plan;
					header('location:checkout.php?status=collection');
				}else{
					echo "<script> alert('Subscription Failed'); </script>";
				}
			}
	}
 ?>
<!-- Check out section -->
<section style="background:#1A1818">

	<div class="container">
		<div class="badge" style="height:100px"></div>
		<span>
			<a href="select_plan.php" style="color:#AD976E;"> <strong> < back</strong>  </a>
		</span>
		
		<div class="row" style="margin-top:29px">
			<div class="col l6 s12 m6 left-align" style="padding-left:0px">
				<img src="admin/collection/<?php echo($records->images)?>" class="responsive-img" style="margin-top:7px;width:100%;height:450px">
			</div>
			<div class="col l6 s12 m6">
				<div class="card" style="background:#3A3A3A;padding-left:20px;padding-top:20px;padding-bottom:23px">
					<div class="card-body">
						<h6 class="head-text"><?php echo($records->Coll_details)?></h6>
						<p class="sub-title"><?php echo($records->info_details)?> </p>
						<a href="<?php if (isset($_SESSION['email'])) {
                      echo 'select_plan.php';}else{echo 'login.php';}?>" style="margin-top:30px;margin-bottom:15px;color:#AD976E;font-weight:500">Change</a>
					</div>
				</div>
				<form method="POST">
				<div class="card" style="background:#3A3A3A;padding-left:20px;padding-top:20px;padding-bottom:7px">
					<div class="card-body">
						<h6 class="head-text">Subscription Duration</h6>
						<div class="row">
							<div class="col l4 m4 s4">
								<div class="accordian">
									<p> Number of Month</p>
									<span>
									 <a style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;cursor:pointer;" class="min">-</a>
                        <input type="text" name="month" id="month" readonly="true" class="white-text browser-default input" style="width:40px;height:40px;padding:5px;text-align:center;border-radius:5px" value="1" id="quantity">
                        <a style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;cursor:pointer;" class="add">+</a>
									</span>
								</div>
							</div>
							
							<div class="col l4 m4 s4">
								<div class="accordian">
									<input type="hidden" name="plan" value="<?php echo($records->id)?>">
									<input type="hidden" name="price" value="<?php echo($records->price)?>">
									<p> Monthly Price </p>
									<h5 class="white-text"> € <span id="coll_price"><?php echo($records->price)?></span></h5>
								</div>
							</div>
							<div class="col l4 m4 s4 center">
								<div class="accordian">
									<p> Sub Total</p>
									<h5 class="white-text"> € <span id="total_price"></span></h5>
								</div>
							</div>

							<button type="submit" name="submit" class="btn btn-primary" style="margin-top:10px;background:#AD976E;line-height:30px">Proceed to check out</button>
						</form>
							<!-- <details>
								<summary>Hello</summary>
								<h3>mmmmmmm</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</details> -->
						</div>
	<!-- END ########################## -->
					</div>
				</div>

			</div>
		</div>

		<div class="badge" style="height:182px"></div>

	</div>
</section>

<?php include ('footer.php'); ?>

<!-- Script goes from here -->
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card -->
<script type="text/javascript" src="js/flip.min.js"></script>
<?php include 'script.php' ?>
<script type="text/javascript">
	$(document).ready(function(){
		let month = parseInt($('#month').val());
		let price = parseInt($('#coll_price').html());
		// console.log(month);
		// console.log(price);
		let total_price = (month * price);
			$('#total_price').html(total_price);
		

		 $('.add').on('click', ()=>{
		    let quantity = $('#month').val();
		    quantity = parseInt(quantity);
		   	if (quantity<12) {
		   		 let value = quantity+1;
		    $('#month').val(value);

		    let total_price = (value * price);
			$('#total_price').html(total_price);
		   	}
		  });

		  $('.min').on('click', ()=>{
		    let quantity = $('#month').val();
		    quantity = parseInt(quantity);
		    if (quantity>1) {
		      let value = quantity-1;
		    $('#month').val(value);

		     let total_price = (value * price);
			$('#total_price').html(total_price);
		    }
		  });

		  $('#month').on('input', ()=>{
		  	let quantity = parseInt($('#month').val());
		  	let total_price = (quantity * price);
		  	$('#total_price').html(total_price);
		  })
	});
</script>
