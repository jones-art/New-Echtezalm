<?php include 'head.php';  ?>
<?php 
if(isset($_POST['user']) && isset($_POST['pass'])){

	$username = $_POST['user'];
	$password = md5($_POST['pass']);
	include 'includes/connection.php';

	//query data from database
	$stmt = $connect2db->prepare("SELECT  * FROM users WHERE  email=? AND password=?");
	$stmt->execute([$username, $password]);

	// checking user status
	if($stmt->rowcount() > 0){
		$row = $stmt->fetch();
		$_SESSION['email'] = $row->email;
		$_SESSION['id'] = $row->id;
		$_SESSION['fullname'] = $row->fname ." ". $row->lname;
		$_SESSION['role'] = $row->role;
		$inst = $connect2db->prepare("INSERT INTO tbl_activity(user_id,activity,time,date) VALUES(?,?,?,?)");
		$id = $_SESSION['id'];
		// date_default_timezone_set('West Africa/Nairobi');
		$timestamp = date('H:i:s');$date =date('Y-m-d');
		$inst->execute([$id,'logged in', $timestamp,$date]);

		if(isset($_POST['localdata']) && $_POST['localdata'] !== null){

			$getOrderId = $connect2db->prepare("SELECT order_id FROM tbl_order WHERE user_id = ? AND payment_status = ?");
			$getOrderId->execute([$id, 'Pending']);

			if ($getOrderId->rowcount()>0) {
				$getId = $getOrderId->fetch();
				$order_id = $getId->order_id;
			}else{
				$order_id = rand(00000,99999);
				$payment_status = 'Pending';
				$date = date("Y-m-d");
				$createNewOrder = $connect2db->prepare("INSERT INTO tbl_order (order_id,user_id,payment_status,del_status,ord_date) VALUES (?,?,?,?,?) ");
				$createNewOrder->execute([$order_id, $id, $payment_status, $payment_status, $date]);
				
			}
		
	
			$data = json_decode($_POST['localdata']);
			if ($data != "") {
				foreach ($data as $item) {
					$mydata = $item;
					$prd = $mydata->id;
					$qty = $mydata->qty;
					$getPrice = $connect2db->prepare("SELECT price FROM product WHERE id = ?");
					$getPrice->execute([$prd]);
					$price = $getPrice->fetch();

					$total = ($price->price * $qty);
					$insertLD = $connect2db->prepare("INSERT INTO prd_order(user_id,product_id,quantity,order_date,status,total_amount,order_id)VALUES(?,?,?,?,?,?,?)");
					$insertLD->execute([$id, $prd, $qty, $date, 'Pending', $total, $order_id]);
				}
			}
		}


		if (isset($_GET['page']) && $_GET['page']=='checkout') {
			echo "<script> alert('Welcome ". $row->fname."'); window.location='checkout.php';</script>";
			exit();
		} else{
			echo "<script> alert('Welcome ". $row->fname."'); window.location='index.php';</script>";
			exit();
		}

		
	}else{
		echo "<script> alert('Failed')</script>";
		exit();
	}
}
	
		
?>






<!-- Login Section -->
<section>
	<div class="form-back" data-aos="flip-down" data-aos-duration='2000'>
		<div class="white-text container">
			<h4> Welkom terug </h4>
			<div id="result"></div>
			<p class="center">Nieuw bij Echtezalm? <a href="register.php" style="color:#AD976E;">Registreer hier</a></p>
			<div class="container">
				
			<form class="container" id="loginForm" >
				<div class="row container">
					<div class="col s12 input-field">
						<input type="text" name="user" id="user" class="white-text browser-default input" placeholder="Username">
					</div>

					<div class="col s12 input-field">
						<label class="label-icon right" style="position:relative;left:0px;border-radius:0px;width:100%">
						<input type="password" name="pass"  class="white-text icon_prefix browser-default input" id="Psw" placeholder="Password">
					 <i onclick="passwordeyes()" class="material-icons prefix right"><img src="images/icon/eye.png" style="padding:0px;margin:0px;cursor:pointer;position:relative;right: 100%"></i></label>
					</div>

					<div class="col s12 input-field">
						<!-- <button type="submit" class="btn formbtn" value="Login" name="login" id="loginBtn">Login</button> -->
						<input type="button" class="btn formbtn" value="Login" name="login" id="loginBtn">
					</div>

					<div class="col s12">
						<p class="right" ><a href="register" style="color:#AD976E; padding-left: 20px;">Wachtwoord vergeten?</a></p>
						<p style="padding-top: 44px;">Door verder te gaan accepteert u onze 
						<br><a href="term-and-condition.php" style="color:#AD976E;">Gebruiksvoorwaarden en Privacybeleid.</a></p>
					</div>

					<div>
						
					</div>
				</div>			
			</form>

			</div>
		</div>
	</div>
	
</section>


<!-- <script type="text/javascript" src="https://cdn.jsdeliver.net/npm/sweetalert2@10"></script> -->
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card -->
<!-- <script type="text/javascript" src="js/flip.min.js"></script> -->


<script type="text/javascript">
	AOS.init();
	


</script>
<?php include 'script.php' ?>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
 <script>
	$(document).ready(function(){
		let localdata = "";
			if (JSON.parse(localStorage.getItem('items')) !== null) {
				localdata = localStorage.getItem('items');
			}
		$('#loginBtn').click(function(event){
			event.preventDefault();
			
			$('#loginBtn').val('Loading...');
			let values = $('#loginForm').serialize();
			let user = $('#user').val();
			let pass = $('#Psw').val();
			console.log(localdata);
			$.ajax({
				type: 'post',
				data: {user:user,pass:pass,localdata:localdata},
				dataType: 'text',
				success: function(response){
					$('#loginBtn').val('Login');
					$('#result').html(response);

					localStorage.clear();
					console.log(response)
;					$('#loginForm')[0].reset();
				},
				error: function(status){
					alert(status);
				}
			});
		});
	});

	function passwordeyes() {
    var x = document.getElementById("Psw").type;
    if(x=="password")
      document.getElementById("Psw").type="text";
    else
      document.getElementById("Psw").type="password";
}
</script> 
