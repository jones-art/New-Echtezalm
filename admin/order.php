<?php include 'header.php';?>
<?php
  include '../includes/connection.php';
  $pstatus = 'Pending';
  $payment = 'Paid';
  $getActive = $connect2db->prepare("SELECT count(id) AS active FROM tbl_order WHERE del_status = ? AND payment_status = ?");
  $getActive->execute([$pstatus, $payment]);
  $active = $getActive->fetch();
  $active = $active->active;

  $dstatus = 'Delivered';
  $getDelv = $connect2db->prepare("SELECT count(id) AS delv FROM tbl_order WHERE del_status = ?");
  $getDelv->execute([$dstatus]);
  $delv = $getDelv->fetch();
  $delv = $delv->delv;

  $cstatus = 'Cancelled';
  $getcan = $connect2db->prepare("SELECT count(id) AS can FROM tbl_order WHERE del_status = ?");
  $getcan->execute([$cstatus]);
  $can = $getcan->fetch();
  $can = $can->can;

?>

<div class="clearfix"></div>
  
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
      <!-- Content Start-->
      <br><br><br>

      <div class="row mt-3">
        <!-- LEFT COLOUMN DIV START HERE -->
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
          <div class="card" style="background: #3A3A3A;">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <span>Active Orders</span>
                <h4 class="text-white"><?php echo $active ?></h4>
              </div>
              <!-- <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                <i class="icon-basket-loaded text-white"></i></div> -->
            </div>
            </div>
          </div>
        </div>

         <div class="col-12 col-lg-6 col-xl-3">
          <div class="card" style="background: #3A3A3A;">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <span>Total Delivered Order</span>
                <h4 class="text-white"><?php echo $delv ?></h4>
              </div>
              <!-- <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                <i class="icon-basket-loaded text-white"></i></div> -->
            </div>
            </div>
          </div>
        </div>

         <div class="col-12 col-lg-6 col-xl-3">
          <div class="card" style="background: #3A3A3A;">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <span>Total Canceled Order</span>
                <h4 class="text-white"><?php echo $can ?></h4>
              </div>
              
            </div>
            </div>
          </div>
        </div> 
        <!--  ############################### -->
       </div>

       <div class="row">
        <div class="col-xl-12">
          <div class="card" style="background:#3A3A3A;">
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table">
                <thead style="background: #3A3A3A;color:#fff">
                    <!-- <a class="btn" href="add-product.php">Add Product</a> -->
                    <tr>
                      <!-- <th></th> -->
                      <th>Order ID</th>
                        <th>Product & Quantity</th>
                        <th>Order Date</th>
                        <th>Customer's Name</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Delivered Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    // include '../includes/connection.php';
                    $product = $connect2db->prepare("SELECT tbl_order.user_id,tbl_order.del_date,tbl_order.order_id,tbl_order.ord_date,tbl_order.payment_status,tbl_order.del_status, users.fname, users.lname FROM tbl_order JOIN users on tbl_order.user_id = users.id WHERE payment_status = ?");
                    $product->execute(['Paid']);
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
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td><?php echo $row->del_status; ?></td>
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
                          <td><?php echo $row->del_date?></td>
                          <td><a href="single-order.php?order_id=<?php echo($row->order_id);?>&user=<?php echo($row->user_id);?>" style="color:#DAC08E;">View Details</a></td>
                        </tr>
                    <?php
                    }
                  ?>
                   
                  </tbody>
                  <!-- <thead>
                    <tr>
                       <th></th>
                      <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Ordere</th>
                        <th>Customer's Name</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Delivered Date</th>
                        <th></th>
                    </tr>
                </thead > -->
              </table>

              </div>
            </div>
        </div>
    </div>
  </div>
          </div>
<!-- LEFT COLOUMN DIV ENDS HERE -->

      
<?php include 'footer.php'?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#default-datatable').DataTable();
  });
</script>