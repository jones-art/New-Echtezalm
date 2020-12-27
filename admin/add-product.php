<?php 
include '../includes/connection.php';
$img_src = 'images/photo.png';
	if (isset($_POST['add-product'])) {
// Product Parameters goes thus
		isset($_POST['status'])?$_POST['status']=1 : $_POST['status']=0;
		isset($_POST['featured'])?$_POST['featured']=1 : $_POST['featured']=0;

		$status = $_POST['status'];
		$featured = trim($_POST['featured']);
		$pname = trim($_POST['pname']);
		$price = trim($_POST['price']);
		$quantity = trim($_POST['quantity']);

		$imageName = $_FILES['image']['name'];
  		$imageSize = $_FILES['image']['size'];
  		$imageType = $_FILES['image']['type'];
  		$imageTemp = $_FILES['image']['tmp_name'];

// 	Product  two Image
		$imageName2 = $_FILES['prdOne']['name'];
  		$imageSize2 = $_FILES['prdOne']['size'];
  		$imageType2 = $_FILES['prdOne']['type'];
  		$imageTemp2 = $_FILES['prdOne']['tmp_name'];

    // Third Product Image

		$imageName3 = $_FILES['prdTwo']['name'];
  		$imageSize3 = $_FILES['prdTwo']['size'];
  		$imageType3 = $_FILES['prdTwo']['type'];
  		$imageTemp3 = $_FILES['prdTwo']['tmp_name'];

    // Four Product Image

		$imageName4 = $_FILES['prdThree']['name'];
  		$imageSize4 = $_FILES['prdThree']['size'];
  		$imageType4 = $_FILES['prdThree']['type'];
  		$imageTemp4 = $_FILES['prdThree']['tmp_name'];


		$highlight = trim($_POST['highlight']);
		$description = trim($_POST['description']);
		$date = date('Y-m-d');
		// Product parameters end here

		if ($pname =="" OR $pname==" " OR empty($pname)) {
			echo "<script>alert('Product Name is Required');</script>";
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
			echo "<script>alert('Main Product Image is Required');</script>";
		}
		else if ($imageName2 =="" OR $imageName2==" " OR empty($imageName2)) {
			echo "<script>alert('Second Product Image is Required');</script>";
		}
		else if ($imageName3 =="" OR $imageName3==" " OR empty($imageName3)) {
			echo "<script>alert('Third Product Image is Required');</script>";
		}
		else if ($imageName4 =="" OR $imageName4==" " OR empty($imageName4)) {
			echo "<script>alert('Forth Product Image is Required');</script>";
		} 
		else{
			$type = explode('.', $imageName);
	  		$type = strtolower(end($type));
	  		$allow = ['jpg', 'png', 'jpeg'];
	  		$imageName = $pname.".".$type;
	  		if (in_array($type, $allow)) {
	  			if (move_uploaded_file($imageTemp, 'product/'.$imageName) && move_uploaded_file($imageTemp2, 'product/'.$imageName2) && move_uploaded_file($imageTemp3, 'product/'.$imageName3) && move_uploaded_file($imageTemp4, 'product/'.$imageName4)) {
	  				$addProduct = $connect2db->prepare("INSERT INTO product (prd_name, price, quantity, highlight, description, status, featured, created, image, image2, image3, image4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$query = $addProduct->execute([$pname, $price, $quantity, $highlight, $description, $status, $featured, $date,$imageName,$imageName2,$imageName3,$imageName4]);
					$query ?
					print "<script>alert('Product Successfully Added');</script>":
					print "<script>alert('Error Adding Product, Please Try Again');</script>";
	  			} else{
	  			echo "<script>alert('Product Folder Missing');</script>";
	  			}
	  		}else{
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
		$pname = trim($_POST['pname']);
		$price = trim($_POST['price']);
		$quantity = trim($_POST['quantity']);
		$highlight = trim($_POST['highlight']);
		$description = trim($_POST['description']);
		$date = date('Y-m-d');

		// Checking if image is uploaded before updating data
		if(!isset($_POST['image']) && empty($_FILES['image']['name']) && $_FILES['image']['name']==""){
		    $update=$connect2db->prepare("UPDATE product SET 
		      prd_name='$pname', 
		      price='$price', 
		      quantity='$quantity', 
		      highlight='$highlight', 
		      description='$description', 
		      status='$status',
		      featured='$featured', 
		      created='$date' WHERE id= '" . (int)$_GET['eid'] . "' 
		      "); 
		      if($update->execute()){
		        echo "<script> alert('Updated Without Product Image');</script>";
		      }
		}
		if(isset($_FILES['image']['name'])){
			// $image = $_FILES['image']['name'];
			// echo "<script> alert('".$image."');</script>";
			$imageName = $_FILES['image']['name'];
	  		$imageSize = $_FILES['image']['size'];
	  		$imageType = $_FILES['image']['type'];
	  		$imageTemp = $_FILES['image']['tmp_name'];

			$type = explode('.', $imageName);
			$type = strtolower(end($type));
			$allow = ['jpg', 'png', 'jpeg', 'JPG'];
			$imageName = $pname.".".$type;

			if (in_array($type, $allow)) {
				if (move_uploaded_file($imageTemp, 'product/'.$imageName)) {
				    $update=$connect2db->prepare("UPDATE product SET 
				      prd_name='$pname', 
				      price='$price', 
				      quantity='$quantity', 
				      highlight='$highlight', 
				      description='$description', 
				      status='$status',
				      featured='$featured',
				      image='$imageName', 
				      created='$date' WHERE id= '" . (int)$_GET['eid'] . "' 
				      "); 
				      if($update->execute()){
				        echo "<script> alert('Updated Successfully With Product Image');</script>";
				      }
						// if($update->execute()){
						// 	echo "<script>alert('Product Successfully Updated');</script>":
						// 	echo "<script>alert('Error Adding Product, Please Try Again');</script>";
						// }
						else{	
							echo "<script>alert('Product Folder Missing');</script>";
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
    $select = $connect2db->query("SELECT * FROM product WHERE id= '" . (int)$_GET['eid'] . "'");
    if($row = $select->fetch()){
    $p_name= $row->prd_name;
    $p_price= $row->price;
    $p_quantity = $row->quantity;
    $p_image = 'product/'.$row->image;
    $p_highlight = $row->highlight;
    $p_description = $row->description;
    $p_status = $row->status;
    $p_featured = $row->featured;
    if($p_status ==1){$sts ='checked';}else{$sts='unchecked';}
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
				   	<a href="product-webshop.php" class="btn btn-primary"> back</a>
	              <?php
	              if(isset($_GET['eid'])){?>
	                <button type="submit" class="btn btn-primary" name="update"> Update</button>
	                <?php
	              }else{?>
	              	<input type="submit" name="add-product" value="Save" style="background:none; border-radius:5px;width:164px;height:45px;color:#AD976E;border:1px solid #fff;">
	              <?php }?>
				   
				   </div>

				    <div class="form-group row">
					  <label for="input-4" class="col-sm-2 col-form-label">Enable Product</label>
					  <div class="col-sm-10">
                     	<input type="checkbox" name="status" class="js-switch" data-color="#DAC08E" <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){if($p_status ==1){echo'checked';}else{echo'unchecked';}} ?>/>
					  </div>
					</div>


					 <div class="form-group row">
					  <label for="pname" class="col-sm-2 col-form-label">Product Name</label>
					  <div class="col-sm-3">
						<input type="text" name="pname" class="form-control custom-input" id="pname" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo$p_name;} ?>">
					  </div>
					</div>

					<div class="form-group row">
					  <label for="price" class="col-sm-2 col-form-label">Price</label>
					  <div class="col-sm-3">
						<input type="text" name="price" class="form-control custom-input" id="price" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo$p_price;} ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
					  </div>
					</div>


					<div class="form-group row">
					  <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
					  <div class="col-sm-3">
						<input type="number" name="quantity" class="form-control custom-input" id="quantity" value="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo$p_quantity;} ?>">
					  </div>
					</div>
					

					<div class="form-group row">
					  <label for="Featured" class="col-sm-2 col-form-label">Featured in Home</label>
					  <div class="col-sm-10">
                     	<input type="checkbox" name="featured" class="js-switch" data-color="#000" style="border:1px solid #fff;" <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){if($p_featured ==1){echo 'checked';}else{echo'unchecked';}} ?>/>
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
							align-items: center;
							align-content: center;
						}
						.attachment{
							display: none;
						}
					</style>

					<div class="form-group row mt-5">


				<h6 class="text-white mt-4 mb-3 mr-4"> Image</h6>
                <div id="user-role-section ml-2" style="border: 1px solid #626567;padding:15px">
                  <div class="row">
                    <div class="col-sm-3">
                      <label for="file" class="span">
					  	<img id="output" src="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $p_image;}else{echo$img_src;} ?>" style="width:50px;height:50px;">
					  </label>
                      <div class="col-sm-10">
                        <input type="file"  name="image" id="file" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="loadFile(event)"/>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <label for="file1" class="span">
					  	<img id="slidOne" src="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $p_image;}else{echo$img_src;} ?>" style="width:50px;height:50px;">
					  </label>
                      <div class="col-sm-10">
                        <input type="file"  name="prdOne" id="file1" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="uploadSlid1(event)"/>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <label for="file2" class="span">
					  	<img id="slidTwo" src="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $p_image;}else{echo$img_src;} ?>" style="width:50px;height:50px;">
					  </label>
                      <div class="col-sm-10">
                        <input type="file"  name="prdTwo" id="file2" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="loadSlid2(event)"/>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <label for="file3" class="span">
					  	<img id="slidThree" src="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $p_image;}else{echo$img_src;} ?>" style="width:50px;height:50px;">
					  </label>
                      <div class="col-sm-10">
                        <input type="file"  name="prdThree" id="file3" style="display:none;position:relative;top:20px" accept=".jpg, .png, .jpeg" onchange="uploadSlidder(event)"/>
                      </div>
                    </div>

                </div>
            </div>

<!-- 					<label>Image</label><br>
					  <label for="prdImg" class="span">
					  	<img id="output" src="<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $p_image;}else{echo$img_src;} ?>" style="width:50px;height:50px;">
					  </label>
					  <div class="col-sm-6">
                     	<input type="file" name="image" class="form-control custom-input attachment"  style="border:1px solid #fff;" id="prdImg" onchange="loadFile(event);"/>
					  </div> -->
					</div>
					

					<div class="form-group col-sm-7">
					  <label for="summernoteEditor">Highlight</label>
					  <textarea class="form-control" name="highlight"  id="summernoteEditor" placeholder="Message body">
					  	<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $p_highlight;}?>
					  </textarea>
					 </div>


					<div class="form-group col-sm-7">
					  <label for="description">Description</label>
					  <textarea class="form-control" name="description" id="description" placeholder="Message body" >
					  	<?php if(isset($_GET['eid']) && $_GET['eid'] != ''){echo $p_description;}?>
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

