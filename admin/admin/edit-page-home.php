<?php if(is_file('no_delete.php')){
  include 'header.php'; $image_own='images/photo.png';
}?>
<?php 
  if (is_file('no_delete.php')) {
    include'../includes/connection.php';
  }
  if(isset($_POST['editHomePage'])){
    ################# CREATING TABLE WHICH DOES NOT EXIST #############
    include('assets/includes/createTable.php');
    ######################################
    $pname = 'Home';
    $ptitle = $_POST['pageTitle'];
    isset($_POST['status'])?$status = 1: $status = 0;
    $user = $_SESSION['id'];

    // First Image Slidder
    $path = 'images/slidder/';  
    $targetPathImage1 = $path . basename($_FILES['slidderOne']['name']); 
    $targetPathImage2 = $path . basename($_FILES['slidderTwo']['name']); 
    $targetPathImage3 = $path . basename($_FILES['slidderThree']['name']);  

    $slidder1 = $_FILES['slidderOne']['name'];
    $slidder1_tmp = $_FILES['slidderOne']['tmp_name'];
    $slidder1_size = $_FILES['slidderOne']['size'];
    $slidder1_error = $_FILES['slidderOne']['error'];
    $slidder1_type = $_FILES['slidderOne']['type'];
    $slidder1_ext = explode('.', $slidder1);
    $slidder1_act_ext = strtolower(end($slidder1_ext));

    // Second Image Slidder
    $slidder2 = $_FILES['slidderTwo']['name'];
    $slidder2_tmp = $_FILES['slidderTwo']['tmp_name'];
    $slidder2_size = $_FILES['slidderTwo']['size'];
    $slidder2_error = $_FILES['slidderTwo']['error'];
    $slidder2_type = $_FILES['slidderTwo']['type'];
    $slidder2_ext = explode('.', $slidder2);
    $slidder2_act_ext = strtolower(end($slidder2_ext));

    // Third Image Slidder

    $slidder3 = $_FILES['slidderThree']['name'];
    $slidder3_tmp = $_FILES['slidderThree']['tmp_name'];
    $slidder3_size = $_FILES['slidderThree']['size'];
    $slidder3_error = $_FILES['slidderThree']['error'];
    $slidder3_type = $_FILES['slidderThree']['type'];
    $slidder3_ext = explode('.', $slidder3);
    $slidder3_act_ext = strtolower(end($slidder3_ext));
    $allowTypes = array('jpg','png','jpeg'); 

    $name1 = $path.$slidder1;
    $name2 = $path.$slidder2;
    $name3 = $path.$slidder3;

    //  VALIDATIONS BEGINS FROM HERE
    if ($ptitle=="" OR $ptitle == " " OR empty($ptitle)) {
      echo "<script>alert('Page Title is required');</script>";
    }
    else if ($status=="" OR $status == " " OR empty($status)) {
      echo "<script>alert('Status is required');</script>";
    } 
    else if ($slidder1=="" OR $slidder1 == " " OR empty($slidder1)) {
      echo "<script>alert('Slidder One is required');</script>";
    }
    else if ($slidder2=="" OR $slidder2 == " " OR empty($slidder2)) {
      echo "<script>alert('Slidder Two is required');</script>";
    }
    else if ($slidder2=="" OR $slidder2 == " " OR empty($slidder2)) {
      echo "<script>alert('Slidder Three is required');</script>";
    }
  
  // Insertion takes place
    else{

      $sql = $connect2db->prepare("SELECT page_name, page_title FROM pages WHERE page_name='Home'");
      $sql->execute();
      $row = $sql->rowcount();
      if($row > 0){
        $update = $connect2db->prepare("UPDATE pages SET page_name='$pname',page_title='$ptitle',status='$status', file1='$name1',file2='$name2',file3='$name3',uploaded_by='$user'WHERE page_name='$pname' ");
        if($update->execute()){
           if(move_uploaded_file($_FILES['slidderOne']['tmp_name'], $targetPathImage1) && move_uploaded_file($_FILES['slidderTwo']['tmp_name'], $targetPathImage2) && move_uploaded_file($_FILES['slidderThree']['tmp_name'], $targetPathImage3)){ 
              echo "<script>alert('Updated Successfully');</script>";
          }
        }
        else{
          echo "<script>alert('Failed to Upload');</script>";
        }
      }else{
        $insert = $connect2db->prepare("INSERT INTO pages (page_name,page_title,status, file1,file2,file3,uploaded_by) VALUES(?,?,?,?,?,?,?)");
        $insert->execute([$pname,$ptitle,$status,$name1,$name2,$name3,$user]);
        if($insert){
           if(move_uploaded_file($_FILES['slidderOne']['tmp_name'], $targetPathImage1) && move_uploaded_file($_FILES['slidderTwo']['tmp_name'], $targetPathImage2) && move_uploaded_file($_FILES['slidderThree']['tmp_name'], $targetPathImage3)){ 
              echo "<script>alert('Success');</script>";
          }
        }
        else{
          echo "<script>alert('Failed');</script>";
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
        <form class="container" id="loginForm" enctype="multipart/form-data" method="POST">
          <div class="col-sm-12">
            <div class="alert text-right" role="alert">
              <button type="submit" class="btn btn-primary" name="editHomePage"> Save</button>
              <hr>
            </div>

              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label text-white">Enable Page</label>
                <div class="col-sm-10">
                  <input type="checkbox" name="status" checked class="js-switch" data-color="#DAC08E"/>
                  <span class="text-white"> Yes</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label text-white">Page Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="page-title" name="pageTitle">
                </div>
              </div>    
              <hr>
                <h6 class="text-white mt-4 mb-3"> Slidder Menu</h6>
                <div id="user-role-section" style="border: 1px solid #626567 ">
                  <div class="row">
                    <div class="col-sm-3">
                      <label for="file1" class="col-sm-12 col-form-label text-center" style="width:40px;height:120px"> <img class="form-control" src="<?php echo $image_own; ?>" style="height:100px;width:100px;" id="slidOne"/></label>
                      <div class="col-sm-10">
                        <input type="file"  name="slidderOne" id="file1" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="uploadSlid1(event)"/>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <label for="file2" class="col-sm-12 col-form-label text-center" style="width:40px;height:120px"> <img class="form-control" src="<?php echo $image_own; ?>" style="height:100px;width:100px;" id="slidTwo"/></label>
                      <div class="col-sm-10">
                        <input type="file"  name="slidderTwo" id="file2" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="loadSlid2(event)" />
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <label for="file3" class="col-sm-12 col-form-label text-center" style="width:40px;height:120px"> <img class="form-control" src="<?php echo $image_own; ?>" style="height:100px;width:100px;" id="slidThree"/></label>
                      <div class="col-sm-10">
                        <input type="file"  name="slidderThree" id="file3" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="uploadSlidder(event)"/>
                      </div>
                    </div>
                  </div>
                  
                </div>
              <hr>  
 
               </div>
           </form>

         </div>
      </div><!--End Row-->

      <!-- Content End Here -->
    </div>
   </div>
<?php include 'footer.php';?>