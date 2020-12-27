<?php include 'header.php'; $image_own='images/photo.png';?>
<?php 
  if (is_file('no_delete.php')) {
    include'../includes/connection.php';
  }
  if(isset($_POST['editWebshopPage'])){
        ################# CREATING TABLE WHICH DOES NOT EXIST #############
    include('assets/includes/createTable.php');
    ######################################
    
    $pname = 'Webshop';
    $ptitle = $_POST['pageTitle'];
    isset($_POST['status'])?$status = 1: $status = 0;
    $user = $_SESSION['id'];

    // First Image Slidder
    $path = 'images/slidder/';  
    $targetPathImage = $path . basename($_FILES['webshoBanner']['name']); 

    $file_name = $_FILES['webshoBanner']['name'];
    $file_tmp = $_FILES['webshoBanner']['tmp_name'];
    $file_size = $_FILES['webshoBanner']['size'];
    $file_error = $_FILES['webshoBanner']['error'];
    $file_type = $_FILES['webshoBanner']['type'];
    $file_ext = explode('.', $file_name);
    $file_act_ext = strtolower(end($file_ext));
    // $allowed = ['jpeg'];
    $allowTypes = array('jpg','png','jpeg'); 

    $name = $path.$file_name;

    //  VALIDATIONS BEGINS FROM HERE
    if ($ptitle=="" OR $ptitle == " " OR empty($ptitle)) {
      echo "<script>alert('Page Title is required');</script>";
    }
    else if ($status=="" OR $status == " " OR empty($status)) {
      echo "<script>alert('Status is required');</script>";
    } 
    else if ($file_name=="" OR $file_name == " " OR empty($file_name)) {
      echo "<script>alert('Web Banner is required');</script>";
    }       
    else if(!in_array($file_act_ext, $allowTypes)){
        echo "<script>alert('Format not supported');</script>";
      }
      else if($file_error !=0){
        echo "<script>alert('Image size shouldn't be more than 2mb');</script>";
      }
      else if($file_size > 50000000){
        echo "<script>alert('File too large');</script>"; 
      }
      // Insertion takes place
    else{

      $sql = $connect2db->prepare("SELECT page_name, page_title FROM pages WHERE page_name='Webshop'");
      $sql->execute();
      $row = $sql->rowcount();
      if($row > 0){
        $update = $connect2db->prepare("UPDATE pages SET page_name='$pname',page_title='$ptitle',status='$status', file1='$name',uploaded_by='$user' WHERE page_name='$pname' ");
        if($update->execute()){
           if(move_uploaded_file($_FILES['webshoBanner']['tmp_name'], $targetPathImage)){ 
              echo "<script>alert('Updated Successfully');</script>";
          }
        }else{
          echo "<script>alert('Failed to Upload');</script>";
        }
      }else{
        $insert = $connect2db->prepare("INSERT INTO pages (page_name,page_title,status, file1,uploaded_by) VALUES(?,?,?,?,?)");
        $insert->execute([$pname,$ptitle,$status,$name,$user]);
        if($insert){
           if(move_uploaded_file($_FILES['webshoBanner']['tmp_name'], $targetPathImage)){ 
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
        <form class="container" id="loginForm" method="POST" enctype="multipart/form-data">
          <div class="col-sm-12">
            <div class="alert text-right" role="alert">
              <button type="submit" class="btn btn-primary" name="editWebshopPage"> Save</button>
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
                <h6 class="text-white mt-4 mb-3"> Web Banner</h6>
                <div id="user-role-section" style="border: 1px solid #626567 ">
                  <div class="row">
                    <div class="col-sm-3 py-3 my-3">
                      <label for="file" class="col-sm-2 col-form-label text-center" style="width:40px;height:120px"> <img class="form-control" for="file" src="<?php echo $image_own; ?>" style="height:100px;width:100px;" id="output"/></label>
                      <div class="col-sm-10">
                        <input type="file"  name="webshoBanner" id="file" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="loadFile(event)">
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