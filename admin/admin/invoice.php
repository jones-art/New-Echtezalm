<?php include 'header.php'?>
<style type="text/css">
	input{
		border:1px solid #fff;
		background: #000;
	}
</style>
<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
    	<!-- Content Start From Here -->
    	<br><br><br><br>
    <div class="row">
        <div class="col-xl-12">
          <div class="card" style="background:#3A3A3A;">
            <div class="card-body">
              <div class="table-responsive">
              	<table id="default-datatable" class="table">
                <thead style="background: #3A3A3A;color:#fff">
                    <tr>
                        <!-- <th></th> -->
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Ordered</th>
                        <th>Customers Name</th>
                        <th>Total </th>
                        <th>Download</th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <tbody>
                	<?php 
                    // include '../includes/connection.php';
                    $product = $connect2db->prepare("SELECT invoice.user_id, invoice.invoice, invoice.order_id, invoice.inv_type, users.fname, users.lname FROM invoice JOIN users on invoice.user_id = users.id");
                    $product->execute();
                    while ($row = $product->fetch()) {
                         $order_id = $row->order_id; 
                         $user_id = $row->user_id;
                         $type = $row->inv_type;
                      ?>
                      <tr style="background-color: #3A3A3A;margin-bottom: 2px;margin-top: 2px;">
                          <td><?php echo $row->order_id ?></td>
                          <td>
                            <?php 
                                if($type =='product'){
                                     $getPrd = $connect2db->prepare("SELECT prd_order.product_id,prd_order.quantity,prd_order.order_id,prd_order.user_id,product.prd_name FROM prd_order JOIN product ON prd_order.product_id = product.id WHERE order_id = ? AND user_id = ?");
                                  $getPrd->execute([$order_id, $user_id]);
                                  while ($prd = $getPrd->fetch()) {?>
                                <div><?php echo $prd->prd_name."(".$prd->quantity.") "?></div>
                                
                             <?php 
                                } 
                                } else{
                                    $getSub = $connect2db->prepare("SELECT subscriber.plan,collection.Coll_details FROM subscriber JOIN collection ON subscriber.plan = collection.id WHERE order_id = ? AND user_id = ?");
                                    $getSub->execute([$order_id, $user_id]);
                                    $sub = $getSub->fetch();
                                    echo $sub->Coll_details;
                                }
                            ?>
                            
                          </td>
                          <td>
                              <?php 
                        if($type == 'product'){
                                    $getDate = $connect2db->prepare("SELECT ord_date FROM tbl_order WHERE order_id = ? AND user_id = ? ");
                                    $getDate->execute([$order_id, $user_id]);
                                    $date = $getDate->fetch();
                                    echo $date->ord_date;
                                   
                                } else {
                                    $getDate = $connect2db->prepare("SELECT sub_date FROM subscriber WHERE order_id = ? AND user_id = ? ");
                                    $getDate->execute([$order_id, $user_id]);
                                    $date = $getDate->fetch();
                                    echo $date->sub_date;
                                }
                            ?>
                          </td>
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td>
                            <?php
                              if($type == 'product'){
                            $getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total_amount FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
                              $getTotal->execute([$user_id, $order_id]);
                              $total = $getTotal->fetch();
                              echo(number_format($total->total_amount,2)); 
                                } else {
                                   $getTotal = $connect2db->prepare("SELECT sub_total FROM `subscriber` WHERE user_id = ? AND order_id = ? ");
                              $getTotal->execute([$user_id, $order_id]);
                              $total = $getTotal->fetch();
                              echo(number_format($total->sub_total,2)); 
                                }
                            
                            ?>   
                          </td>
                           
		                    	
		                    	<td class="text-center">
                                    <a href="invoice/<?php echo $row->invoice; ?>">
                                        <i aria-hidden="true" class="fa fa-download fa-2x" style="color:#DAC08E;"></i>
                                    </a>
                                </td>
		                    	<td>
                                    <a href="invoice-view.php?order_id=<?php echo($row->order_id);?>&user=<?php echo($row->user_id);?>&type=<?php echo $type;?>" style="color:#DAC08E;">View</a>
                                </td>
		                    </tr>
                		<?php
                		
                		}
                	?>
                   
                  </tbody>
                  <tfoot>
                    <tr>
                    	<!-- <th></th> -->
                    	<th>Order ID</th>
                        <th>Product Name</th>
                        <th>Ordered</th>
                        <th>Customers Name</th>
                        <th>Total </th>
                        <th>Download</th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </tfoot>
              </table>

              </div>
	          </div>
	      </div>
	  </div>
	</div>

    	<!-- Content Ends Here -->
    </div>
  </div>

<?php include 'footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#default-datatable').DataTable();
	});
</script>
