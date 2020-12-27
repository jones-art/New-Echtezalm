<?php include 'header.php';?>
<?php
// Getting Data Before Updating
if(isset($_GET['sid']) && $_GET['sid'] != ''){
include '../includes/connection.php';
    $id = $_GET['sid'];
    // Selecting logged time within the week 
    // $query = "SELECT user_id, sum(time) as weekTime FROM tbl_activity WHERE date between date_sub(now(),INTERVAL 1 WEEK) and now()";
    // $query = "SELECT * FROM tbl_activity WHERE YEARWEEK(date) = YEARWEEK(NOW())";
    // $query = "SELECT * FROM tbl_activity WHERE date > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $queryWeek = $connect2db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(time))) as timespent FROM tbl_activity WHERE user_id= '$id' AND YEARWEEK(date) = YEARWEEK(NOW()) ORDER BY `id` DESC");
    $wk = $queryWeek->fetch();
    $totalWeekLog = $wk->timespent;

    // Selecting logged in time in a month 
    $queryMonth = $connect2db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(time))) as timespent FROM tbl_activity WHERE user_id= '$id' AND MONTH(date) = MONTH(NOW()) ORDER BY `id` DESC");
    $mn = $queryMonth->fetch();
    $totalMonthLog = $mn->timespent;

    // Total Logged In time
    $twt = $connect2db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(time))) as timespent FROM tbl_activity WHERE user_id= '$id' ORDER BY `id` DESC");
    // $total = strtotime($totalWeekLog) - strtotime("00:00:00");
    // $totalTime = date("H:i:s",strtotime($totalMonthLog)+$total);
    $wholeTime = $twt->fetch();
    $wholeTimeLog = $wholeTime->timespent;

    // Selecting User Data in General
    $select = $connect2db->query("SELECT * FROM users WHERE id= '" . (int)$_GET['sid'] . "'");
    if($row = $select->fetch()){
    $username = $row->username;
    $firstName =$row->fname;
    $lastName= $row->lname;
    $email = $row->email;
    $password = $row->password;
    $country = $row->country;
    $sex = $row->sex;
    $dob = $row->dob;
    $role = $row->role;
    $joined = $row->joined;
    $status = $row->status;
  }
}
?>
<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
    	<!-- Content Start-->
    	<br><br><br>

    	<div class="row mt-3">
       
    		<!-- LEFT COLOUMN DIV START HERE -->
    		<div class="col-12 col-lg-8 col-xl-8">
           <h6 class="text-muted"> Staff Data </h6>
    			<div class="row">
    				<div class="col-12 col-lg-6 col-xl-4">
          <div class="card" style="background: #3A3A3A;">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
              	<span class="text-muted">This Week Logged Time</span>
                <h4 class="text-white"><?php if($totalWeekLog ==''){echo '<p class=text-danger>Not yet logged in</p>';}else{echo $totalWeekLog;}?></h4>
              </div>
              <!-- <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                <i class="icon-basket-loaded text-white"></i></div> -->
            </div>
            </div>
          </div>
        </div>

         <div class="col-12 col-lg-6 col-xl-4">
          <div class="card" style="background: #3A3A3A;">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
              	<span class="text-muted">This Month Logged Time</span>
                <h4 class="text-white"><?php if($totalWeekLog ==''){echo '<p class=text-danger>Not yet logged in</p>';}else{echo $totalMonthLog;}?></h4>
              </div>
              <!-- <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                <i class="icon-basket-loaded text-white"></i></div> -->
            </div>
            </div>
          </div>
        </div>

         <div class="col-12 col-lg-6 col-xl-4">
          <div class="card" style="background: #3A3A3A;">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
              	<span class="text-muted">Total Logged Time</span>
                <h4 class="text-white"><?php if($totalWeekLog ==''){echo '<p class=text-danger>Not yet logged in</p>';}else{echo $wholeTimeLog; }?></h4>
              </div>
              
            </div>
            </div>
          </div>
        </div> 
        <!--  ############################### -->
<div class="container">
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php if(empty($username)){echo ' -- --';}else{echo $username; }?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $firstName; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $lastName; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $email; ?></label>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                 <label class="col-sm-10 text-white col-form-label"> <?php echo $password; ?></label>
                </div>
              </div>
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $country; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">Sex</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $sex; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $dob; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $role; ?></label>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">Joined</label>
                <div class="col-sm-10">
                 <label class="col-sm-10 text-white col-form-label"> <?php echo $joined; ?></label>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">User Status </label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php if($status ==1){echo 'Active';}else{echo 'Pending';} ?></label>
                </div>
              </div>
</div>  
    
<!-- LEFT COLOUMN DIV ENDS HERE -->

<!--     		<div class="col-12 col-lg-4 col-xl-4">
    			<div id='calendar'>
    				<div class="card">
    					<div class="card-header"> Calender</div>
    					<div class="card-body">
    						<h4> CALENDER </h4>
    					</div>
    				</div>
    			</div>
    		</div> -->
      	</div><!--End Row-->
<?php
// $sq = $connect2db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(time))) as timespent FROM tbl_activity WHERE MONTH(date) = MONTH(NOW()) ORDER BY `id` DESC");
// $sq = $connect2db->query("SELECT * FROM tbl_activity WHERE user_id='$id'");
// echo '<br>'.'LOOP START FROM HERE';
// while ($r = $sq->fetch()){
//   echo "<br>".$r->date . "<br>";
// }
?>
    	<!-- Content End Here -->
    </div>
   </div>
<?php include 'footer.php';?>
