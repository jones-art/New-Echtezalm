<?php include 'header.php'; $image_own='images/suffix.png';?>

<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
    	<!-- Content Start-->
    	<br><br><br>

    	<div class="row mt-3">
    		<!-- LEFT COLOUMN DIV START HERE -->
        <form class="container" id="loginForm" >
          <div class="col-sm-12">
            <div class="alert text-right" role="alert">
              <button type="submit" class="btn btn-primary"> Save</button>
              <hr>
            </div>

              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label text-white">Enable Page</label>
                <div class="col-sm-10">
                  <input type="radio" class="form-control" id="toggle-page" name="toggle-page">
                  Yes
                </div>
              </div>
              <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label text-white">Page Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="page-title" name="page-title">
                </div>
              </div>		
              <hr>
                <h6 class="text-white mt-4 mb-3"> Slidder Menu</h6>
                <div id="user-role-section" style="border: 1px solid #626567 ">
                  <div class="row">
                    <div class="col-sm-3 py-3 my-3">
                                <div class="form-group col-md-12">
                                    <img class="form-control" src="<?php echo $image_own; ?>" style="height:100px;width:100px;" id="output"/>
                                    <input type="hidden" name="img_exist" value="<?php echo $image_own; ?>" />
                                </div>
                                <div class="upload-btn-wrapper col-md-12"> 
                                <span class="btn btn-file btn btn-primary">Upload Image
                                    <input type="file" name="uploaded_file" onchange="loadFile(event)" class="inputFile"/>
                                            </span>
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