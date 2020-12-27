<?php include 'header.php';?>


<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
    	<!-- Content Start-->
    	<br><br><br>

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
                      <th>S/N</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Phone Number</th>
                        <th>Message</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    // include '../includes/connection.php';
                    $product = $connect2db->prepare("SELECT * FROM feedback ORDER BY datetime desc");
                    $product->execute();
                    $i = 1;
                    while ($row = $product->fetch()) {
                      ?>
                      <tr style="background-color: #3A3A3A;margin-bottom: 2px;margin-top: 2px;">
                          <!-- <td><input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td> -->
                            
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->name; ?></td>
                          <td><?php echo $row->email; ?></td>
                          <td><?php echo $row->pnum; ?></td>
                          <td><?php echo substr($row->message, 0,30).'......' ?></td>
                          <td><a href="single-feedback.php?sid=<?php echo($row->id);?>" style="color:#DAC08E;">View </a></td>
                        </tr>
                    <?php
                    $i=$i+1;
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

    	
<?php include 'footer.php';?>


<script type="text/javascript">
  $(document).ready(function(){
    $('#default-datatable').DataTable();
  });
</script>
