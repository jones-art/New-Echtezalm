<?php 
session_start();
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
	
			$data = json_decode($_POST['localdata']);
			foreach ($data as $item) {
				$mydata = $item;
				$prd = $mydata->id;
				$qty = $mydata->qty;
				$getPrice = $connect2db->prepare("SELECT price FROM product WHERE id = ?");
				$getPrice->execute([$prd]);
				$price = $getPrice->fetch();

				$total = ($price->price * $qty);
				$insertLD = $connect2db->prepare("INSERT INTO prd_order(user_id,product_id,quantity,order_date,status,total_amount)VALUES(?,?,?,?,?,?)");
				$insertLD->execute([$id, $prd, $qty, $date, 'Pending', $total]);
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


