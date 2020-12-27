<?php include 'header.php';?>
<?php
include '../includes/connection.php';
$sql = $connect2db->query("SELECT count(id) as id FROM users WHERE role = 'Admin'");
$staff = $sql->fetch();
$curDay = date('D');
// echo $curDay;
$getOffUsers = $connect2db->prepare("SELECT count(id) AS off FROM job_shift WHERE $curDay = ?");
$getOffUsers->execute(['Off day']);
$offUsers = $getOffUsers->fetch();
$totalOff = $offUsers->off;

$getcurUsers = $connect2db->prepare("SELECT count(id) AS cur FROM job_shift WHERE $curDay != ?");
$getcurUsers->execute(['Off day']);
$curUsers = $getcurUsers->fetch();
$totalcur = $curUsers->cur;

// Creating Holiday
  if(isset($_POST['addHoliday'])){
    // Creating table Holiday if not exist 
    include('assets/includes/createTableHoliday.php');  
    // Declaring parameters
    $name = trim($_POST['holidayName']);
    $dateHoliday = trim($_POST['holidayDate']);
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $id = $_SESSION['id'];
    if ($name =="" OR $name==" " OR empty($name)) {
      echo "<script>alert('Holiday Title is Required');</script>";
    } else if ($dateHoliday =="" OR $dateHoliday==" " OR empty($dateHoliday)) {
      echo "<script>alert('Holiday Date is Required');</script>";
    } 
    else{
      $sql = $connect2db->query("SELECT count(id) as id FROM tbl_holiday WHERE holiday_name='$name' AND date='$dateHoliday'");
      $count = $sql->fetch();
      if($count->id > 0){
          echo "<script>alert('Holiday Exist for the Year');</script>";
      }else{
        $insert = $connect2db->prepare("INSERT INTO tbl_holiday(holiday_name,date,created_on,created_by) VALUES(?,?,?,?)");
        $q_insert = $insert->execute([$name,$dateHoliday,$date,$id]);
        if($q_insert){
          $act = $connect2db->prepare("INSERT INTO tbl_activity(user_id,activity,time,date) VALUES(?,?,?,?)");
          $act->execute([$id,'Created holiday '.$name,$time,$date]);
          echo "<script>alert('Holiday'". $name ."'Successfully Created');</script>";
        }else{
          echo "<script>alert('Failed to create holiday' $name);</script>";
        }
      }
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
    			<div class="row">
    				<div class="col-12 col-lg-6 col-xl-4">
                <div class="card" style="background: #3A3A3A;">
                  <div class="card-body">
                    <div class="media">
                    <div class="media-body text-left">
                    	<span class="text-muted">Total Staff</span>
                      <h4 class="text-white"><?php echo $staff->id;?></h4>
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
                    	<span class="text-muted">Working Today</span>
                      <h4 class="text-white"><?php echo($totalcur) ?></h4>
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
                    	<span class="text-muted">Off duty</span>
                      <h4 class="text-white"><?php echo($totalOff) ?></h4>
                    </div>
                    
                  </div>
                  </div>
                </div>
              </div> 
              <h5 class="text-white mt-3 mb-3 text-left ml-3"> Recent Activities</h5>
            </div>

<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<div class="accordion" id="accordionExample" style="border: 1px solid #3A3A3A">
      <h2 class="mb-0 pl-4" style="background: #3A3A3A;">
        <div class="row">
          <div class="col-sm-8">
            <a class="h6 text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Activity 
          </div>
          <div class="col-sm-4 pl-0">
            <label class="h6 text-white" style="font-size: 13px">Date and Time </label>
          </a>
          </div>
        </div>
      </h2>

<!--       <h2 class="mb-0">
        <button class="text-white text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Activity
        </button>
        Date and Time
      </h2> -->

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body" style="overflow:scroll;max-height:300px">
      <?php 
        $id = $_SESSION['id'];
        $act = $connect2db->query("SELECT * FROM tbl_activity");
        while($userAct = $act->fetch()){
      ?>
        <div class="row">
          <div class="col-sm-8">
            <h6 class="text-muted"> 
              <?php $s = $connect2db->query("SELECT * FROM users WHERE id='$id'");
                $t = $s->fetch();
                echo $t->fname;
              ?>
              <?php echo $userAct->activity;?></h6>
          </div>
          <div class="col-sm-4">
            <p class="text-muted"><?php echo $userAct->date . ' | ' . $userAct->time;?></p>
          </div>
        </div>
      <?php }?>
<!--           <div class="col-sm-8">
            <h6 class="text-muted"> John Logged In</h6>
          </div>
          <div class="col-sm-4">
            <p class="text-muted">14 Feb 2020 | 15:20:25</p>
          </div>
          <div class="col-sm-8">
            <h6 class="text-muted"> John Logged In</h6>
          </div>
          <div class="col-sm-4">
            <p class="text-muted">14 Feb 2020 | 15:20:25</p>
          </div>
        </div> -->
      </div>
    </div>
</div>

          </div>
        <!--  ############################### -->
  <!-- LEFT COLOUMN DIV ENDS HERE -->

        <div class="col-12 col-lg-4 col-xl-4">
<div class="row mt-4 mb-3">
  <div class="col-sm-8">
    <h6 class="text-muted">Upcoming Holidays</h6>
  </div>
  <div class="col-sm-2 text-right">
    <a type="button" data-toggle="modal" data-target="#addHoliday">
        <i class="fa fa-plus text-white"></i>
    </a>
  </div>
</div>
<div class="accordion" id="accordionExample" style="border: 1px solid #3A3A3A">
      <h2 class="mb-0 pl-4" style="background: #3A3A3A;">
        <div class="row">
          <div class="col-sm-5">
            <a class="h6 text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Date 
          </div>
          <div class="col-sm-7">
            <label class="h6 text-white" style="font-size: 13px"> Holiday Name </label>
          </a>
          </div>
        </div>
      </h2>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body" style="overflow:scroll;max-height:440px">
      <?php 
        $holidayRst = $connect2db->prepare("SELECT * FROM tbl_holiday ");
        $holidayRst->execute();
        while($ho = $holidayRst->fetch()){
      ?>
        <div class="row">
          <div class="col-sm-5">
            <h6 class="text-muted"> <?php echo$ho->date;?></h6>
          </div>
          <div class="col-sm-7">
            <p class="text-muted pl-2"><?php echo$ho->holiday_name;?></p>
          </div>
        </div>
      <?php }?>
      </div>
    </div>
</div>

        </div>
<!-- ############################################ -->

   </div>
  </div>
</div>


<!--  Modals Goes here -->
<?php include ('modal/add-holiday-modal.php') ?>
<!-- 


    			</div>
    		</div>

      	</div>End Row

    Content End Here -->
    <!--   </div>
   </div> -->
<?php include 'footer.php';?>
