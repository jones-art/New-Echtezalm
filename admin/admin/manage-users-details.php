<?php if(is_file('no_delete.php')){
  include 'header.php';
}?>
<?php 
  if (is_file('no_delete.php')) {
    include'../includes/connection.php';
  }
  if (isset($_POST['addNewUser'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $acct_status = $_POST['status'];
    $role = 'Admin';
    $date = date('Y-m-d');

    if ($fname=="" OR $fname == " " OR empty($fname)) {
      echo "<script>alert('User First Name is required');</script>";
    }
    else if ($lname=="" OR $lname == " " OR empty($lname)) {
      echo "<script>alert('User Last Name is required');</script>";
    }
    else if ($uname=="" OR $uname == " " OR empty($uname)) {
      echo "<script>alert('Username is required');</script>";
    } 
    else if ($uname=="" OR $uname == " " OR empty($uname)) {
      echo "<script>alert('User E-mail is required');</script>";
    }
    else if ($password=="" OR $password == " " OR empty($password)) {
      echo "<script>alert('Password is required');</script>";
    }elseif ($password<>$cpassword) {
      echo "<script>alert('Password Not Matched');</script>";
    }
    else{
      $password = md5($password);
      $sqlvUser = "SELECT * FROM users WHERE email = ? OR username = ?";
      $validateUser = $connect2db->prepare($sqlvUser);
      $validateUser->execute([$email, $uname]);
      if ($validateUser->rowcount()>0) {
        echo "<script>alert('User already Exist');</script>";
      }
  // Create Account 
      else{
        $sql = "INSERT INTO users (fname,lname,username,email,password,status,role,joined)VALUES(?,?,?,?,?,?,?,?)";
        $createUser = $connect2db->prepare($sql);
        $createUser->execute([$fname,$lname,$uname,$email,$password,$acct_status,$role,$date]);
        if ($createUser) {
         // Start Assigning menu for user
          $user_id = $connect2db->lastInsertid();

          if (!empty($_POST['menu_permission1']) && is_array($_POST['menu_permission1'])) {
            foreach ($_POST['menu_permission1'] as $menu => $value) {
              $menu_permission = $_POST['menu_permission1'][$menu];
              (!isset($menu_permission))?$menu_permission=false:$menu_permission=true;
              $menu_id = $_POST['menu_id1'][$menu];

              $addMenuSql = "INSERT INTO user_role_management (user_id,menu_id,status)VALUES(?,?,?)";
              $addMenu = $connect2db->prepare($addMenuSql);
              $addMenu->execute([$user_id,$menu_id,$menu_permission]);
            }
          }
            // Menu Level One End Here


          if (!empty($_POST['menu_permission2']) && is_array($_POST['menu_permission2'])) {
              foreach ($_POST['menu_permission2'] as $menu2 => $value) {
                $menu_permission2 = $_POST['menu_permission2'][$menu2];
                (!isset($menu_permission2))?$menu_permission2=false:$menu_permission2=true;
                $menu_id2 = $_POST['menu_id2'][$menu2];

                $addMenuSql2 = "INSERT INTO user_role_management (user_id,menu_id,status)VALUES(?,?,?)";
                $addMenu2 = $connect2db->prepare($addMenuSql2);
                $addMenu2->execute([$user_id,$menu_id2,$menu_permission2]);
              }
          }
            

            // Menu Level 2 End Here
          if (!empty($_POST['menu_permission3']) && is_array($_POST['menu_permission3'])) {
              foreach ($_POST['menu_permission3'] as $menu3 => $value) {
              $menu_permission3 = $_POST['menu_permission3'][$menu3];
              (!isset($menu_permission3))?$menu_permission3=false:$menu_permission3=true;
              $menu_id3 = $_POST['menu_id3'][$menu3];

              $addMenuSql3 = "INSERT INTO user_role_management (user_id,menu_id,status)VALUES(?,?,?)";
              $addMenu3 = $connect2db->prepare($addMenuSql3);
              $addMenu3->execute([$user_id,$menu_id3,$menu_permission3]);
            }
          }
            
            
            // Menu Level 3 Ends Here
          if (!empty($_POST['menu_permission4']) && is_array($_POST['menu_permission4'])) {
              foreach ($_POST['menu_permission4'] as $menu4 => $value) {
              $menu_permission4 = $_POST['menu_permission4'][$menu4];
              (!isset($menu_permission4))?$menu_permission4=false:$menu_permission4=true;
              $menu_id4 = $_POST['menu_id4'][$menu4];

              $addMenuSql4 = "INSERT INTO user_role_management (user_id,menu_id,status)VALUES(?,?,?)";
              $addMenu4 = $connect2db->prepare($addMenuSql4);
              $addMenu4->execute([$user_id,$menu_id4,$menu_permission4]);
            }
          }

          if ($addMenu OR $addMenu2 OR $addMenu3 OR $addMenu4) {
            // Creating User Job Information
            $job_app = $_POST['job_app'];
            $workplace = $_POST['workplace'];
            $salary = $_POST['salary'];
              $userJobSql = "INSERT INTO job_info (job_app,workplace,salary,user_id) VALUES (?,?,?,?) " ;
              $userJob = $connect2db->prepare($userJobSql);
              $userJob->execute([$job_app,$workplace,$salary,$user_id]);
              if ($userJob) {
                empty($_POST['sday1'])?$mon = 'Off day': $mon = $_POST['sday1']." - ".$_POST['eday1'];
                empty($_POST['sday2'])?$tues = 'Off day': $tues = $_POST['sday2']." - ".$_POST['eday2'];
                empty($_POST['sday3'])?$wed = 'Off day': $wed= $_POST['sday3']." - ".$_POST['eday3'];
                empty($_POST['sday4'])?$thur = 'Off day': $thur = $_POST['sday4']." - ".$_POST['eday4'];
                empty($_POST['sday5'])?$fri = 'Off day': $fri= $_POST['sday5']." - ".$_POST['eday5'];
                empty($_POST['sday6'])?$sat = 'Off day': $sat = $_POST['sday6']." - ".$_POST['eday6'];
                empty($_POST['sday7'])?$sun = 'Off day': $sun = $_POST['sday7']." - ".$_POST['eday7'];
                  

                $createShiftSql = "INSERT INTO job_shift (mon,tue,wed,thu,fri,sat,sun,user_id)VALUES(?,?,?,?,?,?,?,?)";
                $createShift = $connect2db->prepare($createShiftSql);
                $createShift->execute([$mon,$tues,$wed,$thur,$fri,$sat,$sun,$user_id]);
                

                if ($createShift) {
                  echo "<script>alert('Registration Completed');</script>";
                } else{
                  echo "<script>alert('Error Creating User Shift Record');</script>";
                }

              }else{
                echo "<script>alert('Error Createing Job Information');</script>";
              }
            }else{
              echo "<script>alert('No Menu Assigned for this user');</script>";
            }

            }else{
              echo "<script>alert('Error Creating User Account');</script>";
            }
      }
    }

      // }
  
    // function check_input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    //   }
  }

?>

<div class="clearfix"></div>
  
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
      <!-- Content Start-->
      <br><br><br>

      <div class="row mt-3">
        <!-- LEFT COLOUMN DIV START HERE -->
        <form class="container" id="loginForm" method="POST" action="" >
          <div class="col-sm-12">
            <div class="alert text-right" role="alert">
              <button type="submit" name="addNewUser" class="btn btn-primary"> Save</button>
              <hr>
            </div>

              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name="uname">
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstName" name="fname">
                </div>
              </div>
              <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastName" name="lname">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" placeholder="email@example.com" name="email">
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password </label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password">
                </div>
              </div>

              <div class="form-group row">
                <label for="cpassword" class="col-sm-2 col-form-label">Password Confirmation</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="cpassword" name="cpassword">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">This account is</label>
                <div class="col-sm-10">
                  <select class="form-control" name="status">
                    <option value="1"> Active </option>
                    <option value="0"> Deactive</option>
                  </select>
                </div>
              </div>    
              <hr>
                <h6 class="text-white mt-4 mb-3"> User Role</h6>
                <div id="user-role-section" style="border: 1px solid #626567 ">
                  <h6 class="text-muted mt-4 ml-3 mb-3">User Role</h6>
                  <div class="accordion bg-light pl-4 pt-2 mb-3" id="accordionExample">
                    <label> Assigned </label>
                    <label> Role</label>
                  </div>
 <div>
    <!--  ####################### MUTIPLE SELECT BOXES -->
    <div class="accordion" id="accordionExample">
      <h2 class="mb-0 ml-4">
        <input type="checkbox" name="" class="crmchkall">
        <a class="h6 text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Customer Relation Management
        </a>
      </h2>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
          <ul>
            <?php 
              if (!is_file('no_delete.php')) {
                echo "A file is Missing";
              }else{
                
                $getMenu = $connect2db->prepare("SELECT * FROM menu WHERE level = ?");
                $getMenu->execute([1]);
                while ($menu = $getMenu->fetch()) {?>
                  <li>         
                    <div class="form-group form-check pl-4">
                      <input type="hidden" value="<?php echo($menu->id)?>" name="menu_id1[]">
                      <input type="checkbox" name="menu_permission1[]" class="crmchk" id="dashboard">
                      <label class="form-check-label text-white" for="dashboard">
                        <?php echo $menu->menu_name?>
                      </label>
                    </div>
                  </li>
                </a>
              </li>
                <?php }
              }
            ?>
              <!-- <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="dashboard">
                <label class="form-check-label text-white" for="dashboard">Dashboard</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Orders">
                <label class="form-check-label text-white" for="Orders">Orders</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Suscribers">
                <label class="form-check-label text-white" for="Suscribers">Suscribers</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Customers">
                <label class="form-check-label text-white" for="Customers">Customers</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Invoices">
                <label class="form-check-label text-white" for="Invoices">Quotes and Invoices</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="chat">
                <label class="form-check-label text-white" for="chat">Live Chat</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Feedback">
                <label class="form-check-label text-white" for="Feedback">Customer Feedback</label>
              </div>
            </li> -->
          </ul>
      </div>
    </div>
  </div>
      <div class="accordion" id="accordionExample1">
      <h2 class="mb-0 ml-4">
        <input type="checkbox" name="" class="cmschkall">
        <a class="h6 text-white" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
          Customer Management System
        </a>
      </h2>

    <div id="collapseFour" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
      <div class="card-body">

          <ul>
            <?php 
              if (!is_file('no_delete.php')) {
                echo "A file is Missing";
              }else{
                
                $getMenu = $connect2db->prepare("SELECT * FROM menu WHERE level = ?");
                $getMenu->execute([2]);
                while ($menu = $getMenu->fetch()) {?>
                  <li>         
                    <div class="form-group form-check pl-4">
                      <input type="hidden" value="<?php echo($menu->id)?>" name="menu_id2[]">
                      <input type="checkbox" name="menu_permission2[]" class="cmschk" id="dashboard">
                      <label class="form-check-label text-white" for="dashboard">
                        <?php echo $menu->menu_name?>
                      </label>
                    </div>
                  </li>
                </a>
              </li>
                <?php }
              }
            ?>

              <!-- <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Pages">
                <label class="form-check-label text-white" for="Pages">Pages</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Blog">
                <label class="form-check-label text-white" for="Blog">Blog</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Product">
                <label class="form-check-label text-white" for="Product">Product</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Review">
                <label class="form-check-label text-white" for="Review">Review</label>
              </div>
            </li> -->
          </ul>
      </div>
    </div>
  </div>


  <!-- 22222222222222222222222222222222222222 -->
      <div class="accordion" id="accordionExample2">
      <h2 class="mb-0 ml-4">
        <input type="checkbox" name="" class="hrchkall">
        <a class="h6 text-white" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
          HR Management
        </a>
      </h2>

    <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample2">
      <div class="card-body">
          <ul>

            <?php 
              if (!is_file('no_delete.php')) {
                echo "A file is Missing";
              }else{
                
                $getMenu = $connect2db->prepare("SELECT * FROM menu WHERE level = ?");
                $getMenu->execute([3]);
                while ($menu = $getMenu->fetch()) {?>
                  <li>         
                    <div class="form-group form-check pl-4">
                      <input type="hidden" value="<?php echo($menu->id)?>" name="menu_id3[]">
                      <input type="checkbox" name="menu_permission3[]" class="hrchk" id="dashboard">
                      <label class="form-check-label text-white" for="dashboard">
                        <?php echo $menu->menu_name?>
                      </label>
                    </div>
                  </li>
                </a>
              </li>
                <?php }
              }
            ?>


              <!-- <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="managestaff">
                <label class="form-check-label text-white" for="managestaff">Manage Staff</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="staffs">
                <label class="form-check-label text-white" for="staffs">Staffs</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="ST">
                <label class="form-check-label text-white" for="ST">Shift & Time</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Salary">
                <label class="form-check-label text-white" for="Salary">Salary</label>
              </div>
            </li> -->
          </ul>
      </div>
    </div>
  </div>


  <!-- 33333333333333333333333333333333 -->
      <div class="accordion" id="accordionExample3">
      <h2 class="mb-0 ml-4">
        <input type="checkbox" name="" class="mutiChkall">
        <a class="h6 text-white" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
          Administration
        </a>
      </h2>

    <div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample3">
      <div class="card-body">
          <ul>
            <?php 
              if (!is_file('no_delete.php')) {
                echo "A file is Missing";
              }else{
                
                $getMenu = $connect2db->prepare("SELECT * FROM menu WHERE level = ?");
                $getMenu->execute([4]);
                while ($menu = $getMenu->fetch()) {?>
                  <li>         
                    <div class="form-group form-check pl-4">
                      <input type="hidden" value="<?php echo($menu->id)?>" name="menu_id4[]">
                      <input type="checkbox" name="menu_permission4[]" class="mutiChk" id="dashboard">
                      <label class="form-check-label text-white" for="dashboard">
                        <?php echo $menu->menu_name?>
                      </label>
                    </div>
                  </li>
                </a>
              </li>
                <?php }
              }
            ?>
              <!-- <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="manageusers">
                <label class="form-check-label text-white" for="manageusers">Manage Users</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="addUser">
                <label class="form-check-label text-white" for="addUser">Add a User</label>
              </div>
            </li>
            <li>         
                <div class="form-group form-check pl-4">
                <input type="checkbox" class="mutiChk" id="Payment">
                <label class="form-check-label text-white" for="Payment">Payment</label>
              </div>
            </li> -->
          </ul>
      </div>
    </div>
  </div>
  <!-- 44444444444444444444444444 -->
    <!-- ######################## MULTIPLE SELECT BOES ENDS HERE -->
  </div>
                </div>
              <hr>  
                 <h6 class="text-white mt-4 mb-3"> Job Information</h6>
                 <div id="Job-information-section"> 
              <div class="form-group row">
                <label for="job" class="col-sm-2 col-form-label">Job Application </label>
                <div class="col-sm-10">
                  <input type="text" name="job_app" class="form-control" id="inputPjobassword">
                </div>
              </div>
              <div class="form-group row">
                <label for="workPlace" class="col-sm-2 col-form-label">Workplace</label>
                <div class="col-sm-10">
                  <input type="text" name="workplace" class="form-control" id="workPlace">
                </div>
              </div>
              <div class="form-group row">
                <label for="salary" class="col-sm-2 col-form-label">Salary</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="salary" id="salary" value="$">
                </div>
              </div> 
                 </div>
              <hr>
               <h6 class="text-white mt-4 mb-3"> Shift Schedule </h6>
               <div id="shift-schedule"> 
                <table class="table">
                <thead style="background: #3A3A3A;color:#fff;border:0px">
                    <tr>
                      <th>Detail</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednessday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                </thead>
                <tbody>
                      <tr>
                          <th>Start Work </th>
                          <td><input type="time" name="sday1" value="" class="userTxt"></td>
                          <td><input type="time" name="sday2" value="" class="userTxt"></td>
                          <td><input type="time" name="sday3" value="" class="userTxt"></td>
                          <td><input type="time" name="sday4" value="" class="userTxt"></td>
                          <td><input type="time" name="sday5" value="" class="userTxt"></td>
                          <td><input type="time" name="sday6" value="" class="userTxt"></td>
                          <td><input type="time" name="sday7" value="" class="userTxt"></td>
                        </tr>
                      <tr>
                          <th>End Work </th>
                          <td><input type="time" name="eday1" value="" class="userTxt"></td>
                          <td><input type="time" name="eday2" value="" class="userTxt"></td>
                          <td><input type="time" name="eday3" value="" class="userTxt"></td>
                          <td><input type="time" name="eday4" value="" class="userTxt"></td>
                          <td><input type="time" name="eday5" value="" class="userTxt"></td>
                          <td><input type="time" name="eday6" value="" class="userTxt"></td>
                          <td><input type="time" name="eday7" value="" class="userTxt"></td>
                        </tr>
                  </tbody>
                  <tfoot style="background: #3A3A3A;color:#fff">
                </tfoot>
              </table>
               </div>
           </div>
        </form>
      </div><!--End Row-->

      <!-- Content End Here -->
    </div>
   </div>
<?php include 'footer.php';?>

<script type="text/javascript">
  $('.hrchkall').change(function(){
    $('.hrchk').prop("checked", $(this).prop("checked"))
  });

  $('.hrchk').change(function(){
    if ($(this).prop('checked')==false) {
      $('.hrchkall').prop("checked", false);
    }
    if ($(".hrchk:checked").length==$(".hrchk").length) {
      $('.hrchkall').prop("checked", true);
    }
  });


  $('.mutiChkall').change(function(){
    $('.mutiChk').prop("checked", $(this).prop("checked"))
  });

  $('.mutiChk').change(function(){
    if ($(this).prop('checked')==false) {
      $('.mutiChkall').prop("checked", false);
    }
    if ($(".mutiChk:checked").length==$(".mutiChk").length) {
      $('.mutiChkall').prop("checked", true);
    }
  });


  $('.cmschkall').change(function(){
    $('.cmschk').prop("checked", $(this).prop("checked"))
  });

  $('.cmschk').change(function(){
    if ($(this).prop('checked')==false) {
      $('.cmschkall').prop("checked", false);
    }
    if ($(".cmschk:checked").length==$(".cmschk").length) {
      $('.cmschkall').prop("checked", true);
    }
  });


  $('.crmchkall').change(function(){
    $('.crmchk').prop("checked", $(this).prop("checked"))
  });

  $('.crmchk').change(function(){
    if ($(this).prop('checked')==false) {
      $('.crmchkall').prop("checked", false);
    }
    if ($(".crmchk:checked").length==$(".crmchk").length) {
      $('.crmchkall').prop("checked", true);
    }
  });
</script>