<?php include 'header.php';?>
<?php 
$img_src = 'images/photo.png';
  if (is_file('no_delete.php')) {
    include'../includes/connection.php';
  }

  if(isset($_POST['addNewBlog'])){
            ################# CREATING TABLE WHICH DOES NOT EXIST #############
    include('assets/includes/createTableBlog.php');
    ######################################
    // Declaring post variable
    $bTitle = trim($_POST['blogTitle']);
    $bKeyword = trim($_POST['metaKeyword']);
    $bDescription = trim($_POST['description']);
    $bContent = trim($_POST['blog_content']);
    $bTag = trim($_POST['tag']);
    // Declaring post variables ends here

        ################# CREATING TABLE WHICH DOES NOT EXIST #############
    include('assets/includes/createTableBlog.php');
    ######################################
    
    $user = $_SESSION['id'];
    $imageName = $_FILES['image']['name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = $_FILES['image']['type'];
    $imageTemp = $_FILES['image']['tmp_name'];

    //  VALIDATIONS BEGINS FROM HERE
    if ($bTitle=="" OR $bTitle == " " OR empty($bTitle)) {
      echo "<script>alert('Blog Title is required');</script>";
    }
    else if ($bKeyword=="" OR $bKeyword == " " OR empty($bKeyword)) {
      echo "<script>alert('keyword field is required');</script>";
    } 
    else if ($bDescription=="" OR $bDescription == " " OR empty($bDescription)) {
      echo "<script>alert('Blog description is required');</script>";
    }     
    else if ($bContent=="" OR $bContent == " " OR empty($bContent)) {
      echo "<script>alert('Blog content is required');</script>";
    }   
    else if ($bTag=="" OR $bTag == " " OR empty($bTag)) {
      echo "<script>alert('Tag field is required');</script>";
    } 
    else if ($imageName =="" OR $imageName==" " OR empty($imageName)) {
      echo "<script>alert('Blog Image is Required');</script>";
    } 
      else{

        $type = explode('.', $imageName);
        $type = strtolower(end($type));
        $allow = ['jpg', 'png', 'jpeg'];
        $imageName = $bTitle.".".$type;
        if (in_array($type, $allow)) {
      // Insertion takes place
          if (!is_dir('blog')) {
            mkdir('blog');
          }
          if (move_uploaded_file($imageTemp, 'blog/'.$imageName)) {
            $insert = $connect2db->prepare("INSERT INTO blog (blog_title,meta_keyword,meta_description,content,image,tag,created_by) VALUES(?,?,?,?,?,?,?)");
            $insert->execute([$bTitle,$bKeyword,$bDescription,$bContent,$imageName,$bTag,$user]);
            if($insert){
                  echo "<script>alert('Blog Created');</script>";
            }
            else{
              echo "<script>alert('Failed to create blog');</script>";
            }
          }else{
            echo "<script>alert('Blog Folder Missing');</script>";
          }
      }else{
        echo "<script>alert('File type not Acceptable');</script>";
      }
    }
}

// Updating Data
  if(isset($_GET['eid'])){
      if(isset($_POST['update'])){
      // Declaring post variable
      $bTitle = trim($_POST['blogTitle']);
      $bKeyword = trim($_POST['metaKeyword']);
      $bDescription = trim($_POST['description']);
      $bContent = trim($_POST['blog_content']);
      $bTag = trim($_POST['tag']);
      // Declaring post variables ends here
        $user = $_SESSION['id'];
        // Checking if image is uploaded before updating data
    if(!isset($_POST['image']) && empty($_FILES['image']['name']) && $_FILES['image']['name']==""){
        $update=$connect2db->prepare("UPDATE blog SET 
          blog_title='$bTitle ', 
          meta_keyword='$bKeyword', 
          meta_description='$bDescription', 
          content='$bContent',
          tag='$bTag', 
          created_by='$user' WHERE id= '" . (int)$_GET['eid'] . "' 
          "); 
          if($update->execute()){
            echo "<script> alert('Updated, No Change in Image');</script>";
          }
      }
    }
    if(isset($_FILES['image']['name'])){
        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];
        $imageTemp = $_FILES['image']['tmp_name'];

        $type = explode('.', $imageName);
        $type = strtolower(end($type));
        $allow = ['jpg', 'png', 'jpeg'];
        $imageName = $bTitle.".".$type;  

        if (in_array($type, $allow)) {
        if (move_uploaded_file($imageTemp, 'blog/'.$imageName)) {
        $update=$connect2db->prepare("UPDATE blog SET 
          blog_title='$bTitle ', 
          meta_keyword='$bKeyword', 
          meta_description='$bDescription', 
          content='$bContent',
          image = '$imageName',
          tag='$bTag', 
          created_by='$user' WHERE id= '" . (int)$_GET['eid'] . "' 
          "); 
            if($update->execute()){
              echo "<script> alert('Updated With Blog Image');</script>";
            }
          }
        }else{
          echo "<script>alert('File type not Acceptable');</script>";
        }
    }
  }
// Getting Data Before Updating
if(isset($_GET['eid']) && $_GET['eid'] != ''){
    $id = $_GET['eid'];
    $select = $connect2db->query("SELECT * FROM blog WHERE id= '" . (int)$_GET['eid'] . "'");
    if($row = $select->fetch()){
    $title = $row->blog_title;
    $keyword = $row->meta_keyword;
    $description = $row->meta_description;
    $content = $row->content;
    $tag = $row->tag;
    $b_image = $row->image;
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
              <a href="blog.php" class="btn btn-primary"> back</a>
              <?php
              if(isset($_GET['eid'])){?>
                <button type="submit" class="btn btn-primary" name="update"> Update</button>
                <?php
              }else{?>
              <button type="submit" class="btn btn-primary" name="addNewBlog"> Save</button>
              <?php }?>
              <hr>
            </div>

              <div class="form-group row">
                <label for="blog-title" class="col-sm-2 col-form-label text-white">Blog Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="blogTitle" name="blogTitle" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $title;} ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="meta-keyword" class="col-sm-2 col-form-label text-white">Meta Kaywords</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="metaKeyword" name="metaKeyword"value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $keyword;} ?>"/>
                </div>
              </div> 
              <div class="form-group row">
                <label for="metaDescription" class="col-sm-2 col-form-label text-white">Meta Description</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="metaDescription" name="description" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $description;} ?>"/>
                </div>
              </div>
              <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label text-white">Content</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="blog_content">
                    <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $content;} ?>
                  </textarea>
                </div>
              </div>
              <div class="form-group row">  
                <label for="file" class="col-sm-2 col-form-label text-white">Image</label>
                <div class="col-sm-10">
                    <label for="prdImg" class="span" style="border:1px solid #fff;">
                      <img id="output" src="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo 'blog/'.$b_image;}else{echo$img_src;} ?>" style="width:100px;height:100px;padding: 5px">
                    </label>
                    <input type="file" name="image"  style="border:1px solid #fff;visibility:hidden;" id="prdImg" onchange="loadFile(event);"/>
                </div>
              </div>
              <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label text-white">Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="tag" name="tag" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $tag;} ?>">
                </div>
              </div>	

    <!-- ######################## MULTIPLE SELECT BOES ENDS HERE --> 
        </form>
      </div><!--End Row-->

    	<!-- Content End Here -->
    </div>
   </div>
<?php include 'footer.php';?>