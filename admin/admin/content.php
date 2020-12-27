<?php include 'header.php';?>

<?php 

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
		$data = $shipping->fetch();
		$country = $data->country;
		$state = $data->state;
		$lga = $data->lga;
		$apartment = $data->apartment;
		$zcode = $data->zip_code;

		$user = $connect2db->prepare("SELECT fname,lname,email from users WHERE id = ?");
		$user->execute([$user_id]);
		$userdata = $user->fetch();
		$fname = $userdata->fname;
		$lname = $userdata->lname;
		$email = $userdata->email;

		$getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total_amount FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
      $getTotal->execute([$user_id, $order_id]);
      $total = $getTotal->fetch();



                                


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
				              		$getPrd = $connect2db->prepare("SELECT prd_order.product_id,prd_order.quantity,prd_order.order_id,prd_order.user_id,prd_order.total_amount,product.prd_name FROM prd_order JOIN product ON prd_order.product_id = product.id WHERE order_id = ? AND user_id = ?");
                              $getPrd->execute([$order_id, $user_id]);
                              while ($prd = $getPrd->fetch()) {?>
                               <div style="margin-bottom: 15px;"><?php echo $prd->prd_name ?>(x<?php echo $prd->quantity ?>)<br> <?php echo number_format($prd->total_amount,2) ?></div>
                           <?php 
                       			}
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


