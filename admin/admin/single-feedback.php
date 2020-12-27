<?php include 'header.php';?>
<?php
// Getting Data Before Updating
if(isset($_GET['sid']) && $_GET['sid'] != ''){

  $id = $_GET['sid'];

  $getDatas = $connect2db->prepare("SELECT * FROM feedback WHERE id = ?");
  $getDatas->execute([$id]);
  if ($getDatas->rowcount() > 0) {
    $data = $getDatas->fetch();
    $name = $data->name;
    $email = $data->email;
    $pnum = $data->pnum;
    $desc= $data->message;
  }else{
    $name = '---------';
    $email = '---------';
    $pnum = '---------';
    $desc= '---------';
  }

}

if (isset($_POST['delete'])) {
  $delete = $connect2db->prepare("DELETE FROM feedback WHERE id = ?");
  if ($delete->execute([$id])) {
    echo "<script>alert('Deleted');window.location='feedback.php';</script>";
  }
}
?>
<style type="text/css">
  div.text-white{
    font-family: Poppins;
font-style: normal;
font-weight: 300;
font-size: 18px;
line-height: 27px;
text-transform: lowercase;
  }
</style>
<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
    	<!-- Content Start-->
    	<br><br><br>

    	<div class="text-right row" style="padding-bottom:58px;">
        <div class="col-sm-12 ">
          <form method="POST" action="">
            <button class="btn btn-primary" name="delete" type="submit">Delete</button>
          </form>
        </div> 
      </div>
        <!--  ############################### -->
<div class="container">
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php if(empty($name)){echo ' -- --';}else{echo $name; }?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $email; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $pnum; ?> </label>
                </div>
              </div>
              

              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                  <label class="col-sm-10 text-white col-form-label"> <?php echo $desc;?></label>
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
