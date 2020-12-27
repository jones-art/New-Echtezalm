<?php $page = 'checkout'; include 'head.php' ?>
<?php 
$id = $_SESSION['id'];
// $page_link = $_SESSION['page_link'];
if (isset($_GET['status']) && $_GET['status'] == 'product') {
    $getOrderID = $connect2db->prepare("SELECT order_id FROM tbl_order WHERE user_id = ? AND payment_status = ?");
    $getOrderID->execute([$id, 'Pending']);
    $getID = $getOrderID->fetch();
    $order_id = $getID->order_id;

    $getAmount = $connect2db->prepare("SELECT SUM(total_amount) AS total FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
    $getAmount->execute([$id, $order_id]);
    $cartAmount = $getAmount->fetch();
    $amountPaid = $cartAmount->total;
}

if (isset($_GET['status']) && $_GET['status'] == 'collection' || $_GET['status'] == 'custom')  {
    $getOrderID = $connect2db->prepare("SELECT order_id, sub_total FROM subscriber WHERE user_id = ? AND payment_status = ?");
    $getOrderID->execute([$id, 'Pending']);
    $getID = $getOrderID->fetch();
    $order_id = $getID->order_id;
    $amountPaid = $getID->sub_total;
}



  $getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total FROM `prd_order` WHERE user_id = ? AND order_id = ?");
  $getTotal->execute([$id, $order_id]);
  $cart = $getTotal->fetch();
  $total = $cart->total;
?>
<?php
// require_once "ideal/sisow.cls5.php";
// // $sisow = new Sisow("2538178413", "197aa4625875a849ceb2022802b0cb6806168e5e");
// $sisow = new Sisow("2537278813", "f1bcac04ef461e7a84757e6394ba205b1f63936e");
// if (isset($_POST["issuerid"])) {
//   $page_error_back = '?status='.$_GET['status'];
//   $sisow->purchaseId = $_POST["purchaseid"];
//   $sisow->description = $_POST["description"] . $order_id;
//   $sisow->amount = $_POST["amount"];
//   $sisow->payment = $_POST["payment"];
//   $sisow->issuerId = $_POST["issuerid"];
//   $sisow->returnUrl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"];
//   if (($ex = $sisow->TransactionRequest()) < 0) {
//     // echo "<script> alert($ex)</script>";
//     // $msg_error = $sisow->errorMessage;
//     // header('Location:'.$page_error_back);
//     header("Location: payment.php?ex=" . $ex . "&ec=" . $sisow->errorCode . "&em=" . $sisow->errorMessage);
//     exit;
//   }
//   header("Location: " . $sisow->issuerUrl);
// }
// else if (isset($_GET["trxid"])) {
//   $sisow->StatusRequest($_GET["trxid"]);
//   // if ($sisow->status == Sisow::statusSuccess) {
//   //     echo $sisow->consumerAccount;
//   //     echo $sisow->consumerName;
//   // }
//   header("Location: payment.php?status=" . $sisow->status);
//   exit;
// }
// else {
  // there are 2 methods for filling the available issuers in the select/dropdown
  // below, the REST method DirectoryRequest is used
  // $sisow->DirectoryRequest($select, true);
// }
if (isset($_POST['submit']) && $_GET['status']=='product') {
  // echo "<script> alert('Error With payment');</script>";
  $status = 'Paid';
  $oldStatus = 'Pending';
  // $amount = $_POST['amount'];
  $type = 'Ideal';
  $upd = $connect2db->prepare("UPDATE tbl_order SET payment_status = ?, amount = ?, payment_type = ? WHERE user_id = ? AND payment_status = ? AND order_id = ?");
  
  if($upd->execute([$status, $amountPaid, $type, $id, $oldStatus, $order_id])){
    echo "<script> alert('Payment Successfully made');window.location='index.php';</script>";
  }else{
    echo "<script> alert('Error With payment');</script>";
  }
}

// DOMMY PAYMENT BY UPDATING THE STATUS
  if (isset($_POST['submit']) && $_GET['status']=='collection' ) {
     $status = 'Paid';
  $oldStatus = 'Pending';
  // $amount = $_POST['amount'];
  $type = 'Ideal';
  $upd = $connect2db->prepare("UPDATE subscriber SET payment_status = ?, amountPaid = ?, payment_type = ? WHERE user_id = ? AND payment_status = ? AND order_id = ? AND plan != ?");
  
  if($upd->execute([$status, $amountPaid, $type, $id, $oldStatus, $order_id, 0])){
    echo "<script> alert('Collection Payment Successfully made');window.location='index.php';</script>";
  }else{
    echo "<script> alert('Error With Collection payment');</script>";
  }
  }

   if (isset($_POST['submit']) && $_GET['status']=='custom' ) {
     $status = 'Paid';
  $oldStatus = 'Pending';
  // $amount = $_POST['amount'];
  $type = 'Ideal';
  $upd = $connect2db->prepare("UPDATE subscriber SET payment_status = ?, amountPaid = ?, payment_type = ? WHERE user_id = ? AND payment_status = ? AND order_id = ? AND plan = ? ");
  
  if($upd->execute([$status, $amountPaid, $type, $id, $oldStatus, $order_id, 0])){
    echo "<script> alert('Collection Payment Successfully made');window.location='index.php';</script>";
  }else{
    echo "<script> alert('Error With Collection payment');</script>";
  }
  }

?>
    
<section>
  <div class="container">
    <div class="row">
      <div class="col s12 m7 card black" style="margin-top: 50px">
        <h5 class="right-align" style="padding-bottom: 20px;">Checkout</h5>
        <!-- <h5>Keep in touch</h5> -->
        <form  method="POST" action="" id="payment_form">
          <p style="color:red"> <?php //if (isset($_POST["issuerid"])) {echo $msg_error;}?></p>
        <p style="margin-bottom:8px; color: white;font-size:20px">Payment <?php //echo $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"].'?status='.$_GET['status'];?></p>
        <p class="white-text"> All transaction are secured and encrypted </p>
        <div class="row">
          <div class="col s12">
            <ul class = "collapsible" data-collapsible="accordion" style="border-color:#3A3A3A">
               <li class="active">
                  <div class = "collapsible-header" style="background:#3A3A3A">
                     <label>
                       <input type="radio" name="payment" value="invoice" style="background:#fff;border:1px solid #fff" checked>
                       <span class="white-text" style="font-size:19px"> iDEAL</span>

                     </label> <img src="images/icon/ideal.png" style="width:30px;height:30px;position:relative;top:1px;margin-top:0px;margin-left: 30px"></div>
                  <div class = "collapsible-body">
                    <p>Pay with Ideal <?php //echo($amountPaid);?> </p>
                    <p> Choose your bank <?php// echo($order_id);?></p>

                    <input type="hidden" value="<?php echo($order_id);?>" name="purchaseid">
                    <input type="hidden" value="Goods with order ID" name="description">
                    <input type="hidden" value="<?php echo($total + 1000);?>" name="amount">
                    <input type="hidden" value="<?php echo($id);?>" name="issuerid">
                    <?php echo $select ?>
                  </div>
               </li>
               
               <li>
                     <div class = "collapsible-header" style="background:#3A3A3A">
                     <label>
                       <input type="radio" name="payment" value="invoice" style="background:#fff;border:1px solid #fff">
                       <span class="white-text" style="font-size:19px"> Payment via invoice </span>
                     </label></div>
                  <div class = "collapsible-body">
                    <p class="white-text">You will receive an invoice from us as a result of your order. After payment we will proceed to delivery. If you have any questions or comments about your order, please call or email!</p>
                  </div>
               </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col s8 input-field left-align">
            <a href="checkout.php" style="color:#DAC08E;text-transform:capitalize;">< Go back</a>
          </div>
          <div class="col s4 input-field">
            <button class="btn btn-primary" type="submit" name="submit" style="width:198px;height:51px;font-weight:500;font-size:16px;line-height:24px;text-align:center;background:#DAC08E;text-transform:capitalize;box-sizing: border-box;line-height:24px;" id="payBtn"> Pay now</button>
            <!-- this.form.submit();this.innerHTML='PROCESSING...';this.setAttribute('disabled',true); -->
          </div>     
        </div>



          
        </form>
      </div>

      <!-- Map Div Start From Here -->
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
                 elseif (isset($_GET['status']) && $_GET['status'] =='collection') {
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
 $getTotal = $connect2db->prepare("SELECT month, SUM(sub_total) AS total FROM subscriber WHERE user_id = ? AND status=? AND order_id = ?");
  $getTotal->execute([$id,'Pending', $order_id]);
  if($tot = $getTotal->fetch()){?>
                      <p style="color:#DAC08E"> € <span class="span"><?php echo number_format($tot->total , 2);?></p></span></p>
                      <p style="color:#DAC08E"> € <?php echo number_format(($tot->total )  + 1000, 2);?></p>
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
 $getTotal = $connect2db->prepare("SELECT SUM(sub_total) AS total FROM subscriber WHERE user_id = ? AND payment_status=? AND order_id = ?");
  $getTotal->execute([$id,'Pending', $order_id]);
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

        </div>
      </div>
    </section>



<?php include 'footer.php' ?>