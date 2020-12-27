<?php $page = 'checkout'; include 'head.php' ?>
<?php

if (isset($_GET['status']) && $_GET['status'] == 'product') {
    $getOrderID = $connect2db->prepare("SELECT order_id FROM tbl_order WHERE user_id = ? AND payment_status = ?");
    $getOrderID->execute([$id, 'Pending']);
    $getID = $getOrderID->fetch();
    $order_id = $getID->order_id;
}

if (isset($_GET['status']) && $_GET['status'] == 'collection')  {
    $getOrderID = $connect2db->prepare("SELECT order_id FROM subscriber WHERE user_id = ? AND payment_status = ? AND plan!=?");
    $getOrderID->execute([$id, 'Pending', 0]);
    $getID = $getOrderID->fetch();
    $order_id = $getID->order_id;
}

if (isset($_GET['status']) && $_GET['status'] == 'custom')  {
    $getOrderID = $connect2db->prepare("SELECT order_id FROM subscriber WHERE user_id = ? AND payment_status = ? AND plan=?");
    $getOrderID->execute([$id, 'Pending', 0]);
    $getID = $getOrderID->fetch();
    $order_id = $getID->order_id;
}

  if (isset($_POST['submit'])) {
    $page_link = $_POST["page_link"];
    $email = trim($_POST['email']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $country = $_POST['country'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    isset($_POST['company']) ? $company = $_POST['company']: $company = NULL;
    isset($_POST['apartment']) ? $apartment = $_POST['apartment']: $apartment = NULL;
    $zcode = trim($_POST['zcode']);
    $phone = trim($_POST['phone']);
    isset($_POST['agree']) ? $agree = 1: $agree = 0;
    isset($_POST['saveAddress']) ? $saveAddress = 1: $saveAddress = 0;

    if (empty($email) OR empty($fname) OR empty($lname) OR empty($phone) ) {
      echo "<script> alert('First Name, Last Name, Phone Number and E-mail Are Required');</script>";
    }
    else if (empty($country) || empty($state) || empty($lga) || empty($zcode) ) {
      echo "<script> alert('Resident Information Are Required');</script>";
    }
    else{
      // include 'includes/connection.php';
      $insAdd = $connect2db->prepare("INSERT INTO shipping_details (`user_id`, `email`, `fname`, `lname`, `company`, `country`, `state`, `lga`, `zip_code`, `apartment`, `phone`, `age_agree`, `save_add`, order_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insAdd->execute([$id, $email, $fname, $lname, $company, $country, $state, $lga, $zcode, $apartment, $phone, $agree, $saveAddress, $order_id]);
      if ($insAdd) {
        // $_SESSION['page_link'] = $page_link;
        header('location:payment.php?status='.$page_link);

      }else{
       echo "<script> alert('Error Adding Shipping Address, Try Again');</script>";
      }
    }
    
  }
  if(isset($_GET['user_id']) AND isset($_GET['user_id']) !=''){
    $userID = $_GET['user_id'];
    // $userEmail = $_SESSION['email'];
    $u = $connect2db->prepare("SELECT * FROM shipping_details WHERE user_id=?");
    $u->execute([$userID]);
    $up = $u->fetch();
    $fname = $up->fname;
    $lname = $up->lname;
    $email = $up->email;
    $phone = $up->phone;
    $apartment = $up->apartment;
    $zip_code = $up->zip_code;
    $lga = $up->lga;
    $state = $up->state;
    $country = $up->country;
    $company = $up->company;
  }

  if(isset($_GET['user_id'])){
    if(isset($_POST['update'])){
    $userID = $_GET['user_id'];
    $email = trim($_POST['email']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $country = $_POST['country'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    isset($_POST['company']) ? $company = $_POST['company']: $company = NULL;
    isset($_POST['apartment']) ? $apartment = $_POST['apartment']: $apartment = NULL;
    $zcode = trim($_POST['zcode']);
    $phone = trim($_POST['phone']);

      $upd = $connect2db->prepare("UPDATE shipping_details SET
        email='$email',
        fname='$fname',
        lname='$lname',
        company='$company',
        country='$country',
        state='$state',
        lga='$lga',
        zip_code='$zcode',
        apartment='$apartment',
        phone='$phone'
        WHERE user_id=?
        ");
      $upd->execute([$userID]);
      if($upd){
      header('location: profile.php');
      echo "<script> alert('Updated Successfully')</script>";
      
      }
    }
  }
if (isset($_GET['status'])){
    $u = $connect2db->prepare("SELECT * FROM shipping_details WHERE user_id=?");
    $u->execute([$id]);
    if($u->rowcount() > 0){
      $up = $u->fetch();
      $fname = $up->fname;
      $lname = $up->lname;
      $email = $up->email;
      $phone = $up->phone;
      $apartment = $up->apartment;
      $zip_code = $up->zip_code;
      $lga = $up->lga;
      $state = $up->state;
      $country = $up->country;
      $company = $up->company;
      $aa = $up->age_agree;
      $sadd = $up->save_add;
    }
}
?>

<section>
  <?php
                $getCollection = $connect2db->prepare("SELECT sub.plan, sub.month, sub.id, coll.Coll_details, coll.id, coll.images FROM subscriber as sub INNER JOIN collection as coll ON sub.plan=coll.id WHERE sub.user_id=?");
                $getCollection->execute([$id]);
                while ($coll = $getCollection ->fetch()) {
                  echo $coll->Coll_details;
                }
// SELECT sub.plan, sub.month, sub.id, coll.Coll_details, coll.id, coll.images FROM subscriber as sub INNER JOIN collection as coll ON sub.plan=coll.id WHERE sub.user_id=16
    ?>
</section>
<section>
	<div class="container">
		<div class="row">
      <form method="POST">
			<div class="col m7 s12 card black" >
        <h5 class="right-align" style="padding-bottom: 108px;">Checkout</h5>
				<p style="margin-bottom:8px; color: white;font-size:20px">Contact Information</p>

				<div class="row">
					<div class="col s12 input-field">
            <?php if (isset($_GET['status']) && $_GET['status'] =='product'){$page_link = 'product';}
            if(isset($_GET['status']) && $_GET['status'] =='collection'){$page_link = 'collection';}?>
              <input type="hidden" name="page_link" value="<?php echo $page_link; ?>">
						<label for="email" style="padding-left: 20px;" class="white-text">Your email</label>
						<input type="text" id="email" class="browser-default input" name="email" value="<?php if(isset($_GET['user_id'])){echo $email;}if (isset($_GET['status'])){echo $email;} ?> ">
            <p class="white-text"> <img src="images/icon/time.png" style="margin-top:0px;padding-top:2px;"> Deliverery usually takes between 1 - 2 days</p>
					</div>
          <div class="col s12 input-field">
            <p style="margin-bottom:8px; color: white;font-size:20px">Shipping Address</p></div>
            
					<div class="col s6 input-field">
						<label for="fname" style="padding-left: 20px;" class="white-text">First Name  </label>
						<input type="text" id="fname" class="browser-default input" name="fname" value="<?php if(isset($_GET['user_id'])){echo $fname;}if (isset($_GET['status'])){echo $fname;} ?>">
					</div>

					<div class="col s6 input-field">
						<label for="lname" style="padding-left: 20px;" class="white-text">Last Name</label>
						<input type="text" id="lname" class="browser-default input" name="lname" value="<?php if(isset($_GET['user_id'])){echo $lname;}if (isset($_GET['status'])){echo $lname;} ?> ">
					</div>

					<div class="col s12 input-field">
						<label for="company" style="padding-left: 20px;" class="white-text">Company (optional)</label>
						<input type="text" id="company" class="browser-default input" name="company" value="<?php if(isset($_GET['user_id'])){echo $company;}if (isset($_GET['status'])){echo $company;} ?>">
					</div>
          <div class="col s12 input-field">
          <div class="row">
            <div class="col s4 input-field">
              <select class="browser-default input" name="country">
                <option> Netherland</option>
              </select>
            </div>
            <div class="col s4 input-field">
              <select class="browser-default input" name="state" style="background:#000;color:#fff;padding-left:10px">
                <option disabled selected value="0">-- Select State --</option>
                <?php
                  $select = $connect2db->query("SELECT * FROM state ORDER BY id ASC");
                  while($row = $select->fetch()){?>
                  <option <?php if(isset($_GET['user_id'])){if($state==$row->stateName){echo 'selected';}}if (isset($_GET['status'])){if($state==$row->stateName){echo 'selected';}} ?>> <?php echo $row->stateName; ?></option>
                <?php }?>
              </select>
            </div>
            <div class="col s4 input-field">
              <!-- <label for="zcode" style="padding-left: 20px;" class="white-text"> </label> -->
              <input type="text" id="zcode" class="browser-default input" name="zcode" placeholder="ZIP code" value="<?php if(isset($_GET['user_id'])){echo $zip_code;}if (isset($_GET['status'])){echo $zip_code;} ?>">
              <!-- <select class="browser-default input" name="lga">
                <option> Ojo</option>
              </select> -->
            </div>
          </div>
          </div>
          <div class="col s12 input-field">
            <label for="lga" style="padding-left: 20px;" class="white-text">City </label>
            <input type="text" id="lga" class="browser-default input" name="lga" value="<?php if(isset($_GET['user_id'])){echo $lga;}if (isset($_GET['status'])){echo $lga;} ?>">
          </div>

          <div class="col s12 input-field">
            <label for="apartment" style="padding-left: 20px;" class="white-text">Apartment, Suite, etc (optional)</label>
            <input type="text" id="apartment" class="browser-default input" name="apartment" value="<?php if(isset($_GET['user_id'])){echo $apartment;}if (isset($_GET['status'])){echo $apartment;}?>">
          </div>

          <div class="col s12 input-field">
            <label for="phone" style="padding-left: 20px;" class="white-text">Phone</label>
            <input type="text" id="phone" class="browser-default input" name="phone" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php if(isset($_GET['user_id'])){echo $phone;}if (isset($_GET['status'])){echo $phone;} ?> ">
          </div>
        <?php if(isset($_GET['user_id']) ==''){?>
          <div class="col s12 input-field">
                <label>
                  <input type="checkbox" name="agree" class="white-text" style="border-color:#fff" <?php if (isset($_GET['status'])){if($aa==1){echo'checked';}}?>/>
                  <span class="white-text">I agree i am over 18 year old</span>
                </label>          
              </div>
          <div class="col s12 input-field">
                <label>
                  <input type="checkbox" name="saveAddress" class="white-text" style="border-color:#fff" <?php if (isset($_GET['status'])){if($sadd==1){echo'checked';}}?>/>
                  <span class="white-text">Save this address</span>
                </label>
          </div>
          <?php }?>
          <div class="col s12 input-field" style="margin-top:29px">
          <?php if(isset($_GET['user_id'])){?>
              <div class="row">
                <div class="col s4 input-field left-align">
                  <button class="btn btn-primary" name="update" type="submit" style="width:198px;height:51px;font-weight:500;font-size:16px;line-height:20px;text-align:center;background:#DAC08E;text-transform:capitalize;padding-top:12px;">Update</button>
                </div>
              </div><?php }else{?>            
            <div class="row">
              <div class="col s4 input-field left-align">
                <a class="btn btn-primary" href="webshop.php" type="submit" style="width:198px;height:51px;font-weight:500;font-size:16px;line-height:24px;text-align:center;background:#DAC08E;text-transform:capitalize;padding-top:12px;">Continue Shopping</a>
              </div>
              <div class="col s8 input-field center">
                <button class="btn btn-primary" name="submit" type="submit" style="width:198px;height:51px;font-weight:500;font-size:14px;line-height:24px;text-align:center;border: 1px solid #DAC08E;text-transform:capitalize;background:transparent;box-sizing:border-box;">Continue to payment</button>
              </div>
            </div>
          <?php }?>
          </div>
				</div>
			</div>
    </form>
			<!-- Map Div Start From Here -->
<?php if(isset($_GET['user_id']) ==''){?>
    			<div class="col s12 m5 card black" style="margin-top: 180px">
            <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px;">
              <div class="card-content white-text" style="padding:10px">
                <?php
 
    if (isset($_GET['status']) && $_GET['status'] =='product') {
                  $getProduct = $connect2db->prepare("SELECT prd_order.id, prd_order.quantity,prd_order.status, prd_order.order_date,prd_order.total_amount,product.price,product.prd_name,product.image, users.fname, users.lname,prd_order.order_id FROM prd_order JOIN product on prd_order.product_id = product.id JOIN users on prd_order.user_id = users.id WHERE users.id = ? AND prd_order.order_id = ?");
                $getProduct->execute([$id, $order_id]);
                while ($cart = $getProduct->fetch()) {?>
                
                <div class="row">
                  <div class="col l4 m4 s4"><img src="admin/product/<?php echo $cart->image?>" style="width:85px;height:85px;margin-top:6px"></div>
                  <div class="col l5 m5 s4" style="padding-top:8%"><p class="white-text"> <?php echo $cart->prd_name ?> (<?php echo $cart->quantity?>)</p></div>
                  <div class="col l3 m3 s4 right-align" style="padding-top:8%"><p style="color:#DAC08E"> € <?php echo $cart->price?></p></div>
                </div>
                 <?php
            }
            ?>
              </div>
              <hr>
                  <div class="row" style="padding-left:15px">
                    <div class="col l4 s4">
                      <p style ="margin-bottom:0px"> Product Total:</p>
                      <p style ="margin-bottom:0px"> Sub Total:</p>
                    </div>  <!-- Left side pane of the right account panel -->
                    <div class="col l8 s4">
                      <p style="color:#DAC08E"> € <span class="span"> <?php 
                $getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
                $getTotal->execute([$id, $order_id]);
                $cart = $getTotal->fetch();
              echo number_format($cart->total, 2)?></span></p>
                      <p style="color:#DAC08E"> € <?php echo number_format($cart->total + 1000, 2)?></p>
                    </div>
                  </div>
                  <!-- PRODUCT GENERATION FOR PRODUCT ENDS HERE -->
                <?php }
                elseif (isset($_GET['status']) && $_GET['status'] =='collection') {?>
                  <?php
               $getCollection = $connect2db->prepare("SELECT sub.plan, sub.month,sub.payment_status, sub.id, coll.Coll_details, coll.id, coll.price,coll.images FROM subscriber as sub INNER JOIN collection as coll ON sub.plan=coll.id WHERE sub.user_id=? AND sub.payment_status=?");
                $getCollection->execute([$id,'Pending']);
                 while ($coll = $getCollection->fetch()) {?>  
                <div class="row">
                  <div class="col l4 m4 s4"><img src="admin/collection/<?php echo $coll->images?>" style="width:85px;height:85px;margin-top:6px"></div>
                  <div class="col l5 m5 s4" style="padding-top:8%"><p class="white-text"> <?php echo $coll->Coll_details;?> (<?php echo $coll->month. ' Month'?>)</p></div>
                  <div class="col l3 m3 s4 right-align" style="padding-top:8%"><p style="color:#DAC08E"> € <?php echo number_format($coll->price * $coll->month, 2);?></p></div>
                </div>
                 <?php
            }
            ?>
              </div>
              <hr>
                  <div class="row" style="padding-left:15px">
                    <div class="col l4 s4">
                      <p style ="margin-bottom:0px"> Product Total:</p>
                      <p style ="margin-bottom:0px"> Sub Total:</p>
                    </div>  <!-- Left side pane of the right account panel -->
                    <div class="col l8 s4">
  <?php
 $getTotal = $connect2db->prepare("SELECT SUM(sub_total) AS total FROM subscriber WHERE user_id = ? AND payment_status=? AND order_id=?");
  $getTotal->execute([$id,'Pending',$order_id]);
  if($tot = $getTotal->fetch()){?>
                      <p style="color:#DAC08E"> € <span class="span"><?php echo number_format($tot->total, 2);?></p></span></p>
                      <p style="color:#DAC08E"> € <?php echo number_format($tot->total  + 1000, 2);?></p>
                    </div>
                  </div>
                   <!-- COLLECTIOn GENERATION FOR PRODUCT ENDS HERE -->
                <?php }
              }else{
                ?>
             <?php 
             $getCollection = $connect2db->prepare("SELECT sub.plan,sub.user_id,sub.month,sub.payment_status, sub.sub_total, sub.id,cust.product_id,cust.quantity,cust.subscription_id, prd.image, prd.prd_name, prd.id,prd.price  FROM subscriber as sub INNER JOIN tbl_custom_product as cust ON sub.id = cust.subscription_id INNER JOIN product as prd ON cust.product_id=prd.id WHERE sub.user_id=? AND sub.payment_status=?");
                $getCollection->execute([$id,'Pending']);
                 while ($coll = $getCollection->fetch()) {
                  $month = $coll->month;
                  $single = $coll->sub_total;?>  
                <div class="row">
                  <div class="col l4 m4 s4"><img src="admin/product/<?php echo $coll->image?>" style="width:85px;height:85px;margin-top:6px"></div>
                  <div class="col l5 m5 s4" style="padding-top:8%"><p class="white-text"> <?php echo $coll->prd_name;?> (<?php echo $coll->quantity. ' x'?>)</p></div>
                  <div class="col l3 m3 s4 right-align" style="padding-top:8%"><p style="color:#DAC08E"> € <?php echo number_format($coll->price * $coll->quantity, 2);?></p></div>
                </div>
                 <?php
            }
            ?>
              </div>
              <hr>
                <div class="row" style="padding-left:15px;padding-bottom:0px;">
                  
                  <div class="col l5 m5 s4" ><p class="white-text"> Duration</p></div>
                  <div class="col l3 m3 s4 right-align"><p style="color:#DAC08E">  <?php echo $month ?> Month(s)</p></div>

                  <div class="col l5 m5 s4"><p class="white-text"> Amount Per Month</p></div>
                  <div class="col l3 m3 s4 right-align" ><p style="color:#DAC08E"> € <?php echo $single / $month ?></p></div>
                </div>
              <hr>
                  <div class="row" style="padding-left:15px">
                    <div class="col l4 s4">
                      <p style ="margin-bottom:0px"> Product Total:</p>
                      <p style ="margin-bottom:0px"> Sub Total:</p>
                    </div>  <!-- Left side pane of the right account panel -->
                    <div class="col l8 s4">
  <?php
 $getTotal = $connect2db->prepare("SELECT sub_total AS total FROM subscriber WHERE user_id = ? AND payment_status=? AND order_id=?");
  $getTotal->execute([$id,'Pending',$order_id]);
  if($tot = $getTotal->fetch()){?>
                      <p style="color:#DAC08E"> € <span class="span"><?php echo number_format($tot->total, 2);?></p></span></p>
                      <p style="color:#DAC08E"> € <?php echo number_format($tot->total  + 1000, 2);?></p>
                    </div>
                  </div>

          <?php }
         }?>

              </div>
            </div>  
          </div>
<?php }?>
    		</div>
    	</div>
    </section>



<?php include 'footer.php' ?>