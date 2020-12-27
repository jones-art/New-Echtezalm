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
  <!--  -->
          <div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="background:#3A3A3A;color:#fff">
                    <tr>
                      <th></th>
                        <th>Staff ID</th>
                        <th>Full Name</th>
                        <th>Job Position</th>
                        <th>Status</th>
                        <th>State</th>
                        <th>Employee Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../includes/connection.php';
                    $getUser = $connect2db->prepare("SELECT users.id,users.fname,users.lname,users.status,users.joined,job_info.workplace,job_info.job_app,users.role,job_info.user_id FROM users JOIN job_info ON users.id = job_info.user_id  WHERE role=? ");
                    $getUser->execute(['Admin']);
                    // $i = 1;
                    while ($row = $getUser->fetch()) {
                      ?>
                      <tr class="mt-3 mb-3" style="margin-top:5px;border-bottom:2px solid #3A3A3A;background:transparent;">
                          <td>
                            <input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td>
                          <td><?php echo $row->user_id; ?></td>
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td><?php echo $row->job_app; ?></td>
                          <td>
                            <?php ($row->status==1)?$status="Active":$status="Deactivated";
                            echo $status; ?>   
                          </td>
                          <td>
                            <?php ($row->workplace==0)?$workplace="-----":$workplace=$row->workplace;
                            echo $workplace; ?>
                          </td>
                          <td><?php echo ($row->joined); ?></td>
                        

                            <td> <a href="view-staff.php?sid=<?php echo $row->id ?>" style="color: #DAC08E;" > view </a></td>
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

<?php include 'footer.php'?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#default-datatable').DataTable();
  });
</script>
