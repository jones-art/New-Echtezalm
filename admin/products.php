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
          <div class="card pl-3" style="background:#3A3A3A;height:70px">
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

<!--                   <form class="container ml-4 pl-4">
                    <div class="form-group row">
                      <input type="search" name="search" class="form-control" style="height:30px;width: 90%">
                      <button type="button" class="btn" id="search" name="search" value="Search" style="background:transparent;box-shadow:0px 0px 0px 0px;padding-left:10px;">
                          <i class="fa fa-search text-white"></i>
                        </button>   
                    </div>
                  </form> -->
                </div>
                <div class="col-s4 justify-content-center pl-4" style="text-align:right;">
                  <a href="manage-users-details.php" class="btn btn-primary ml-4" style="height:30px"> 
                    <i class="fa fa-plus"></i>
                  Add a User</a>
                </div>
              </div>
            </div>
          </div>

          <div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="color:#fff">
                    <tr>
                      <th></th>
                      <th>Staff ID</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Job Position</th>
                        <th>Access</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../includes/connection.php';
                    $getUser = $connect2db->prepare("SELECT * FROM users WHERE role=? ");
                    $getUser->execute(['user']);
                    $i = 1;
                    while ($row = $getUser->fetch()) {
                      ?>
                      <tr class="mt-3 mb-3" style="margin-top:5px;page-break-before:3px; background: #3A3A3A;">
                          <td><input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->fname." ".$row->lname; ?></td>
                          <td><?php echo $row->dob; ?></td>
                          <td><?php echo $row->email; ?></td>
                          <td><?php echo $row->country; ?></td>
                          <td><?php echo ($row->dob); ?></td>
                          <td>
                            <select class="form-control" style="width:100px;height:30px">
                              <option value="" disabled selected> Action </option>
                              <option> <a href="manage-user-details.php?id=<?php echo($id);?>" style="color:#DAC08E;">View</a></option>
                               <option> <a href="manage-user-details.php?id=<?php echo($id);?>" style="color:#DAC08E;">Delete</a></option>
                                <option> <a href="manage-user-details.php?id=<?php echo($id);?>" style="color:#DAC08E;">Update</a></option>
                            </select>
                            </td>
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
