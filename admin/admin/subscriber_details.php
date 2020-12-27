<?php 
    include 'header.php';
    include '../includes/connection.php';

?>
<?php
        require "/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php";
    
        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php';


		if (isset($_GET['order_id']) AND isset($_GET['user'])) { 
	


		$order_id = $_GET['order_id'];
		$user_id = $_GET['user'];
		$getInvoice = $connect2db->prepare("SELECT * from subscriber WHERE order_id = ? AND user_id = ?");
		$getInvoice->execute([$order_id, $user_id]);
		$data = $getInvoice->fetch();
		$invoice = $data->invoice;
		$date = $data->sub_date;
		$status = $data->status;
		$payType = $data->payment_type;
		$amount = $data->sub_total;
		$month = $data->month;
		$mntPrice =$amount/$month;
		$duration = $data->duration;
		$delv_date = $data->del_date;
		$plan = $data->plan;
		$del_date1 = $data->del_date;
		$dt = new DateTime($del_date1);

		$nxtDelv = $dt->format('M Y');

		if ($plan != 0) {
			$getCollection = $connect2db->prepare("SELECT Coll_details, info_details from collection WHERE id = ?");
			$getCollection->execute([$plan]);
			$collect = $getCollection->fetch();
			$collectionName = $collect->Coll_details;	
			$coll_infor = $collect->info_details;
		} else{
			$collectionName = 'Custom Collection';
			$coll_infor = 'Random Products Are Selected';
		}

		$shipping = $connect2db->prepare("SELECT * FROM shipping_details WHERE order_id = ? AND user_id = ?");
		$shipping->execute([$order_id, $user_id]);
		if ($shipping->rowcount() > 0) {
			$data = $shipping->fetch();
			$country = $data->country;
			$state = $data->state;
			$lga = $data->lga;
			$apartment = $data->apartment;
			$zcode = $data->zip_code;
		}else{
			$country = '---------';
			$state = '---------';
			$lga = '---------';
			$apartment = '---------';
			$zcode = '---------';
		}
		

		$user = $connect2db->prepare("SELECT fname,lname,email from users WHERE id = ?");
		$user->execute([$user_id]);
		$userdata = $user->fetch();
		$fname = $userdata->fname;
		$lname = $userdata->lname;
		$email = $userdata->email;

		$getTotal = $connect2db->prepare("SELECT sub_total  FROM subscriber WHERE user_id = ? AND order_id = ? ");
      $getTotal->execute([$user_id, $order_id]);
      $total = $getTotal->fetch();

      // Gettting number of deliveries made
      $getDelMade= $connect2db->prepare("SELECT sub_id, count(id) as made from sub_duration WHERE sub_id = ? AND user = ?  AND delv_status=?");
		$getDelMade->execute([$order_id, $user_id, 'Delivered']);
		$delMade = $getDelMade->fetch();
		$deleviriesMade= $delMade->made;	

      // Gettting number of deliveries left
      $getDelLeft= $connect2db->prepare("SELECT sub_id, count(id) as remain from sub_duration WHERE sub_id = ? AND user = ?  AND delv_status=?");
		$getDelLeft->execute([$order_id, $user_id, 'Pending']);
		$delLeft = $getDelLeft->fetch();
		$deleviriesLeft= $delLeft->remain;	


// Cancle plan
	if(isset($_POST['cancelPlan'])){
		$sql = $connect2db->query("SELECT sub_id, count(id) as user FROM sub_duration WHERE user='$user_id'");
		$cancelSub = $connect2db->prepare("UPDATE subscriber SET 
		      status='Cancelled' WHERE order_id=? AND user_id=?
		      ");
		if($cancelSub->execute([$order_id, $user_id])){
			echo "<script> alert('Subscription Cancelled');window.location='subscriber.php'; </script>";
			// header('location:subscriber_details.php?order_id='.$order_id.'&user='.$user);
		}else{
			echo "<script> alert('Unfinished'); </script>";
		}
	}

$pdfDoc = '<div style="background:#3A3A3A;color:#fff;padding:13px;"><div><img src="images/logo-white.png"></div>';

$pdfDoc .='<h4 style="padding-top:24px;font-style: normal;font-weight: 500;font-size: 22px;line-height: 33px;">Hello '.$fname." ".$lname.' </h4>';

$pdfDoc .= '<p style="padding-top:24px;font-style:normal;font-weight:300;font-size:22px;line-height:15px;"> Thank you for your order from EchteZalm. Your packaged has been processed and ready to be delivered to you. Your package would arrive between 1 - 2 days from now.
Your order confirmation is below, thanks again for Patronizing us.</p>';

$pdfDoc .='<h4 style="padding-top:24px;font-style:normal;font-weight:500;font-size:22px;line-height:33px;">Your Order #'.$order_id.' <span>('.$date.')</span></h4>';

$pdfDoc.='<table class="table table-striped">
	<tr><th colspan="2"><center>Shipping Address</center></th></tr>
	<tbody style="background:#3A3A3A;">
		<tr>
			<td colspan="2">'.$apartment.'<br>'.$lga.'<br>'.$state.'<br>'.$country.'</td>
		</tr>
	</tbody>
</table>';

$pdfDoc.='<table class="table table-striped">
	<tr><th colspan="2"><center>Payment Information</center></th></tr>
	<tbody style="background:#3A3A3A;">
		<tr><td>Payment Type</td><td>'.$payType.'</td></tr>
		<tr><td>Amount Paid</td><td>'.$amount.'</td></tr>
	</tbody>
</table>';

$pdfDoc.='<table class="table table-striped" >
	<tr><th colspan="2"><center>Item Ordered</center></th></tr>
	<tbody style="background:#3A3A3A;">
		<tr><td>Products</td><td>'.$collectionName .' </td></tr>
		<tr><td>Total Amount</td><td>'.$amount.'</td></tr>
	</tbody>
</table>
	</div>	
    ';


// Generating Invoice
if(isset($_POST['createInvoice'])){
        		
	 $file_name = md5(rand()) . '.pdf';

    $html_code = '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
    $html_code .= '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
    $html_code .= $pdfDoc;
    $pdf = new Dompdf();
    $pdf->getOptions()->setChroot('/var/www/html/admin/images/logo-white.png');
    $pdf->setPaper('letter');
    $pdf->loadHtml($html_code);
    $pdf->render();
    $file = $pdf->output();
    $file_location = "invoice/".$file_name;
    file_put_contents($file_location, $file);

		$mail = new PHPMailer();

//		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'younghallajinoni@gmail.com';				//Sets SMTP username
		$mail->Password = 'Muthorlib123';
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';

		$mail->isHTML(true);
		$mail->setFrom('mutolibsodiq2015@gmail.com', 'EchteZalm');
		$mail->addAddress($email);
		$mail->AddAttachment("invoice/".$file_name); 
		$mail->Subject = ("Invoice for Order ID:".$order_id);
		$mail->Body = "Download Invoice Attachment";

		if ($mail->send()) {
			$del_status = 'Processing';
			$invoice = 1;
			$del_date = date('Y-m-d H:i:s', strtotime("+48 hours"));

			$createNxtDlv = $connect2db->prepare("INSERT INTO delivery (user_id, order_id, delv_date, status, sub_type) VALUES (?,?,?,?,?)");
				$createNxtDlv->execute([$user_id,$order_id,$del_date,'processing','collection']);
				// echo "<script> alert('Updated Successfully');</script>";

			$update = $connect2db->prepare("UPDATE subscriber SET status = ?, invoice = ?, file = ?, del_date = ? WHERE user_id = ? AND order_id = ? ");
			$update->execute([$del_status, $invoice, $file_name, $del_date, $user_id, $order_id]);
			if ($update) {
				$invoiceDate = date('Y-M-d H:i:s');
				$insertInvoice = $connect2db->prepare("INSERT INTO invoice (user_id, order_id, invoice, created, inv_type) VALUES (?,?,?,?,?)");
				if ($insertInvoice->execute([$user_id, $order_id, $file_name, $date, 'collection'])) {
					echo("<script>alert('Invoice Successfully Created');</script>");
				}else{
					echo("<script>alert('Error Creating Invoice');</script>");
				}
				
			} else{
				echo("<script>alert('Error Updating Data');</script>");
			}
			
		} else{
			echo("<script>alert('Error Sending Invoice');</script>");
		}
		// echo "<script> alert('Invoiced'); </script>";
	}

// Confirming Orders
	if (isset($_GET['order_id']) AND isset($_GET['user']) AND isset($_GET['status'])) { 
		$statusID = $_GET['status'];
		$date = date('Y-M-d');
		$delv_status = 'Delivered';
		$updateDelStatus = $connect2db->prepare("UPDATE sub_duration SET
			delv_date = ?, delv_status = ? WHERE id=? AND user= ? AND sub_id = ? ");
		$updateDelStatus->execute([$date,$delv_status,$statusID,$user_id,$order_id]);
		if($updateDelStatus){
			// Get Pending Delivery
			$countPending= $connect2db->prepare("SELECT  count(id) as remain from sub_duration WHERE sub_id = ? AND user = ?  AND delv_status=?");
			$countPending->execute([$order_id, $user_id, 'Pending']);
			$fetchPending = $countPending->fetch();
			$totalPending= $fetchPending->remain;

			if ($totalPending > 0) {
				$del_date1 = strtotime($del_date1);
				$nxtDelvMnt =  date('Y-M-d H:i:s',strtotime("+1 month", $del_date1));
				$updateNxtDel= $connect2db->prepare("UPDATE subscriber SET del_date = ? WHERE user_id= ? AND order_id = ? ");
				$updateNxtDel->execute([$nxtDelvMnt,$user_id,$order_id]);

				$updNxtDel= $connect2db->prepare("UPDATE delivery SET delv_date = ? WHERE user_id= ? AND order_id = ? ");
				$updNxtDel->execute([$nxtDelvMnt,$user_id,$order_id]);



				// $createNxtDlv = $connect2db->prepare("INSERT INTO delivery (user_id, order_id, delv_date, status, sub_type) VALUES (?,?,?,?,?)");
				// $createNxtDlv->execute([$user_id,$order_id,$nxtDelvMnt,'processing','collection']);
				// echo "<script> alert('Updated Successfully');</script>";
			} else{
				$value = 'Expired';
				$updateNxtDel= $connect2db->prepare("UPDATE subscriber SET  status = ? WHERE user_id= ? AND order_id = ? ");
				$updateNxtDel->execute([$value, $user_id, $order_id]);
				echo "<script> alert('Updated Successfully');window.location='subscriber.php';</script>";

				$updNxtDel= $connect2db->prepare("UPDATE delivery SET status = ? WHERE user_id= ? AND order_id = ? ");
				$updNxtDel->execute([$value,$user_id,$order_id]);
			}
			
		}else{
			echo "<script> alert('Failed to Update'); </script>";
		}
		
	}

}

function randomSurfix($arg){
	if(!in_array(($arg % 100), array(11,12,13))){
		switch ($arg % 10) {
			case 1: return $arg.'st';
			case 2: return $arg.'nd';
			case 3: return $arg.'rd';
		}
	}
	return $arg.'th';
}


?>
<style type="text/css">
	button{
		width:154px;height:41px;
		color:#fff; background-color:#AD976E;border:0px;
	}
	button[disabled]{
		background-color:gray;
		color: #fff;
	}
	.button{
		width:154px;height:41px;
		color:#fff; background-color:#AD976E;border:0px;
	}
	.disabled{
		width:154px;height:41px;
		background-color:gray;
		color: #fff;
	}
</style>
<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
    	<div class="row" style="margin-top:80px">
    		<div class="col l8 m8 s12">
    			<h4 style="color:#fff" class="mb-5"> <?php echo $collectionName; ?></h4>
    		</div>
    		<?php 
    		if($status=='Pending' ||  $status=='Processing'){?>
    		<div class="col-lg-2 col-sm-12 col-md-2"><form method="POST">
    			<button type="submit" name="cancelPlan" style="background-color: #AD976E">Cancel Plan</button>
    		</div>

    		<div class="col-lg-2 col-sm-12 col-md-2">
    			<button type="submit" name="createInvoice" <?php if($invoice==1){echo 'disabled';}?> >Create Invoice</button></form>
    		</div>
    		<?php
    			}
    		?>
    	</div>

    	<div class="row">
        	<div class="col-xl-6">
        		<div class="card bg-transparent">
        			<!-- First Row  -->
        			<div class="row">
        				<div class="col-sm-12">
				          <div class="card" style="border: 1px solid rgba(255, 255, 255, 0.5)">
				            <div class="card-header text-white" style="background:#3A3A3A;"># Collection No. Details</div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              	<div class="row">
				              		<div class="col-md-6">Order Date</div> 
				              		<div class="col-md-6"><?php echo $date?></div><br><br>

				              		<div class="col-md-6">Duration</div> 
				              		<div class="col-md-6"><?php echo $month. ' Month(s)'?></div><br><br>

				              		<div class="col-md-6">Deliveries Made </div> 
				              		<div class="col-md-6"><?php echo $deleviriesMade .' Deliveries'?></div><br><br>

				              		<div class="col-md-6">Deliveries Left </div> 
				              		<div class="col-md-6"><?php echo $deleviriesLeft .' Deliveries'?></div><br><br>
				              	</div>
				              </p>
				            </div>
				          </div>
				        </div>

				        <div class="col-sm-12">
				        	<p style="color:#7CF094;font-size:20px;text-align:center;background:#3A3A3A;height:51px;padding-top:13px;font-weight:500px;letter-spacing:0.05em">  <?php if($status == 'Expired') {echo '<span style="color:red">'.$status.'</span>';} else if($status == 'Cancelled') {echo '<span style="color:red">'.$status.'</span>';} else if($status == 'Pending') {echo '<span style="color:grey">'.$status.'</span>';}else{echo 'Next Delivery'. $nxtDelv;} ?> </p>
				        </div>

				        <!-- Second Row -->
				        <div class="col-sm-12">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header text-white" style="background:#3A3A3A;">Shipping Address</div>
				            <div class="card-body card-bodys" >
				              <p class="card-text">
				              	<?php echo $apartment; ?><br>
								<?php echo $lga; ?><br>
								<?php echo $state; ?>, <?php echo $country; ?><br>
								<p>Zip Code: <?php echo $zcode; ?></p>
				              </p>
				            </div>
				          </div>
				        </div>

				        <div class="col-sm-12">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header text-white" style="background:#3A3A3A;">Payment Information</div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              	<div class="row">
				              		<div class="col-md-6">Payment Type</div> 
				              		<div class="col-md-6"><?php echo $payType ?></div><br><br>

				              		<div class="col-md-6">Amount Paid</div> 
				              		<div class="col-md-6"><?php echo number_format($amount,2) ?></div><br><br>
				              	</div>
				              </p>
				            </div>
				          </div>
				        </div>


        			</div>
        		</div>
        	</div>

        	<!-- Second column Start From Here -->

        	<div class="col-xl-6">
        		<div class="card bg-transparent">
        			<div class="row">
        				<div class="col-sm-12">
				          <div class="card">
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              	<?php
				              		$getDel = $connect2db->prepare("SELECT * FROM sub_duration WHERE sub_id=? AND user=?");
				              		$getDel->execute([$order_id, $user_id]);
				              		$count = 1;
				              		while($delDet = $getDel->fetch()){
				              			$delStatus = $delDet->delv_status;
				              			if ($invoice == 0 || $delStatus == 'Delivered') {
				              				$class = 'disabled';
				              			}else{
				              				$class = 'button';
				              			}
				              	?>

				              	<div class="row">
				              		<div class="col-md-4 pt-2"><?php echo randomSurfix($count);?> Delivery</div> 
				              		<div class="col-md-4 text-center">
				              			<a href="subscriber_details.php?order_id=<?php echo $order_id.'&user='.$user_id.'&status='.$delDet->id;?>" class="btn <?php echo $class; ?>" >
				              				Confirm Order
				              			</a>
				              		</div>
				              		<?php 
				              		if ($invoice == 1 && $delStatus == 'Delivered') {?>
				              		<div class="col-md-4 pt-2 text-white">
				              			<img src="images/checked.png">
				              			<?php echo $delDet->delv_date; ?>
				              		</div><br><br>
				              			<?php } ?>
				              	</div>
				              	<?php

				              	$count ++;
				              }?>
				              </p>
				            </div>
				          </div>
				        </div>
<!-- Select Custom Collections if Availbale -->

        				<?php
        					if ($plan == 0) {?>
        						<div class="col-sm-12">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5);background:transparent;">
				          	<h4 style="background:transparent;color:#DAC08E;font-size:15px" class="py-2 my-1 pl-3"> Custom Box Items Selections </h4>
				            <div class="card-header text-white" style="background:#3A3A3A;">
								<div class="row">
				              		<div class="col-md-6">Product Name</div> 
				              		<div class="col-md-6">Quantity</div>
				              	</div>
				            </div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              	<?php 
				              		$listProduct = $connect2db->prepare("SELECT cust.product_id,cust.quantity, prd.prd_name, prd.id  FROM tbl_custom_product as cust INNER JOIN product as prd ON cust.product_id=prd.id WHERE cust.order_id =? ");
				              		$listProduct->execute([$order_id]);
				              		while ($product = $listProduct->fetch()) {?>
				              			<div class="row">
				              		<div class="col-md-6"><?php echo $product->prd_name?></div> 
				              		<div class="col-md-6"><?php echo $product->quantity; ?></div><br><br>
				              	</div>
				              		<?php
				              	}
				              	?>
				              	
				              </p>
				            </div>
				          </div>
				        </div>
        				<?php	}
        				?>

        				<div class="col-sm-12">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header text-white" style="background:#3A3A3A;">Account Information</div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              		<div class="row">
				              		<div class="col-md-6">Customer Name</div> 
				              		<div class="col-md-6"><?php echo $fname." ".$lname ?></div><br><br>

				              		<div class="col-md-6">Email</div> 
				              		<div class="col-md-6"><?php echo $email ?></div><br><br>
				              	</div>
				              </p>
				            </div>
				          </div>
				        </div>

				        <div class="col-sm-12">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header text-white" style="background:#3A3A3A;">Collection Subscribed</div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              	<div class="row">
				              		<div class="col-md-6">Plan</div> 
				              		<div class="col-md-6"><?php echo $coll_infor ?></div><br><br>

				              		<div class="col-md-6">Monthly Price</div> 
				              		<div class="col-md-6"><?php echo number_format($mntPrice,2) ?></div><br><br>

				              		<div class="col-md-6">Total</div> 
				              		<div class="col-md-6"><?php echo number_format($amount,2) ?></div><br><br>
				              	</div>
				              </p>
				            </div>
				          </div>
				        </div>


        			</div>


        		</div>
        	</div>

        </div>


    </div>
  </div>


<?php include 'footer.php';?>


