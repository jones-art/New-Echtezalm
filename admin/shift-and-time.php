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
          <div class="card pl-3" style="background:transparent;height:70px">
            <div class="card-body">
              <div class="row">
                <div class="col-s4">
                  <div class="row">
                    <div class="col-s6 pl-3 mr-4">
                      <select class="form-control" style="width:100%;height:30px">
                        <option> Actions</option>
                      </select>
                  
                    </div>
                    <div class="col-s6">
                      <select class="form-control" style="width:100%;height:30px">
                        <option>Sort</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-s4 ml-4" style="text-align:center;align-content:center;">
                  <ul class="navbar-nav mr-4 ml-4 align-items-center">
                    <li class="nav-item">
                      <form class="search-bar">
                        <input type="text" class="form-control" placeholder="Enter keywords" style="background:transparent;">
                         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                      </form>
                    </li>
                  </ul>

                </div>
                <div class="col-s4 justify-content-center pl-4" style="text-align:right;">
                  <input type="date" name="sort-by-date" class="form-control" style="width:100%">
                </div>
              </div>
            </div>
          </div>

          <div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="background:#3A3A3A;color:#fff">
                    <tr>
                        <th>ID</th>
                        <th>Staff Name</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../includes/connection.php';
                    $getUser = $connect2db->prepare("SELECT users.id,users.fname,users.lname,job_shift.mon,job_shift.tue,job_shift.wed,job_shift.thu,job_shift.fri,job_shift.sat,job_shift.sun,job_shift.user_id FROM users JOIN job_shift ON job_shift.user_id = users.id WHERE role=? ");
                    $getUser->execute(['Admin']);
                    $i = 1;
                    while ($row = $getUser->fetch()) {
                      ?>
                      <tr class="mt-3 mb-3" style="margin-top:5px;border-bottom:1px solid #3A3A3A;background:transparent;">
                          
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td><?php echo $row->mon; ?></td>
                          <td><?php echo $row->tue; ?></td>
                          <td><?php echo $row->wed; ?></td>
                          <td><?php echo ($row->thu); ?></td>
                          <td><?php echo $row->fri; ?></td>
                          <td><?php echo ($row->sat); ?></td>
                          <td><?php echo ($row->sun); ?></td>
                        </tr>
                    <?php
                    $i=$i+1;
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
