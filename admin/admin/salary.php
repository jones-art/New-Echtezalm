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
<!--           <div class="card pl-3" style="background:transparent;height:70px">
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
          </div> -->

          <div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="background:#3A3A3A;color:#fff">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Staff Name</th>
                        <th>Work Place</th>
                        <th>Work Position</th>
                        <th>Salary</th>
                        <th>Staff Since</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../includes/connection.php';
                    $getUser = $connect2db->prepare("SELECT users.id,users.fname,users.lname,users.status,users.joined,job_info.salary,job_info.workplace,job_info.job_app,users.role,job_info.user_id FROM users JOIN job_info ON users.id = job_info.user_id  WHERE role=? ");
                    $getUser->execute(['Admin']);
                    // $i = 1;
                    while ($row = $getUser->fetch()) {
                      ?>
                      <tr class="mt-3 mb-3" style="margin-top:5px;border-bottom:2px solid #3A3A3A;background:transparent;">
                          <td>
                            <input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td>
                          <td><?php echo $row->user_id; ?></td>
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td>
                            <?php echo $row->workplace ?>
                          </td>
                          <td><?php echo $row->job_app; ?></td>
                          <td><?php echo $row->salary; ?></td>
                          <td><?php echo ($row->joined); ?></td>
                        

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
    alert(window.location.hostname)
    $('#default-datatable').DataTable();
  });
</script>
