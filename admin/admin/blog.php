<?php include 'header.php'; $image_own='images/suffix.png';
  if (is_file('no_delete.php')) {
    include'../includes/connection.php';
  }
// Getting Data Before Updating
if(isset($_GET['rid']) && $_GET['rid'] != ''){
    $id = $_GET['rid'];
    $select = $connect2db->query("SELECT content FROM blog WHERE id= '" . (int)$_GET['rid'] . "'");
    if($row = $select->fetch()){
      $b_content = $row->content;
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
        <div class="col-sm-8">
          <ul class="navbar-nav ml-4 ml-4 align-items-center">
            <li class="nav-item">
              <form class="search-bar">
                <input type="text" class="form-control" placeholder="Enter keywords" style="background:transparent;">
                 <a href="javascript:void();"><i class="icon-magnifier"></i></a>
              </form>
            </li>
          </ul>
        </div>
          <div class="col-sm-4 text-right">
              <a href="add-new-blog.php" class="btn btn-primary" style="color:#D"> 
                <i class="fa fa-plus"></i>
              Create a blog</a>
         </div>
      </div><!--End Row-->
       <hr>

       <div class="row">
              <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $del = $connect2db->query("DELETE FROM blog WHERE id='$id'");
                    if($del->execute()){
                        echo "<script>alert('Deleted');</script>";
                      }
                  }

                  $sel = $connect2db->prepare("SELECT * FROM blog");
                  $sel->execute();
                  
                  if($sel->rowCount() < 1){
                    echo "No Blog Available";}else{
                $select = $connect2db->query("SELECT * FROM blog");
                while ($row = $select->fetch()) {
              ?>
         <div class="col-sm-6">
          <div class="card" style="background:transparent;">
            <div class="card-body">
               <h5 class="text-white mb-4"> <?php echo substr($row->blog_title,0,50); ?> </h5>
               <div class="row mb-3">
                 <div class="col-sm-8">
                   <h6 class="text-muted"> <?php echo $row->created_on; ?></h6>
                 </div>
                 <div class="col-sm-2">
                   <a href="blog.php?id=<?php echo $row->id;?>" style="color:#DAC08E">Delete</a>
                 </div>
                 <div class="col-sm-2">
                   <a href="add-new-blog.php?eid=<?php echo $row->id;?>" style="color:#DAC08E">Edit</a>
                 </div>
               </div>
               <div class="accordian text-white" style="border: 1px solid #fff;border-radius:5px;padding:10px">
                <img src="blog/<?php echo $row->image;?>" style="width:100%;height:350px">
                 <p class="text-white <?php if(isset($_GET['rid']) && $_GET['rid'] != ''){echo "";}else{echo 'text-truncate';} ?>"> 
                     <?php echo substr($row->content, 0, 70);?> </p>
                 <a href="blog.php?rid=<?php echo $row->id ?>" style="color:#DAC08E;"> Read More</a>
               </div>
            </div>
          </div>
         </div>
         <?php
          }}
         ?>
       </div>
<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum. -->
    	<!-- Content End Here -->
    </div>
   </div>
<?php include 'footer.php';?>



        <div class="col-12 col-lg-6 col-xl-3">
          <!-- <div class="card border-warning border-left-sm">
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 class="text-warning">8400</h4>
                <span>New Users</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle gradient-blooker">
                <i class="icon-user text-white"></i></div>
            </div>
            </div>
          </div>
        </div> -->