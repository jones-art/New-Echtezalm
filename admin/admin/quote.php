<?php include 'header.php';?>

<div class="clearfix"></div>
  
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
      <!-- Content Start From Here -->
      <br><br><br><br>

    <div class="row">
    	<div class="col-sm-12 right-text"><a href="send-quote.php" class="btn btn-primary"><i aria-hidden="true" class="fa fa-plus fa-2x" style="color:#DAC08E;"></i> Send Quote</a></div>
        <div class="col-xl-12">




        	<div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="background:#3A3A3A;color:#fff">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Send To</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Download</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../includes/connection.php';
                    $getUser = $connect2db->prepare("SELECT * FROM quote ORDER BY id DESC");
                    $getUser->execute();
                    // $i = 1;
                    while ($row = $getUser->fetch()) {
                        $qutid = $row->order_id;
                      ?>
                      <tr class="mt-3 mb-3" style="margin-top:5px;border-bottom:2px solid #3A3A3A;background:transparent;">
                          <td>
                            <input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td>
                          <td><?php echo $row->order_id; ?></td>
                          <td><?php echo $row->name; ?></td>
                          <td><?php echo $row->date; ?></td>
                          <td> <?php ($row->status == 0)?print 'Pending':print 'Paid'; ?></td>
                          <td>
                            <?php 
                              $quoteid = $row->id;
                              $getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total FROM quote_items WHERE order_id = ?");
                              $getTotal->execute([$qutid]);
                              $total = $getTotal->fetch();
                              echo($total->total);
                            ?>
                            
                          </td>
                          <td class="text-center">
                            <a href="invoice/<?php echo $row->file ?>">
                              <i aria-hidden="true" class="fa fa-download fa-2x" style="color:#DAC08E;">
                                
                              </i>
                            </a>
                            </td>
                        

                            <td> <a href="view-quote.php?id=<?php echo $row->id?>" style="color:#DAC08E;"> View </a></td>
                        </tr>
                    <?php
                    // $i=$i+1;
                    }
                  ?>
                  </tbody>
              </table>

              </div>
            </div>
        </div>
    </div>
  </div>







      <!-- Content Ends Here -->
    </div>
  </div>



<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#default-datatable').DataTable();
	});
</script>