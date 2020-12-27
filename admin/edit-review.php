<?php include 'header.php'; $img_src = 'images/photo.png';?>
<?php
  if (isset($_POST['addReview'])) {
// ###################### CREATING TABLE REVIEW IF NOT EXIST IN DATABASE #########
    include('assets/includes/createTableReview.php');

    $prd_name = trim($_POST['prd_name']);
    $prd_customer = trim($_POST['prd_customer']);
    $prd_status = trim($_POST['prd_status']);
    $prd_visibility = trim($_POST['prd_visibility']);
    $prd_review = trim($_POST['prd_review']);
    $prd_title = trim($_POST['prd_title']);

    $imageName = $_FILES['image']['name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = $_FILES['image']['type'];
    $imageTemp = $_FILES['image']['tmp_name'];

    $date = date('Y-m-d');
    $id = $_SESSION['id'];

    if ($prd_name =="" OR $prd_name==" " OR empty($prd_name)) {
      echo "<script>alert('Product Name is Required');</script>";
    } else if ($prd_customer =="" OR $prd_customer==" " OR empty($prd_customer)) {
      echo "<script>alert('Customer Name is Required');</script>";
    } else if ($prd_status =="" OR $prd_status==" " OR empty($prd_status)) {
      echo "<script>alert('Product Status is Required');</script>";
    } else if ($prd_visibility =="" OR $prd_visibility==" " OR empty($prd_visibility)) {
      echo "<script>alert('Visibility Field is Required');</script>";
    } else if ($imageName =="" OR $imageName==" " OR empty($imageName)) {
      echo "<script>alert('Product Image is Required');</script>";
    }else if ($prd_title =="" OR $prd_title==" " OR empty($prd_title)) {
      echo "<script>alert('Review Title is Required');</script>";
    } else if ($prd_review  =="" OR $prd_review ==" " OR empty($prd_review )) {
      echo "<script>alert('Product Review is Required');</script>";
    }

    else{
      $type = explode('.', $imageName);
        $type = strtolower(end($type));
        $allow = ['jpg', 'png', 'jpeg'];
        $imageName = $prd_title.".".$type;
        if (in_array($type, $allow)) {
          if (!is_dir('review')) {
            mkdir('review');
          }
          if (move_uploaded_file($imageTemp, 'review/'.$imageName)) {
            $addProduct = $connect2db->prepare("INSERT INTO review (review_title, name, customer_name, rating, visibility, review, status, created_by, created, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");
          $query = $addProduct->execute([$prd_title, $prd_name, $prd_customer, 'rating', $prd_visibility, $prd_review, $prd_status, $id, $date, $imageName]);
          $query ?
          print "<script>alert('Review Successfully Added');</script>":
          print "<script>alert('Error Creating Review, Please Try Again');</script>";
          } else{
          echo "<script>alert('Review Folder Missing');</script>";
        }
        }

        else{
          echo "<script>alert('File type not Acceptable');</script>";
        }
      
      
     }

  }
// Updating Data
if(isset($_GET['rid'])){
  if(isset($_POST['update'])){
 // Blog Parameters goes thus

    $prd_name = trim($_POST['prd_name']);
    $prd_customer = trim($_POST['prd_customer']);
    $prd_status = trim($_POST['prd_status']);
    $prd_visibility = trim($_POST['prd_visibility']);
    $prd_review = trim($_POST['prd_review']);
    $prd_title = trim($_POST['prd_title']);

    $date = date('Y-m-d');
    $id = $_SESSION['id'];

    // Checking if image is uploaded before updating data
    if(!isset($_POST['image']) && empty($_FILES['image']['name']) && $_FILES['image']['name']==""){
        $update=$connect2db->prepare("UPDATE review SET 
          review_title='$prd_title', 
          name = '$prd_name',
          customer_name='$prd_customer', 
          rating='def', 
          status='$prd_status',
          visibility='$prd_visibility', 
          review='$prd_review', 
          created_by='$id',
          created='$date' WHERE id= '" . (int)$_GET['rid'] . "' 
          "); 
          if($update->execute()){
            echo "<script> alert('Updated Without Review Image');</script>";
          }
    }
    if(isset($_FILES['image']['name'])){
      $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];
        $imageTemp = $_FILES['image']['tmp_name'];

      // Product parameters end here
      $type = explode('.', $imageName);
        $type = strtolower(end($type));
        $allow = ['jpg', 'png', 'jpeg', 'JPG'];
        $imageName = $cdetail.".".$type;
        if (in_array($type, $allow)) {
        if (move_uploaded_file($imageTemp, 'review/'.$imageName)) {
            $update=$connect2db->prepare("UPDATE review SET 
              review_title='$prd_title', 
              name = '$prd_name',
              customer_name='$prd_customer', 
              rating='def', 
              image='$imageName',
              status='$prd_status',
              visibility='$prd_visibility', 
              review='$prd_review', 
              created_by='$id',
              created='$date' WHERE id= '" . (int)$_GET['rid'] . "' 
              ");  
              if($update->execute()){
                echo "<script> alert('Updated Successfully With Review Image');</script>";
              }else{  
              echo "<script>alert('Collection Folder Missing');</script>";
            }
        }else{
          echo "<script>alert('File type not Acceptable');</script>";
        }
      }
      }
  }

}
// Getting Data Before Updating
if(isset($_GET['rid']) && $_GET['rid'] != ''){
    $id = $_GET['rid'];
    $select = $connect2db->query("SELECT * FROM review WHERE id= '" . (int)$_GET['rid'] . "'");
    if($row = $select->fetch()){
    $title= $row->review_title;
    $name =$row->name;
    $customer = $row->customer_name ;
    $rating = $row->rating;
    $image = 'review/'.$row->image;
    $status = $row->status;
    $visibility = $row->visibility;
    $review = $row->review;
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
              <a href="review.php" class="btn btn-primary"> back</a>
              <?php
              if(isset($_GET['rid'])){?>
              <button type="submit" class="btn btn-primary" name="update"> Update </button>
              <?php
                }else{?>
                  <button type="submit" class="btn btn-primary" name="addReview"> Submit </button><?php }?>
              <hr>
            </div>

              <div class="form-group row">
                <label for="blog-title" class="col-sm-2 col-form-label text-white">Product Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="prd_name" value="<?php if(isset($_GET['rid']) && $_GET['rid'] != ''){echo $name;} ?>" readonly style="color:#DAC08E;background:transparent">
                </div>
              </div>
              <div class="form-group row">
                <label for="meta-keyword" class="col-sm-2 col-form-label text-white">Customer Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control text-white" name="prd_customer" value="<?php if(isset($_GET['rid']) && $_GET['rid'] != ''){echo $customer;} ?>" readonly style="background:transparent">
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label text-white">Rating</label>
                <div class="col-sm-10">
                  
                </div>
              </div>
              <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label text-white">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" name="prd_status">
                      <option selected value="0"> -- Select Status-- </option>
                      <option <?php if(isset($_GET['rid']) && $_GET['rid'] != ''){if($status == 'Pending'){echo 'selected';}} ?>> Pending</option>
                      <option <?php if(isset($_GET['rid']) && $_GET['rid'] != ''){if($status == 'Active'){echo 'selected';}} ?>> Active</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label text-white">Visibility</label>
                <div class="col-sm-10">
                  <select class="form-control" name="prd_visibility">
                    <option selected value="0"> -- Visibility --</option>
                    <option <?php if(isset($_GET['rid']) && $_GET['rid'] != ''){if($visibility == 'Product Page'){echo 'selected';}} ?>> Product Page</option>
                    <option <?php if(isset($_GET['rid']) && $_GET['rid'] != ''){if($visibility == 'Active'){echo 'selected';}} ?>> Active</option>
                  </select>
                </div>
              </div>	
              <hr class="mt-4 mb-3">
              <h6 class="text-white mt-4 mb-3"> Images </h6>
              <div class="form-group row">
                <label for="file" class="col-sm-2 col-form-label text-center" style="width:40px;height:120px"> <img class="form-control" for="file" src="<?php if(isset($_GET['rid']) && $_GET['rid'] != ''){echo $image;}else{echo$img_src;} ?>" style="height:100px;width:100px;" id="output"/></label>
                <div class="col-sm-10">
                  <input type="file"  name="image" id="file" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="loadFile(event)">
                </div>
              </div>
              <div class="form-group row mt-4">
                <label for="tag" class="col-sm-10 col-form-label text-white">Title of review</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" value="<?php if(isset($_GET['rid']) && $_GET['rid'] != ''){echo $title;} ?>" name="prd_title" style="width:75%">
                </div>
              </div> 
              <div class="form-group row mb-3">
                <div class="col-sm-10">
                  <h6 class="text-white mt-4 mb-3 text-white"> Review</h6>
                    <textarea class="form-control" name="prd_review" id="description" placeholder="Message body" ><?php if(isset($_GET['rid']) && $_GET['rid'] != ''){echo $review;}?></textarea>
              </div>
            </div>
    <!-- ######################## MULTIPLE SELECT BOES ENDS HERE -->
   
        </form>
      </div><!--End Row-->

    	<!-- Content End Here -->
    </div>
   </div>
<?php include 'footer.php';?>