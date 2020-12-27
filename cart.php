<?php include'head.php';?>
<?php
  if(isset($_POST['unit_id']) && isset($_POST['order_id'])){
    ob_end_clean();
    $order_id = $_POST['order_id'];
    $unit_id = $_POST['unit_id'];
    $qty = $_POST['qty'];
    $subTotal = $_POST['subTotal'];
    // echo $subTotal; echo$unit_id; echo $order_id; echo$qty;
    // exit();  
    $update=$connect2db->prepare("UPDATE prd_order SET 
          quantity='$qty', 
          total_amount='$subTotal'
          WHERE id= '$unit_id' AND order_id='$order_id'");
    // UPDATE prd_order SET quantity='3', total_amount='3' WHERE id= '59' AND order_id='90090'
    // id= '" . (int)$_POST['unit_id'] . "
    if($update->execute()){
        $getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
                    $getTotal->execute([$id, $order_id]);
                    $cart = $getTotal->fetch();
                  echo number_format($cart->total, 2);
                  exit();
          }

  }

  // Deleting Query
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    // $order_id = $_POST['order_id'];
    $del = $connect2db->query("DELETE FROM prd_order WHERE id='$id'");
    if($del){
      echo "<script> alert('Delete'); </script>";
      header('location:cart.php');
      die();
    }else{
      echo "<script> alert('Unfinished'); </script>";
      header('location:cart.php');
      die();
    }
    
  }
?>
<script type="text/javascript">
  const Delete = (e)=>{
      let items = [];
      JSON.parse(localStorage.getItem('items')).map(data=>{
        // console.log(e.parentElement.lastElementChild[0].getAttribute('id'));
        if (data.id != e.parentElement.lastElementChild.getAttribute('id')) {
          items.push(data);
        }
      });
      localStorage.setItem('items', JSON.stringify(items));
      window.location.reload();
    }
</script>

<style type="text/css">
  .empty{
    font-family: Poppins;
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 30px;
    align-items: center;
    text-align: center;
    letter-spacing: 0.05em;
  }
  .shopper{
    width:170px;
    height:170px;
    border-radius:50%;background-color:#3A3A3A;
    margin-top:120px;margin-bottom:60px;
    align-items: center;
    vertical-align: middle;
    padding:35px; 
}
.p{
  font-family: Poppins;
  font-style: normal;
  font-weight: normal;
  font-size: 18px;
  line-height: 27px;
  align-items: center;
  text-align: right;
  letter-spacing: 0.05em;
  padding-bottom:0px;margin-bottom:0px;
  color: #FFFFFF;
  }
.span{
  font-family: Poppins;
  font-style: normal;
  font-weight: 500;
  font-size: 18px;
  line-height: 27px;
  align-items: center;
  text-align: right;
  letter-spacing: 0.05em;

  color: #DAC08E;


}

</style>
<?php
  if (!isset($_SESSION['id'])) {?>

    <div class="container " style="text-align:center;align-content: center;">
          <div class="row ">
            <div class="col s12 center"><h5>Your Shopping Cart</h5></div>

            <div id="getProduct" class="col s12 left"></div>
            
          </div>

          
    <!--  -->   
</div>

        



<?php }
?>

<?php 
if (isset($_SESSION['id'])) {
  

  $id = $_SESSION['id'];

        $getOrder = $connect2db->prepare("SELECT count(order_id) AS prod_count , order_id FROM tbl_order WHERE user_id = ? AND payment_status = ? ");
        $getOrder->execute([$id, 'Pending']);
        $count = $getOrder->fetch();
        $num = $count->prod_count; 
        $order_id = $count->order_id;

        $prd_num = $connect2db->prepare("SELECT count(id) AS id FROM prd_order WHERE user_id = ? AND order_id = ? ");
        $prd_num->execute([$id, $order_id]);
        $count_prd = $prd_num->fetch();
        $tp = $count_prd->id; 

        if($num == 0 || $num < 1){?>

        <!-- Empty Cart Start Here -->
        <div class=" center" style="text-align:center;align-content: center;">
          <div class="row center">
            <div class="col s12 "><h5>Your Shopping Cart</h5></div>

            <div class="col s12 center" style="align-items:center;align-content:center;align-self:center;">
              <div class="shopper align-center" style="margin-left:40%">
                <img src="images/icon/shopper1.png" class="responsive-img center">
              </div>
              <p class="center empty" style="">Your cart is empty</p>
              <p class="center" style="">Goto our webshop and add an item to your cart</p>
            </div>

            <div class="col s12 " style="margin-top:56px;">
              <a class="btn planbtn" style="height:51px;" href="webshop.php">Continue Shopping</a>
            </div>
          </div>
        </div>

        <!-- Empty Cart Stops Here -->
      <?php  }
       else{

         $getOrderID = $connect2db->prepare("SELECT order_id FROM tbl_order WHERE user_id = ? AND payment_status = ? ");
        $getOrderID->execute([$id, 'Pending']);
        $getid = $getOrderID->fetch();
        $order_id = $getid->order_id;
       ?>
          <div class="container">
          <div class="row">
            <div class="col s12 center" style="padding-bottom:60px;"><h5>Your Shopping Cart</h5></div>
            <div class="row white-text">
              <div class="col m6 s12 left">Product(<?php echo $tp ?>)</div>
              <div class="col m2 s12">Quantity</div>
              <div class="col m2 s12">Unit Price</div>
              <div class="col m2 s12">Sub Total</div>
            </div>

              <?php 
          $getProduct = $connect2db->prepare("SELECT prd_order.id, prd_order.quantity,prd_order.status, prd_order.order_date,prd_order.total_amount,product.price,product.prd_name,product.image,prd_order.order_id,users.fname, users.lname FROM prd_order JOIN product on prd_order.product_id = product.id JOIN users on prd_order.user_id = users.id WHERE users.id = ? AND prd_order.order_id = ? ");
          $getProduct->execute([$id, $order_id]);
          while ($cart = $getProduct->fetch()) {?>
<div class="row white-text" style="height:129px;background-color:#3A3A3A;margin-bottom:0px">
              <div class="col m6 s12">
                <div class="row" style="margin-bottom:0px">
                  <div class="col s12 m3" style="padding:12px;">
                    <img src="admin/product/<?php echo($cart->image) ?>" style="height:102px;width:102px" class="responsive-img">
                  </div>

                  <div class="col s12 m8" style="padding-top:10px;padding-bottom:57px;"><?php echo($cart->prd_name) ?></div>
                  <div class="col s12 m8" style="padding-bottom:7px"><a href="cart.php?id=<?php echo $cart->id;?>" style="color:#DAC08E"><span><img src="images/icon/trash.png"></span> &nbsp; Delete </a></div>
                </div>
              </div>
              <div class="col m2 s12" style="padding-top:22px;">

                <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;" class="min" id="<?php echo $cart->id;?>" onclick="var result = document.getElementById('val<?php echo $cart->id;?>'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;">-</button>

                        <input type="text" name="quantity" readonly="true" class="white-text browser-default input quantity" style="width:40px;height:40px;padding:5px;text-align:center;border-radius:5px" data-id="<?php echo($row->id)?>" value="<?php echo($cart->quantity) ?>" id="val<?php echo($cart->id)?>">
                        <!-- id="sst6<?php //echo($cart->id)?>_menu" -->
                        <!-- <input type="hidden" name="product" value="<?php ($row->id)?>"> -->

                        <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;cursor:pointer;" id="<?php echo $cart->id;?>" class="add" type="button" onclick="var result = document.getElementById('val<?php echo $cart->id;?>'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;">+</button>

              </div>
              <div class="col m2 s12 unit" style="padding-top: 22px;" id="unitPrice<?php echo $cart->id;?>"><?php echo($cart->price)?></div>
              <input type="hidden" id="order_id" value="<?php echo $order_id; ?>">
              <div class="col m2 s12 total" id="subTotal<?php echo($cart->id)?>" style="padding-top: 22px;" ><?php echo($cart->total_amount) ?></div>
            </div>
            <br style="margin-top: 0px;">
          <?php
        }
        ?>

      <div class="col s12" style="margin-bottom: 0px;">
        <p class="right p" > Shipping Fee &nbsp; &nbsp; &nbsp; <span class="span"><?php echo "€".number_format(1000.00,2);?></span></p>
      </div>
      <div class="col s12">
          <p class="right p"> Sub Total &nbsp; &nbsp; &nbsp; <span class="span"> € </span>
            <span id="totalOrderPrice" style="color:#DAC08E;">
            <?php 
            $getTotal = $connect2db->prepare("SELECT SUM(total_amount) AS total FROM `prd_order` WHERE user_id = ? AND order_id = ? ");
            $getTotal->execute([$id, $order_id]);
            $cart = $getTotal->fetch();
          echo number_format($cart->total, 2);?></span></p>
      </div>      

<div class="col right" style="margin-top:70px;"> 
  <a class="btn" style="background-color:transparent;color:#DAC08E;border:1px solid #DAC08E;height:51px;" href="webshop.php">Continue Shopping</a>
  <a class="btn planbtn" href="<?php isset($_SESSION['id'])?print'checkout.php?status=product':print'login.php';?>">Checkout</a>
</div>
            
        </div>
        
     <?php  }
     
     }
?>


<?php include'footer.php';?>


<script type="text/javascript">
  let emptyCart = '<div class="col s12 center" style="align-items:center;align-content:center;align-self:center;"><div class="shopper center" style="margin-left:40%"> <img src="images/icon/shopper1.png" class="responsive-img center"></div> <p class="center empty" style="">Your cart is empty</p>  <p class="center" style="">Goto our webshop and add an item to your cart</p></div><div class="col s12 " style="margin-top:56px;"><a class="btn planbtn" style="height:51px;" href="webshop.php">Continue Shopping</a></div>';
  if (JSON.parse(localStorage.getItem('items')) === null || JSON.parse(localStorage.getItem('items')) === undefined || JSON.parse(localStorage.getItem('items')).length == 0) {
    $('#getProduct').html("");
        $('#getProduct').append(emptyCart);
    } else{
      let data = localStorage.getItem('items');
      // console.log(data);
      $.ajax({
        method: 'POST',
        data:{data:data},
        url:'getlocalproduct.php',
        success:function(data){
          $('#getProduct').html("");
          $('#getProduct').append(data);
          // alert(data);
          $('#getProduct').append(' <div class="col s12" style="margin-bottom: 0px;">  <p class="right p" > Shipping Fee &nbsp; &nbsp; &nbsp; <span class="span">€ 0.00</span></p> </div></div><div class="col right" style="margin-top:70px;">   <a class="btn" style="background-color:transparent;color:#DAC08E;border:1px solid #DAC08E;height:51px;" href="webshop.php">Continue Shopping</a>  <a class="btn planbtn" href="<?php isset($_SESSION['id'])?print'checkout.php':print'login.php?page=checkout';?>">Checkout</a></div>');
        }
      })
    }

  
</script>
<script>
      $(".add").on('click', function(){
        let addBtn = $(this).attr('id');
        let qty = $('#val'+addBtn).val();
        //alert(qty);
        // let unitPrice = $('div[id^="unitPrice"]').text();
        let unit = $('#unitPrice'+addBtn).text();
        let subTotal = $('#subTotal'+addBtn).text();
        let order_id = $('#order_id').val();
        subTotal = parseInt(qty) * parseInt(unit);
        $(".add").css( "border", "2px solid green");
        $(".add").css( "border-radius", "3px");
        $('#subTotal'+addBtn).html(subTotal);
        
            $.ajax({
            // url: 'cart.php',
            type: 'POST',
            data: {unit_id:addBtn, order_id:order_id, qty:qty, subTotal:subTotal},
            success: function(data) {
                //console.log(data);
                $('#totalOrderPrice').html(data);
                 //alert(data);
                }
            });
            //alert(addBtn + " " + order_id);
    });
      $(".min").on('click', function(){
        let minBt = $(this).attr('id');
        let minqty = $('#val'+minBt).val();
        let minunit = $('#unitPrice'+minBt).text();
        let minsubTotal = $('#subTotal'+minBt).text();
        let minorder_id = $('#order_id').val();
        minsubTotal = parseInt(minqty) * parseInt(minunit);
        $(".min").css( "border", "2px solid red");
        $(".min").css( "border-radius", "3px");
        $(".min").css( "mouse-over", "pointer");
        $('#subTotal'+minBt).html(minsubTotal);
        $.ajax({
            type: 'POST',
            data: {unit_id:minBt, order_id:minorder_id, qty:minqty, subTotal:minsubTotal},
            success: function(data) {
                console.log(data);
                $('#totalOrderPrice').html(data);
                 //alert(data);
                }
            });
       
    });        
    

</script>
