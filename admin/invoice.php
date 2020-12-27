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
                    $product = $connect2db->prepare("SELECT tbl_order.user_id,tbl_order.del_date,tbl_order.order_id,tbl_order.ord_date,tbl_order.payment_status,tbl_order.del_status,tbl_order.invoice,tbl_order.file, users.fname, users.lname FROM tbl_order JOIN users on tbl_order.user_id = users.id WHERE payment_status = ? AND invoice = ?");
                    $product->execute(['Paid', 1]);
                    while ($row = $product->fetch()) {
                      ?>
                      <tr style="background-color: #3A3A3A;margin-bottom: 2px;margin-top: 2px;">
                          <td><?php echo $row->order_id ?></td>
                          <td>
                            <?php 
                              $order_id = $row->order_id; 
                              $user_id = $row->user_id;

                              $getPrd = $connect2db->prepare("SELECT prd_order.product_id,prd_order.quantity,prd_order.order_id,prd_order.user_id,product.prd_name FROM prd_order JOIN product ON prd_order.product_id = product.id WHERE order_id = ? AND user_id = ?");
                              $getPrd->execute([$order_id, $user_id]);
                              while ($prd = $getPrd->fetch()) {?>
                                <div><?php echo $prd->prd_name."(".$prd->quantity.") "?></div>
                                
                             <?php }


                            ?>
                            
                          </td>
                          <td><?php echo $row->ord_date; ?></td>
                          <!-- <td><?php //echo $row->quantity; ?></td> -->
                          <!-- <td><?php //echo $row->order_date; ?></td> -->
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td>
                            <?php
                              $order_id = $row->order_id; 
                              $user_id = $row->user_id;
                              $getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total_amount FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
                              $getTotal->execute([$user_id, $order_id]);
                              $total = $getTotal->fetch();
                              echo(number_format($total->total_amount,2)); 
                            ?>   
                          </td>
		                    	
		                    	<td class="text-center">
                                    <a href="invoice/<?php echo $row->file; ?>">
                                        <i aria-hidden="true" class="fa fa-download fa-2x" style="color:#DAC08E;"></i>
                                    </a>
                                </td>
		                    	<td>
                                    <a href="invoice-view.php?order_id=<?php echo($row->order_id);?>&user=<?php echo($row->user_id);?>" style="color:#DAC08E;">View</a>
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
