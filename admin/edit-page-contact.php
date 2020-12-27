<?php include 'header.php';?>
<?php 
  if (is_file('no_delete.php')) {
    include'../includes/connection.php';
  }
  if(isset($_POST['editPageContact'])){
        ################# CREATING TABLE WHICH DOES NOT EXIST #############
    include('assets/includes/createTable.php');
    ######################################
    
    $pname = 'Contact';
    isset($_POST['status'])?$status = 1: $status = 0;
    $ptitle = $_POST['pageTitle'];
    $plocation = $_POST['location'];
    $phone = $_POST['phone'];
    $pemail = $_POST['email'];
    $user = $_SESSION['id'];

    //  VALIDATIONS BEGINS FROM HERE
    if ($ptitle=="" OR $ptitle == " " OR empty($ptitle)) {
      echo "<script>alert('Page Title is required');</script>";
    }
    else if ($status=="" OR $status == " " OR empty($status)) {
      echo "<script>alert('Status is required');</script>";
    } 
    else if ($plocation=="" OR $plocation == " " OR empty($plocation)) {
      echo "<script>alert('Page Location is required');</script>";
    } 
    else if ($phone=="" OR $phone == " " OR empty($phone)) {
      echo "<script>alert('Phone Number is required');</script>";
    } 
    else if ($pemail=="" OR $pemail == " " OR empty($pemail)) {
      echo "<script>alert('Email Field is required');</script>";
    } 
      // Insertion takes place
    else{
      $sql = $connect2db->prepare("SELECT page_name, page_title FROM pages WHERE page_name='Contact'");
      $sql->execute();
      $row = $sql->rowcount();
      if($row > 0){
        $update = $connect2db->prepare("UPDATE pages SET page_name='$pname',page_title='$ptitle',status='$status', file1='$plocation',file2='$phone',file3='$pemail',uploaded_by='$user' WHERE page_name='$pname' ");
        if($update->execute()){
              echo "<script>alert('Updated Successfully');</script>";
        }else{
          echo "<script>alert('Failed');</script>";
        }
      }else{
        $insert = $connect2db->prepare("INSERT INTO pages (page_name,page_title,status, file1,file2,file3,uploaded_by) VALUES(?,?,?,?,?,?,?)");
        $insert->execute([$pname,$ptitle,$status,$plocation,$phone,$pemail,$user]);
        if($insert){
              echo "<script>alert('Success');</script>";
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
        <form class="container" id="loginForm" method="POST">
          <div class="col-sm-12">
            <div class="alert text-right" role="alert">
              <button type="submit" class="btn btn-primary" name="editPageContact"> Save</button>
              <hr>
            </div>

              <div class="form-group row">
                <label for="page-status" class="col-sm-2 col-form-label text-white">Enable Page</label>
                <div class="col-sm-10">
                  <input type="checkbox" name="status" checked class="js-switch" data-color="#DAC08E"/>
                  <span class="text-white"> Yes</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="page-title" class="col-sm-2 col-form-label text-white">Page Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="page-title" name="pageTitle" style="text-transform:capitalize;">
                </div>
              </div>
              <div class="form-group row">
                <label for="location" class="col-sm-2 col-form-label text-white">Location</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="location" name="location" style="text-transform:capitalize;">
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label text-white">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" onkeypress="return onlyNumberKey(event)" maxlength="11">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label text-white">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" value="email@example.com">
                </div>
              </div>
    <!--  ####################### MUTIPLE SELECT BOXES -->

           </div>
        </form>
      </div><!--End Row-->

    	<!-- Content End Here -->
    </div>
   </div>
      <script> 
        var el_up = document.getElementById("GFG_UP"); 
        var el_down = document.getElementById("GFG_DOWN"); 
        el_up.innerHTML =  
          "Type in the box to see whether the input is valid or not."; 
        var RegExp = new RegExp(/^\d*\.?\d*$/); 
        var val = document.getElementById("phone").value; 
  
        function valid(elem) { 
            if (RegExp.test(elem.value)) { 
                val = elem.value; 
                el_down.innerHTML = "Typed Valid Character."; 
            } else { 
                elem.value = val; 
                el_down.innerHTML = "Typed Invalid Character."; 
            } 
        } 
    </script>
<?php include 'footer.php';?>