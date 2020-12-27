<?php include 'header.php'; $image_own='images/photo.png';?>
<?php 
  if (is_file('no_delete.php')) {
    include'../includes/connection.php';
  }
  if(isset($_POST['editAboutPage'])){
        ################# CREATING TABLE WHICH DOES NOT EXIST #############
    include('assets/includes/createTable.php');
    ######################################
    
    $pname = 'About';
    $ptitle = $_POST['pageTitle'];
    isset($_POST['status'])?$status = 1: $status = 0;
    $user = $_SESSION['id'];

    // First Image Slidder
    // if (!file_exists('images/slidder')) {
    // mkdir('images/slidder', 0777, true);
    // }
      if (!is_dir('images/slidder')) {
          mkdir('images/slidder', 0777, true);
      }
    $path = 'images/slidder/';  
    $targetPathImage = $path . basename($_FILES['aboutBanner']['name']); 

    $file_name = $_FILES['aboutBanner']['name'];
    $file_tmp = $_FILES['aboutBanner']['tmp_name'];
    $file_size = $_FILES['aboutBanner']['size'];
    $file_error = $_FILES['aboutBanner']['error'];
    $file_type = $_FILES['aboutBanner']['type'];
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
           if(move_uploaded_file($_FILES['aboutBanner']['tmp_name'], $targetPathImage)){ 
              echo "<script>alert('Updated Successfully');</script>";
          }
        }else{
          echo "<script>alert('Failed to Upload');</script>";
        }
      }else{
        $insert = $connect2db->prepare("INSERT INTO pages (page_name,page_title,status, file1,uploaded_by) VALUES(?,?,?,?,?)");
        $insert->execute([$pname,$ptitle,$status,$name,$user]);
        if($insert){
           if(move_uploaded_file($_FILES['aboutBanner']['tmp_name'], $targetPathImage)){ 
              echo "<script>alert('Success');</script>";
          }
        }
        else{
          echo "<script>alert('Failed');</script>";
        }
      }
    }
}

// if(isset($_POST['addSponsorsBtn2324'])){  
//     ################# CREATING TABLE WHICH DOES NOT EXIST #############
//     include('assets/includes/createTableSponsor.php');
//     ######################################
//       if (!is_dir('images/sponsors')) {
//           mkdir('images/sponsors', 0777, true);
//       }
//     $id = $_SESSION['id'];
//     $target_dir = 'images/sponsors/';
//     // $allowTypes = array('jpg','png','jpeg'); 
//     $filename = $_FILES['sponsors']['name'];
//     $target_file = $target_dir . basename($_FILES['sponsors']['name']);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


//     // Check if file already exists
//     if (file_exists($target_file)) {
//         echo "<script>alert('Sorry, file already exists.')</script>";
//         $uploadOk = 0;
//     }

//     // Check file size
//     if ($_FILES["sponsors"]["size"] > 500000) {
//         echo "<script>alert('Sorry, File is too large.')</script>";
//         $uploadOk = 0;
//     }

//     // Allow certain file formats
//     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//         echo "<script>alert('Sorry, only JPG, JPEG, PNG files are allowed.')</script>";
//         $uploadOk = 0;
//     }

//     // Check if $uploadOk is set to 0 by an error
//     if ($uploadOk == 0) {
//       echo "<script>alert('Sorry, File not uploaded.')</script>";
//     // if everything is ok, try to upload file
//     } else {
//       if (move_uploaded_file($_FILES["sponsors"]["tmp_name"], $target_file)) {
//         $insert = $connect2db->prepare("INSERT INTO sponsors (file_name,uploaded_by) VALUES(?,?)");
//         $insert->execute([$target_file,$id]);
//           if($insert){
//               echo "<script>alert('Sponsor Added');</script>";
//             }else{
//               echo "<script>alert('Failed');</script>";
//             }
//       } else {
//           echo "<script>alert('Sorry, there was an error uploading file.')</script>";
//       }
//     }

// }
if(isset($_POST['addSponsorsBtn'])){
    ################# CREATING TABLE WHICH DOES NOT EXIST #############
    include('assets/includes/createTableSponsor.php');
    ######################################
      if (!is_dir('images/sponsors')) {
          mkdir('images/sponsors', 0777, true);
      }
    $id = $_SESSION['id'];
    $target_dir = 'images/sponsors/';

    $fileCount = count($_FILES['sponsors']['name']);
  
  for ($i=0; $i < $fileCount; $i++) { 
    $fileName = $_FILES['sponsors']['name'][$i];
    $target_file = $target_dir . basename($_FILES['sponsors']['name'][$i]);
    $imageFileType = $target_dir .basename($_FILES['sponsors']['type'][$i]);

    // Allow certain file formats
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['sponsors']['tmp_name'][$i]),
        array(
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'jpg' => 'image/jpg',
        ),
        true
    )) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG files are allowed.')</script>";
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.')</script>";
    }

    // Check file size
    elseif ($_FILES["sponsors"]["size"][$i] > 500000) {
        echo "<script>alert('Sorry, File is too large.')</script>";
    }

    else{

      if (move_uploaded_file($_FILES["sponsors"]["tmp_name"][$i], $target_file)) {
          $insert = $connect2db->prepare("INSERT INTO sponsors (file_name,uploaded_by) VALUES(?,?)");
          $insert->execute([$target_file,$id]);
        }
      }
    }
      if($insert){
      echo "<script>alert('Sponsor Added');</script>";
    }else{
        echo "<script>alert('Failed');</script>";
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
              <button type="submit" class="btn btn-primary" name="editAboutPage"> Save</button>
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
                        <input type="file"  name="aboutBanner" id="file" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="loadFile(event)">
                      </div>
                    </div>
                  </div>
                  
                </div>
              <hr>  
             <div class="row pr-4 mt-4">
              <div class="col-sm-10">
                <h6 class="text-white mb-3"> Sponsor</h6>
              </div>
              <div class="col-sm-2 text-right pr-3"> 

                <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#addSponsors">
                  <i class="fa fa-plus"></i> Add a Sponsor
                </button>
              </div>
             
              <hr>
              <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $del = $connect2db->query("DELETE FROM sponsors WHERE id='$id'");
                    if($del->execute()){
                        echo "<script>alert('Deleted');</script>";
                      }
                  }

                  $sel = $connect2db->prepare("SELECT * FROM sponsors");
                  $sel->execute();
                  
                  if($sel->rowCount() < 1){
                    echo "No Sponsor Available";}else{
                $select = $connect2db->query("SELECT * FROM sponsors");
                while ($row = $select->fetch()) {
              ?>
                <div class="col-sm-8 pl-3">
                  <div class="form-group"style="background:transparent;border-radius:5px;color:#DAC08E;width:90%;border:1px solid #fff">
                    <input type="text" readonly value="<?php echo ($row ->file_name); ?>" style="background:transparent;border:0px;padding-left: 20px;width:95%;color:#DAC08E">
                         <a href="edit-page-about.php?id=<?php echo $row->id; ?>"><i class="fa fa-trash" style="color:#DAC08E"></i></a>
                    </div>
                </div>
                <?php
                    }
                  }
                ?>
              </div>  
            </div>
               </div>
           </form>

         </div>
      </div><!--End Row-->

      <!-- Content End Here -->
    </div>
   </div>

<!--  Modals Goes here -->
<?php include ('modal/add-sponsors-modal.php') ?>

<?php include 'footer.php';?>