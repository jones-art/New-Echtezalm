<?php include 'header.php'; ?>

<?php 
	if (isset($_GET['order_id']) AND isset($_GET['user']) AND $_GET[type]=='product') { 
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
		$file = $data->file;

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

} else{
        $order_id = $_GET['order_id'];
		$user_id = $_GET['user'];
		$getInvoice = $connect2db->prepare("SELECT * from subscriber WHERE order_id = ? AND user_id = ?");
		$getInvoice->execute([$order_id, $user_id]);
		$data = $getInvoice->fetch();
		$date = $data->sub_date;
		$status = $data->status;
		$payType = $data->payment_type;
		$amount = $data->sub_total;
		$file = $data->file;
        $plan = $data->plan;

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


      
    }
?>

<style type="text/css">
	.invoice-card{
		font-family: Poppins;
		font-style: normal;
		font-weight: normal;
		font-size: 15px;
		line-height: 22px;
		display: flex;
		align-items: center;
		letter-spacing: 0.05em;

		color: #FFFFFF;
	}
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">

    	<div class="row mt-5">
    		<div class="col-sm-12 text-right pr-5 mt-4">
    			<a class="btn" style="width:174px;height:51px;color:#fff; background-color:#AD976E;border:0px;padding-top:15px;" href="invoice/<?php echo $file?>">Download Invoice</a>
    		</div>

    		<div class="col-sm-12 container-fluid" style="padding: 10px 260px 0px 260px;">
    			<div class="col-sm-12" style="background: #3A3A3A">
    				<div class="pb-3 pt-2"><img src="images/logo-white.png"></div>

    				<div>
    					<h5 style="padding-top:24px;font-style:normal;font-weight:500;font-size:22px;line-height:33px;color:#fff;">Hello, <?php echo $fname." ".$lname?></h5>
    					<p style="padding-top:15px;font-style:normal;font-weight:300;font-size:18px;color:#fff;text-align:justify;text-transform:capitalize;">
    						Thank you for your order from EchteZalm. Your packaged has been processed and ready to be delivered to you. Your package would arrive between 1 - 2 days from now.
    					</p>
    					<p style="padding-top:15px;font-style:normal;font-weight:300;font-size:18px;color:#fff;text-align:justify;text-transform:capitalize;">
    					Your order confirmation is below, thanks again for Patronizing us.</p>
    					<div style="padding-top:15px;padding-bottom:15px;font-style:normal;font-weight:500;font-size:22px;color:#fff;">Your Order #<?php echo $order_id ?> <small class="text-muted">(<?php echo $date ?>)</small></div>
					</div>
    				
    				<div class="row">
    					<div class="col-sm-12 col-lg-6">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header invoice-card text-white" style="background:#3A3A3A;">Shipping Address</div>
				            <div class="card-body card-bodys">
				            	<!-- .$apartment.'<br>'.$lga.'<br>'.$state.'<br>'.$country.' -->
				              <p class="card-text"><?php echo $apartment;?> <br>
<?php echo $lga;?><br>
<?php echo $state;?>, <?php echo $country;?></p>
				            </div>
				          </div>
				        </div>

					    <div class="col-sm-12 col-lg-6">
					          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
					            <div class="card-header invoice-card text-white" style="background:#3A3A3A;">Payment Information</div>
					            <div class="card-body card-bodys">
					              <p class="card-text"><div>Payment Type</div><?php echo $payType;?> </p>
					              <p class="card-text"><div>Amount Paid</div><div><?php echo $amount;?></div> </p>
					            </div>
					          </div>
					        </div>


				        <div class="col-sm-12 col-lg-12">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header invoice-card text-white" style="background:#3A3A3A;">Item Ordered</div>
				            <div class="card-body card-bodys">
				              <p class="card-text">
                                  <?php
                                    if($plan != 0){
                                        $getName = $connect2db->prepare("SELECT Coll_details, info_details FROM collection WHERE id = ?");
                                        $getName->execute([$plan]);
                                        $name = $getName->fetch();
                                        echo $name->Coll_details."<br>". $name->info_details;                                        
                                    } else{
                                        echo"Custom Collection";
				              		$listProduct = $connect2db->prepare("SELECT cust.product_id,cust.quantity, prd.prd_name, prd.id  FROM tbl_custom_product as cust INNER JOIN product as prd ON cust.product_id=prd.id WHERE cust.order_id =? ");
				              		$listProduct->execute([$order_id]);
				              		while ($product = $listProduct->fetch()) {?>
				              			<div class="row">
				              		<div class="col-md-6"><?php echo $product->prd_name?></div> 
				              		<div class="col-md-6"><?php echo $product->quantity; ?></div><br><br>
				              	</div>
				              		<?php
				              	         }
                                    }
				              	?>
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

<?php include 'footer.php'; ?>