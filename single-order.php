<?php include 'header.php';?>

<?php 

//	use PHPMailer\PHPMailer\PHPMailer;

//	require "/usr/share/php/libphp-phpmailer/class.phpmailer.php";
	require "/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php";
//	require_once "PHPMailer/Exception.php";

	if (isset($_GET['order_id']) AND isset($_GET['user'])) { 
		$order_id = $_GET['order_id'];
		$user_id = $_GET['user'];
		$getInvoice = $connect2db->prepare("SELECT * from tbl_order WHERE order_id = ? AND user_id = ?");
		$getInvoice->execute([$order_id, $user_id]);
		$data = $getInvoice->fetch();
		$invoice = $data->invoice;
		$date = $data->ord_date;
		$status = $data->del_status;
		$payType = $data->payment_type;
		$amount = $data->amount;

		$shipping = $connect2db->prepare("SELECT * from shipping_details WHERE order_id = ? AND user_id = ?");
		$shipping->execute([$order_id, $user_id]);
		if ($shipping->rowcount()>0) {
			$data = $shipping->fetch();
			$country = $data->country;
			$state = $data->state;
			$lga = $data->lga;
			$apartment = $data->apartment;
			$zcode = $data->zip_code;
		} else{
			$country = '--------';
			$state = '--------';
			$lga = '--------';
			$apartment = '--------';
			$zcode ='--------';
		}

		$user = $connect2db->prepare("SELECT fname,lname,email from users WHERE id = ?");
		$user->execute([$user_id]);
		$userdata = $user->fetch();
		$fname = $userdata->fname;
		$lname = $userdata->lname;
		$email = $userdata->email;

		$getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total_amount FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
      $getTotal->execute([$user_id, $order_id]);
      $total = $getTotal->fetch();


        function getProducts(){
        	$order_id = $_GET['order_id'];
			$user_id = $_GET['user'];
	    	include '../includes/connection.php';
	    	$getPrd = $connect2db->prepare("SELECT prd_order.product_id,prd_order.quantity,prd_order.order_id,prd_order.user_id,prd_order.total_amount,product.prd_name FROM prd_order JOIN product ON prd_order.product_id = product.id WHERE order_id = ? AND user_id = ?");
                  $getPrd->execute([$order_id, $user_id]);
                  $output = '';
                  $fetch_prd = $getPrd->fetchAll();
                  foreach ($fetch_prd as $prd ) {
                  	$output.= '<div style="margin-bottom:15px"> '.$prd->prd_name.'(x '.$prd->quantity.' )<br> '.number_format($prd->total_amount,2).'</div>';
                  }
                         
                      
                    return $output;

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
		<tr><td>Products</td><td>'. getProducts().'</td></tr>
		<tr><td>Total Amount</td><td>'.$amount.'</td></tr>
	</tbody>
</table>
	</div>	
    ';










if (isset($_POST['create'])) {
		include('pdf.php');
		$file_name = md5(rand()) . '.pdf';

		$html_code = '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
		$html_code .= '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
		$html_code .= $pdfDoc;
		$pdf = new Pdf();
		$pdf->setPaper('letter');
		$pdf->load_html($html_code);
		$pdf->render();
		$file = $pdf->output();
		 $file_location = $_SERVER['DOCUMENT_ROOT']."/admin/invoice/".$file_name;
//		$file_location = "invoice/".$file_name;
		file_put_contents($file_location, $file);

		// file_put_contents(filename, data)

				

		$mail = new PHPMailer;

		// $body = file_get_contents('content.php');
		// $body = ereg_replace("[\]",'',$body);



//		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
		$mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
    
		$mail->Username = "younghallajinoni@gmail.com";
		$mail->Password = "Muthorlib123";
		
		
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

		$mail->setFrom("mutolibsodiq2015@gmail.com","Echtezalm");
		$mail->addAddress($email);
        $mail->addReplyTo("younghallajinoni@gmail.com");
//		$mail->AddAttachment("invoice/".$file_name); 
    
        $mail->isHTML(true);
		$mail->Subject = "Invoice for Order ID:".$order_id;
		$mail->Body = "<h1 align=center><a href=ogitech.edu.ng>Download Invoice Attachment</a></h1>";

		if ($mail->send()) {
			$del_status = 'Processing';
			$invoice = 1;
			$del_date = date('Y-m-d H:i:s', strtotime("+48 hours"));
			$update = $connect2db->prepare("UPDATE tbl_order SET del_status = ?, invoice = ?, file = ?, del_date = ? WHERE user_id = ? AND order_id = ? ");
			$update->execute([$del_status, $invoice, $file_name, $del_date, $user_id, $order_id]);
			if ($update) {
				$createNxtDlv = $connect2db->prepare("INSERT INTO delivery (user_id, order_id, delv_date, status, sub_type) VALUES (?,?,?,?,?)");
				$createNxtDlv->execute([$user_id,$order_id,$del_date,'processing','product']);

				$date = date('Y-M-d H:i:s');
				$insertInvoice = $connect2db->prepare("INSERT INTO invoice (user_id, order_id, invoice, created, inv_type) VALUES (?,?,?,?,?)");
				$insertInvoice->execute([$user_id, $order_id, $file_name, $date, 'product']);
				echo("<script>alert('Invoice Successfully Created');</script>");
			} else{
				echo("<script>alert('Error Updating Data');</script>");
			}
			
		} else{
			echo("<script>alert('Error Sending Invoice');</script>");
		}
	}
      

    // Cancle Order

	if(isset($_POST['cancel'])){
		$cancelSub = $connect2db->prepare("UPDATE tbl_order SET 
		      del_status='Cancelled' WHERE order_id=? AND user_id=?
		      ");
		if($cancelSub->execute([$order_id, $user_id])){
			echo "<script> alert('Order Cancelled'); </script>";
		}else{
			echo "<script> alert('Unfinished'); </script>";
		}
	}      

	if(isset($_POST['confirm'])){
		$date = date('Y-m-d H:i:s');
		$cancelSub = $connect2db->prepare("UPDATE tbl_order SET 
		      del_status='Delivered', del_date=? WHERE order_id=? AND user_id=?
		      ");
		if($cancelSub->execute([$date, $order_id, $user_id])){
			$value = 'Expired';

			$updNxtDel= $connect2db->prepare("UPDATE delivery SET status = ? WHERE user_id= ? AND order_id = ? ");
			$updNxtDel->execute([$value,$user_id,$order_id]);
			echo "<script> alert('Order Delivered'); </script>";
		}else{
			echo "<script> alert('Unfinished'); </script>";
		}
	} 

?>
		
<style type="text/css">
	button{
		width:174px;height:51px;
		color:#fff; background-color:#AD976E;border:0px;
	}
	button[disabled]{
		background-color:gray;
		color: #fff;
	}
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">

    	<div class="row mt-5">
    		<div class="col-xl-12 text-right" style="background-color:transparent;margin-top:22px;">
    			<div class="card text-right" style="align-items:right;background-color: transparent;">
    				<?php if ($status !== 'Delivered') {?>
    					
    				
    				<form method="POST" action="">
    					<div class="row mt-3 mb-2">
    						<div class="col-xl-2 col-lg-2 col-sm-12">
	    						<button type="submit" name="cancel">Cancel Order</button>
	    					</div>

	    					<div class="col-xl-2 col-lg-2 col-sm-12">
	    						<button <?php $invoice==1?print'disabled':print'';?> type="submit" name="create">Create Invoice</button>
	    					</div>

	    					<div class="col-xl-2 col-lg-2 col-sm-12">
	    						<button <?php $invoice==0?print'disabled':print'';?> type="submit" name="confirm" >Confirm Order</button>
	    					</div>
    					</div>
    				</form>
    				<?php } ?>
    			</div>
    		</div>
    	</div>

    	<div class="row">
        	<div class="col-xl-6">
        		<div class="card bg-transparent">
        			<!-- First Row  -->
        			<div class="row">
        				<div class="col-sm-12">
				          <div class="card" style="border: 1px solid rgba(255, 255, 255, 0.5)">
				            <div class="card-header text-white" style="background:#3A3A3A;"># <?php echo $order_id; ?> Details</div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              	<div class="row">
				              		<div class="col-md-6">Order Date</div> 
				              		<div class="col-md-6"><?php echo $date?></div><br><br>

				              		<div class="col-md-6">Order No</div> 
				              		<div class="col-md-6"><?php echo $order_id?></div><br><br>

				              		<div class="col-md-6">Order Status</div> 
				              		<div class="col-md-6"><?php echo $status?></div><br><br>
				              	</div>
				              </p>
				            </div>
				          </div>
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
				            <div class="card-header text-white" style="background:#3A3A3A;">Item Ordered</div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
				              	<?php 
				              		echo getProducts();
				              		// $getPrd = $connect2db->prepare("SELECT prd_order.product_id,prd_order.quantity,prd_order.order_id,prd_order.user_id,prd_order.total_amount,product.prd_name FROM prd_order JOIN product ON prd_order.product_id = product.id WHERE order_id = ? AND user_id = ?");
                    //           $getPrd->execute([$order_id, $user_id]);
                              // while ($prd = $getPrd->fetch()) {
                              	?>
                               <!-- <div style="margin-bottom: 15px;"><?php //echo $prd->prd_name ?>(x<?php // echo $prd->quantity ?>)<br> <?php// echo number_format($prd->total_amount,2) ?></div> -->
                           <?php 
                       			//}
                       		?>
				            	<div>Total Amount: <?php echo(number_format($total->total_amount,2)); ?></div>
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

<?php	

}

else{
	echo("<script>alert('Error in Confirming order, kindly Login to cofirm your account');window.location='logout.php'</script>");
}
?>


<?php include 'footer.php';?>


