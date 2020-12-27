<?php include '../includes/connection.php';
$img_src = 'images/photo.png';
	if (isset($_POST['add-collection'])) {
		
		isset($_POST['status'])?$_POST['status']=1 : $_POST['status']=0;
		isset($_POST['featured'])?$_POST['featured']=1 : $_POST['featured']=0;
		$status = $_POST['status'];
		$featured = $_POST['featured'];
		$cdetail = $_POST['cdetail'];
		$idetail = $_POST['idetail'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];

		$imageName = $_FILES['image']['name'];
  		$imageSize = $_FILES['image']['size'];
  		$imageType = $_FILES['image']['type'];
  		$imageTemp = $_FILES['image']['tmp_name'];


		$highlight = $_POST['highlight'];
		$description = $_POST['description'];
		$date = date('Y-m-d');

		if ($cdetail =="" OR $cdetail==" " OR empty($cdetail)) {
			echo "<script>alert('Collection Details is Required');</script>";
		} else if ($price =="" OR $price==" " OR empty($price)) {
			echo "<script>alert('Product Price is Required');</script>";
		} else if ($quantity =="" OR $quantity==" " OR empty($quantity)) {
			echo "<script>alert('Product Quantity is Required');</script>";
		} else if ($highlight =="" OR $highlight==" " OR empty($highlight)) {
			echo "<script>alert('Product Highlight is Required');</script>";
		} else if ($description =="" OR $description==" " OR empty($description)) {
			echo "<script>alert('Product description is Required');</script>";
		}
		else if ($imageName =="" OR $imageName==" " OR empty($imageName)) {
			echo "<script>alert('Product Image is Required');</script>";
		} else if ($idetail =="" OR $idetail==" " OR empty($idetail)) {
			echo "<script>alert('Info Details is Required');</script>";
		} 
		else{
			$type = explode('.', $imageName);
	  		$type = strtolower(end($type));
	  		$allow = ['jpg', 'png', 'jpeg'];
	  		$imageName = $cdetail.".".$type;
	  		if (in_array($type, $allow)) {
	  			if (!is_dir('collection')) {
	  				mkdir('collection');
	  			}
	  			if (move_uploaded_file($imageTemp, 'collection/'.$imageName)) {
	  				$addProduct = $connect2db->prepare("INSERT INTO collection (Coll_details, info_details, price, quantity, highlight, description, status, featured, created, images) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");
					$query = $addProduct->execute([$cdetail, $idetail, $price, $quantity, $highlight, $description, $status, $featured, $date,$imageName]);
					$query ?
					print "<script>alert('Collection Successfully Added');</script>":
					print "<script>alert('Error Adding Collection, Please Try Again');</script>";
	  			} else{
	  			echo "<script>alert('collection Folder Missing');</script>";
	  		}
	  		}

	  		else{
	  			echo "<script>alert('File type not Acceptable');</script>";
	  		}
			
			
		 }

	}
// Updating Data
if(isset($_GET['eid'])){
  if(isset($_POST['update'])){
 // Product Parameters goes thus
		isset($_POST['status'])?$_POST['status']=1 : $_POST['status']=0;
		isset($_POST['featured'])?$_POST['featured']=1 : $_POST['featured']=0;

		$status = $_POST['status'];
		$featured = $_POST['featured'];
		$cdetail = $_POST['cdetail'];
		$idetail = $_POST['idetail'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$highlight = $_POST['highlight'];
		$description = $_POST['description'];
		$date = date('Y-m-d');

		// Checking if image is uploaded before updating data
		if(!isset($_POST['image']) && empty($_FILES['image']['name']) && $_FILES['image']['name']==""){
		    $update=$connect2db->prepare("UPDATE collection SET 
		      coll_details='$cdetail', 
		      info_details = '$idetail',
		      price='$price', 
		      quantity='$quantity', 
		      featured='$featured',
		      highlight='$highlight', 
		      description='$description', 
		      created='$date',
		      status='$status' WHERE id= '" . (int)$_GET['eid'] . "' 
		      "); 
		      if($update->execute()){
		        echo "<script> alert('Updated Without Collection Image');</script>";
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
				if (move_uploaded_file($imageTemp, 'collection/'.$imageName)) {
				    $update=$connect2db->prepare("UPDATE collection SET 
				      coll_details='$cdetail', 
				      info_details = '$idetail',
				      price='$price', 
				      quantity='$quantity', 
				      featured='$featured',
				      images='$imageName',
				      highlight='$highlight', 
				      description='$description', 
				      created='$date',
				      status='$status' WHERE id= '" . (int)$_GET['eid'] . "' 
				      "); 
				      if($update->execute()){
				        echo "<script> alert('Updated Successfully With Collection Image');</script>";
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
if(isset($_GET['eid']) && $_GET['eid'] != ''){
    $id = $_GET['eid'];
    $select = $connect2db->query("SELECT * FROM collection WHERE id= '" . (int)$_GET['eid'] . "'");
    if($row = $select->fetch()){
    $c_details= $row->Coll_details;
    $info_details =$row->info_details;
    $c_price= $row->price;
    $c_quantity = $row->quantity;
    $c_image = 'collection/'.$row->images;
    $c_highlight = $row->highlight;
    $c_description = $row->description;
    $c_status = $row->status;
    $c_featured = $row->featured;
  }
}

?>
<?php include 'header.php'; ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">

    	<div class="row mt-5">
    		<div class="col-lg-12">
    			<div class="card" style="background:none;">
			     <div class="card-body">
			     	<form method="POST" action="" enctype="multipart/form-data">
				   <div class="card-title text-right">
				   	<a href="collection.php" class="btn btn-primary"> back</a>
				   	<?php
				   	if(isset($_GET['eid'])){?>
	                <button type="submit" class="btn btn-primary" name="update"> Update</button>
	                <?php
	              }else{?>
				   	<input type="submit" name="add-collection" value="Save" style="background:none; border-radius:5px;width:164px;height:45px;color:#AD976E;border:1px solid #fff;"><?php }?>
				   </div>

				    <div class="form-group row">
					  <label for="input-4" class="col-sm-2 col-form-label">Enable Product</label>
					  <div class="col-sm-10">
                     	<input type="checkbox" name="status" checked class="js-switch" data-color="#DAC08E" <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){if($c_status ==1){echo'checked';}else{echo'unchecked';}} ?>/>
					  </div>
					</div>


					 <div class="form-group row">
					  <label for="cdetail" class="col-sm-2 col-form-label">Collection Details</label>
					  <div class="col-sm-3">
						<input type="text" name="cdetail" class="form-control custom-input" id="cdetail" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo$c_details;} ?>">
					  </div>
					</div>

					<div class="form-group row">
					  <label for="idetail" class="col-sm-2 col-form-label">Into Details</label>
					  <div class="col-sm-3">
						<input type="text" name="idetail" class="form-control custom-input" id="idetail" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo$info_details;} ?>">
					  </div>
					</div>

					<div class="form-group row">
					  <label for="price" class="col-sm-2 col-form-label">Price</label>
					  <div class="col-sm-3">
						<input type="text" name="price" class="form-control custom-input" id="price"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo$c_price;} ?>">
					  </div>
					</div>


					<div class="form-group row">
					  <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
					  <div class="col-sm-3">
						<input type="number" name="quantity" class="form-control custom-input" id="quantity" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo$c_quantity;} ?>">
					  </div>
					</div>
					

					<div class="form-group row">
					  <label for="Featured" class="col-sm-2 col-form-label">Featured in Home</label>
					  <div class="col-sm-10">
                     	<input type="checkbox" name="featured" class="js-switch" data-color="#000" style="border:1px solid #fff;" <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){if($c_featured ==1){echo 'checked';}else{echo'unchecked';}} ?> />
					  </div>
					</div>
					<style type="text/css">
						.span{
							font-size: 30px;
							cursor: pointer;
							border: 1px solid #c1c1c1;
							padding: 20px;
							width: 89px;
							height: 89px;
						}
						.attachment{
							display: none;
						}
					</style>

					<div class="form-group row mt-5">
						<label>Image</label><br>
					  <label for="prdImg" class="span">
					  	<img id="output" src="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $c_image;}else{echo$img_src;} ?>" style="width:50px;height:50px;">
					  </label>
					  <div class="col-sm-6">
                     	<input type="file" name="image" class="form-control custom-input attachment"  style="border:1px solid #fff;" id="prdImg" onchange="loadFile(event);" />
					  </div>
					</div>
					

					<div class="form-group col-sm-7">
					  <label for="summernoteEditor">Highlight</label>
					  <textarea class="form-control" name="highlight"  id="summernoteEditor" placeholder="Message body">
					  	<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $c_highlight;}?>
					  </textarea>
					 </div>


					<div class="form-group col-sm-7">
					  <label for="description">Description</label>
					  <textarea class="form-control" name="description" id="description" placeholder="Message body" >
					  	<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $c_description;}?>
					  </textarea>
					 </div>

					<!-- <div class="form-group row">
					  <label for="input-4" class="col-sm-2 col-form-label">Description</label>
					  <div class="col-sm-6">
                     	 
					  </div>
					</div> -->

					
					 
					</form>
				 </div>
			   </div>
    		</div>
    	</div>
    </div>
  </div>

<?php include 'footer.php'; ?>