<?php include 'header.php'?>
<?php 
  include '../includes/connection.php';
  $pstatus = 'Pending';
  $getActive = $connect2db->prepare("SELECT count(id) AS active FROM subscriber WHERE status = ?");
  $getActive->execute([$pstatus]);
  $active = $getActive->fetch();
  $active = $active->active;

  $dstatus = 'Delivered';
  $getDelv = $connect2db->prepare("SELECT count(id) AS delv FROM subscriber WHERE status = ?");
  $getDelv->execute([$dstatus]);
  $delv = $getDelv->fetch();
  $delv = $delv->delv;

  $dstatus = 'Delivered';
  $date = date('Y-m-d');
  $getDelv2 = $connect2db->prepare("SELECT count(id) AS delv2 FROM subscriber WHERE status = ? AND del_date = ?");
  $getDelv2->execute([$dstatus, $date]);
  $delv2 = $getDelv2->fetch();
  $delv2 = $delv2->delv2;

  $cstatus = 'Cancelled';
  $getcan = $connect2db->prepare("SELECT count(id) AS can FROM subscriber WHERE status = ?");
  $getcan->execute([$cstatus]);
  $can = $getcan->fetch();
  $can = $can->can;
?>
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
  <div class="row mt-3">
        <!-- LEFT COLOUMN DIV START HERE -->
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="row">
          <div class="col-12 col-lg-6 col-xl-3">
          <div class="card" style="background: #3A3A3A;">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <span class="">Active Orders</span>
                <h4 class="text-white"><?php echo $active;?></h4>
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
                <span class="">Total Delivered Order</span>
                <h4 class="text-white"><?php echo $delv ;?></h4>
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
                <span>Total Delivered Today</span>
                <h4 class="text-white"><?php echo $delv2 ;?></h4>
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
                <span >Total Canceled Order</span>
                <h4 class="text-white"><?php echo $can;?></h4>
              </div>
              
            </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
    <div class="row">
        <div class="col-xl-12">
          <div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="background:#3A3A3A;color:#fff">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Order ID</th>
                        <th>State</th>
                        <th>Plan</th>
                        <th>Date Ordered</th>
                        <th>Duration</th>
                        <th>Deliveries Made</th>
                        <th>Deliveries Left</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../includes/connection.php';
                    $getUser = $connect2db->prepare("SELECT sub.plan,sub.sub_date,sub.duration, sub.month,sub.payment_status,sub.user_id, sub.id, sub.order_id, us.fname,us.lname,us.country, us.id FROM subscriber as sub INNER JOIN users as us ON us.id=sub.user_id WHERE sub.payment_status=?");
                    $getUser->execute(['Paid']);
                    while($row = $getUser->fetch())
                        { ?>
                      <tr class="mt-3 mb-3" style="margin-top:5px;border-bottom:1px solid #3A3A3A;background:transparent;">
                          <td><input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td>
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td><?php echo $row->order_id; ?></td>
                          <td><?php echo $row->country; ?></td>
                          <td>
                            <?php 
                              $planid = $row->plan; 
                              if ($planid==0) {
                                echo 'Custom Collection';
                              }else{
                                $getcolName = $connect2db->prepare("SELECT Coll_details FROM collection WHERE id = ?");
                                $getcolName->execute([$planid]);
                                $name = $getcolName->fetch();
                                echo($name->Coll_details);
                              }
                            ?>
                            
                          </td>
                          <td><?php echo $row->sub_date; ?></td>
                          <td><?php echo ($row->month); ?></td>
                          <td>
                            <?php 
                              $order_id = $row->order_id;
                              $user_id = $row->user_id;
                              $getDelMade= $connect2db->prepare("SELECT sub_id, count(id) as made from sub_duration WHERE sub_id = ? AND user = ?  AND delv_status=?");
                              $getDelMade->execute([$order_id, $user_id, 'Delivered']);
                              $delMade = $getDelMade->fetch();
                              $deleviriesMade= $delMade->made;
                              echo($deleviriesMade)
                            ?>
                          </td>
                          <td>
                            <?php 
                              $order_id = $row->order_id;
                              $user_id = $row->user_id;
                              $getDelMade= $connect2db->prepare("SELECT sub_id, count(id) as made from sub_duration WHERE sub_id = ? AND user = ?  AND delv_status=?");
                              $getDelMade->execute([$order_id, $user_id, 'Pending']);
                              $delMade = $getDelMade->fetch();
                              $deleviriesMade= $delMade->made;
                              echo($deleviriesMade)
                            ?>
                          </td>
                          <td><a href="subscriber_details.php?order_id=<?php echo($row->order_id);?>&user=<?php echo($row->user_id);?>" style="color:#DAC08E;">View </a></td>
                        </tr>
                    <?php
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

<?php include 'footer.php'?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#default-datatable').DataTable();
  });
</script>
