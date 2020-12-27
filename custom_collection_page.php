<?php 
include 'head.php' ?>
<?php 
  if (isset($_POST['data'])) {
    ob_end_clean();
    $items = $_POST['data'];
    $user_id = $_SESSION['id'];
    $date = date('Y-m-d');
    $plan = 0;
    $status = 'Pending';
    $myRandom = str_pad(rand(1,999999), 5, '0', STR_PAD_LEFT);
    $total = $_POST['total'];
    $duration = $_POST['duration'];
    $sub_total = $total * $duration;



    // INSERT INTO DATABASE AND GET THE LAST INSERT ID
    // include 'includes/connection.php';
    $insertData = $connect2db->prepare("INSERT INTO subscriber (status,payment_status,user_id,sub_date,plan,order_id,month,sub_total)VALUES(?,?,?,?,?,?,?,?)");
    $insertData->execute([$status,$status,$user_id,$date,$plan,$myRandom,$duration,$sub_total]);
    if ($insertData) {
      $sub_id = $connect2db->lastInsertid();

      foreach ($items as $item) {
        $data = json_decode($item);
        $product = $data->product;
        $qty = $data->qty;
        
        $insertPrd = $connect2db->prepare("INSERT INTO tbl_custom_product (subscription_id,product_id,quantity,order_id)VALUES(?,?,?,?)");
        $insertPrd->execute([$sub_id,$product,$qty,$myRandom]);

      }

      if ($insertPrd) {
        for($i=1;$i<=$duration;$i++){
            $insData = $connect2db->prepare("INSERT INTO sub_duration(sub_id,user,delv_date,delv_status) VALUES(?,?,?,?)");
            $insData ->execute([$myRandom,$user_id,'0000-00-00','Pending']);
          }
          echo "<script> window.location='checkout.php?status=custom'; </script>";
          exit();
          // header('location:checkout.php?status=custom');
        // echo "Custom Subscription Add to Cart ";
      } else{
        $delete = $connect2db->prepare("DELETE FROM subscriber WHERE id = ?");
        $delete->execute([$sub_id]);
        if ($delete) {
          echo"Transction Rollback, Try Again";
          exit();
        }
      }

    } else{
      echo "Error with Custom Subscription";
      exit();
    }
    
    
   exit();
  }
?>
<div id="result"></div>
<section style="margin-top: 2px;background:#3A3A3A;">
  <div class="container" style="height:50px"></div>
  <div class="container"  data-aos="zoom-in" data-aos-duration="1000">
    <h5 class="center" style="margin-bottom:62px">Select Your Items</h5>
    <div id="result"></div>
    <div class="row">

      <div class="col l3 m12 s12 left-align" style="padding-top:0px">
        <h6 style="color:#AD976E">€ <span id="total">0</span></h6>
      </div>

      <div class="col l3 m12 s12 right-align">
        <div class="accordian" style="margin-top: 14px">
          <span >
            <small class="white-text" style="margin-top: 15px"> Number of Month</small>
           <a style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;cursor:pointer;" class="monRed">-</a>
                <input type="text" name="month" id="month" readonly="true" class="white-text browser-default input" style="width:25px;height:25px;padding:5px;text-align:center;border-radius:5px" value="1">
                <a style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;cursor:pointer;" class="monAdd">+</a>
          </span>
        </div>
      </div>

      <div class="col l3 m12 s12 right-align">
        <p class="white-text"><span id="rem">15</span> Selection(s) Remaining</p>
      </div>


      <div class="col l3 m12 s12 right-align">

                    <form id="product" >
        <button type="button" id="ptplan" class="webBtn center" style="padding-top:5px;border:solid 1px #AD976E"> Proceed to Plan </button>
      </div>
    </div> 

         <div class="row"> 
          <!-- <form method="POST" action=""> -->
<?php 
  // include 'includes/connection.php';
          $getCollection = $connect2db->prepare("SELECT * FROM product WHERE status = ? ");
          $getCollection->execute([true]);
          if ($getCollection->rowcount() > 0) {
            while ($row = $getCollection->fetch()) {
              $data = (($row->id*123456789*987)/789);
              $url = urlencode(base64_encode($data)); ?>



<!-- Why You Should Use EchteZalm? -->

            
            <div class="col s6 l3 m6"  data-aos="flip-right" data-aos-duration="1000">
              <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
                <div class="card-image">
                  <img src="admin/product/<?php echo $row->image?>" style="margin-top: 0px">
                </div>
                <div class="card-content" style="padding-bottom: 16px">
                  <h6 class="white-text center" style="margin-bottom:0px;margin-top:21px"><?php echo $row->prd_name?></h6>

                  <h6 class="white-text center" style="margin-bottom:0px;margin-top:21px"> € <?php echo number_format($row->price,2) ?></h6>


                    <div style="margin-top:21px;margin-bottom:18px">
                       <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;" class="min" disabled data-id="<?php echo $row->id;?>" data-amt="<?php echo($row->price)?>" type="button">-</button>

                        <input type="text" name="quantity" readonly="true" class="white-text browser-default input inputs" style="width:40px;height:40px;padding:5px;text-align:center;border-radius:5px" data-id="<?php echo($row->id)?>" value="0" id="val<?php echo($row->id)?>">

                        <!-- <input type="hidden" name="product" value="<?php ($row->id)?>"> -->

                        <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;cursor:pointer;" class="add" type="button" data-id="<?php echo $row->id;?>" data-amt="<?php echo($row->price)?>" type="button">+</button>
                      <!-- <a href="" style="color:#fff;font-weight:500;font-size:20px;margin:5px">
                      +</a> -->
                    </div>

                    <a href="<?php if (isset($_SESSION['email'])) {
                      echo 'collection_page_description.php?id='.$url;}else{echo 'login.php';}?>" style="margin-top:30px;margin-bottom:15px;color:#AD976E">See details</a>

                    
                </div>
              </div>
            </div>

            
            <?php
          }
        }
        ?>
            
</div>

</form>
      <!-- Blog coloums Ends Here -->
      <div class="container" style="height:77px"></div>
  </div>
</section>
<!-- Customer comment ends here -->

<?php include ('footer.php'); ?>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card -->
<script type="text/javascript" src="js/flip.min.js"></script>

<script type="text/javascript">
  AOS.init();

  let remItem = $('#rem').html();
  let total = '';
  let month = parseInt($('#month').val());
  let totalNMonth = ''

  $('.min').each(function() { //decremental buttons
      $(this).click(function() { 
          const id = $(this).data('id');
          const input = $('#val'+id);
          let previousQty = Number(input.val());
          
           if (previousQty <= 0) {$(this).attr('disabled', true)}else{
            remItem = Number(remItem) + 1;
            let amount = $(this).data('amt');
          let initAmt = $('#total').html();
          total = Number(initAmt) - Number(amount) 
          $('#total').html(total.toFixed(2));
            $('#rem').html(remItem);
          }

          if (previousQty > 0) { //qty cannot be less than 0
              input.val(--previousQty);
              let totalNMonth = Number(month) * Number(total);
          $('#ptplan').html('Proceed to Pay '+totalNMonth);
          }
          
           if (remItem !=0) {$('.add').removeAttr('disabled');}
      });
  });


  $('.add').each(function() {
      $(this).click(function() {
        $('.min').removeAttr('disabled');
    if (remItem ==1) {$('.add').attr('disabled', true)}
        remItem = Number(remItem) - 1;
        $('#rem').html(remItem);


        let amount = $(this).data('amt');
        let initAmt = $('#total').html();
        total = Number(initAmt) + Number(amount);

        $('#total').html(total.toFixed(2));
          const id = $(this).data('id');
          const input = $('#val'+id);
          let previousQty = Number(input.val());
          input.val(++previousQty);
          totalNMonth = Number(month) * Number(total);
          $('#ptplan').html('Proceed to Pay '+totalNMonth);
      })
  });



  
    
    // console.log(month);
    // console.log(price);
    let total_price = (month * total);
      $('#ptplan').html(total_price);
    

     $('.monAdd').on('click', ()=>{
      // alert(total)
        month = parseInt(month);
        if (month<12) {
           month = month+1;
        $('#month').val(month);

        let total_price = (month * total);
      $('#ptplan').html('Proceed to Pay '+total_price);
        }
      });

      $('.monRed').on('click', ()=>{
        // alert(total)
        month = parseInt(month);
        if (month>1) {
          month = month-1;
        $('#month').val(month);

         totalNMonth = (month * total);
      $('#ptplan').html('Proceed to Pay '+totalNMonth);
        }
      });

      $('#month').on('input', ()=>{
        let quantity = parseInt($('#month').val());
        let total_price = (quantity * price);
        $('#total_price').html(total_price);
      });

 let data=[];
$('#ptplan').click(function(){
  $('#ptplan').attr('disabled', true)
  // console.log(total);
  // console.log(data);
  // console.log(data.length);
  $('.inputs').each(function(){
    let qty = Number($(this).val());
    // console.log(qty);
    if (qty > 0) {
      let temp = {
        product:$(this).data('id'),
        qty
      }
      data.push(JSON.stringify(temp))
    }
     

  });
 

  console.log(data.length);
 if (data.length<=0) {
  alert("Please Select a product")
 } else{
   $.ajax({
    method:"POST",
    data:{data:data, total:total, sub_total:totalNMonth, duration:month},
    success: function(data){
      $('#result').html(data)
      // alert(data);
      $('#product')[0].reset();
    }
  });
}

  });

</script>

<?php include 'script.php' ?>
