<?php include 'head.php' ?>
<!-- <style>
ul, li .account{
  list-style-image: url('images/icon/user.png');
}
</style> -->
<?php 
if(isset($_GET['product_id']) && isset($_GET['order_id'])){
  $prSuID = $_GET['product_id'];
  $order = $_GET['order_id'];

  $sub = $connect2db->prepare("SELECT p.id,p.user_id,p.product_id,p.order_date,p.order_id,p.total_amount,prd.prd_name,prd.description,prd.image,prd.id,prd.price FROM prd_order as p INNER JOIN product as prd ON p.product_id=prd.id WHERE p.id=? AND order_id=? AND user_id=?");
  $sub->execute([$prSuID,$order,$id]);
  $suscrib = $sub->fetch();
  $suscrib->order_id;

  $productID = $_GET['order_id'];
  $rv = $connect2db->prepare("SELECT * FROM prd_order WHERE order_id =?");
  $rv->execute([$productID]);
  $prd = $rv->fetch();


// Rating from user
  if(isset($_POST['submit'])){
  $rating = round($_POST['rating']);
  $title = trim($_POST['title']);
  $message = trim($_POST['message']);

  $si = $connect2db->prepare("SELECT user_id, rating, title FROM review WHERE user_id=? AND prd_id=?");
  $si->execute([$id,$prSuID]);
  if($si->rowcount() >0 ){
    echo "<script> alert('Product Already Reviewed by you') </script>";
  }else{
    $status="product";
    // $prSuID==0?$status='Custom':$status='collection';
    // echo "<script> alert('".$status."') </script>";
    $ins = $connect2db->prepare("INSERT INTO review(user_id,prd_id,status,rating,title,message)VALUES(?,?,?,?,?,?)");
    $ins->execute([$id,$prSuID,$status,$rating,$title,$message]);
    if($ins){
      echo "<script> alert('Product Reviewed') </script>";
      }
    }
  }
}



?>
<!-- Description Section Start -->
<section style="padding-top: 0px;background: #0F0F0F;"> <!-- data-aos="flip-up-->
  <div class="container">
    <div class="row"  data-aos="flip-down" data-aos-duration="1000">
<div class="col l4 s12 m4 white-text card" id="black" style="background: #3A3A3A">
        <div class="card" style="padding-left:15px;background:transparent;box-shadow:0px 0px 0px 0px">
            <div class="card-content" style="text-align:left;align-content:left">
              <ul class="side-nav">
              <li class="account active">
                <div class="row">
                  <div class="col s2">
                    <img src="images/icon/<?php $page=='profile'?print'user.png':print'user-no.png';?>"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="profile.php" class=" <?php $page=='profile'?print'active':print'white-text';?>" style="margin-top:0px;padding-top:0px;">Account <?php //echo $delDate; ?></a>
                  </div>

                </div>
                
              </li>
              <li>
                <div class="row">
                  <div class="col s2">
                    <img src="images/icon/lock-no.png"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="profile-orders.php" class=" <?php $page=='profile'?print'active':print'white-text';?>" style="margin-top:0px;padding-top:0px;">Bestellingen</a>
                  </div>

                </div>
              </li>
              <li>
               <div class="row">
                  <div class="col s2">
                    <img src="images/icon/<?php $page=='psub'?print'diamond.png':print'diamond-no.png';?>"style="width:24px;height:24px;margin-top:0px">
                  </div>

                  <div class="col s2">
                    <a href="profile-subscription.php" class=" <?php $page=='psub'?print'active':print'white-text';?>" style="margin-top:0px;padding-top:0px;">Abonnement</a>
                  </div>

                </div>
              </li>
            </ul>
            </div>
            <div class="card-action center">
              <a href="logout.php" class="white-text">Afmelden</a>
            </div>
          </div>

      </div> <!-- left panel -->
      <div class="col l8 m8 s12 right-align">
        <div class="row">
          <div class="col l12"> 
            <div class="card"style="background:transparent;padding:10px;border:1px solid #fff">
              <div class="card-content">
                  <div class="row"><div class="col l12">
                  <h5 class="left-align"> Order Details</h5>
                  <hr>
                  <div class="row">
                    <div class="col l12 m12"><p class="white-text">Order No: <?php echo $order;?></p></div>
                  </div>

                  <div class="row center" style="padding-left:0px;margin-bottom:30px;margin-top:0px">
                    <div class="col l11 m11" style="height:110px">
                        <div class="row">
                          <div class="col l4 s4" style="padding-left:0px">
                            <img src="admin/product/<?php echo $suscrib->image;?>" style="width:130px;height:130px;margin-top:26px">
                          </div>
                          <div class="col l8 s8">
                            <div>
                            <p style="margin-bottom:0px;margin-top:30px"><?php echo $suscrib->prd_name;?> - <?php echo $suscrib->description;?></p></div>

                            <div style="margin-top:20px">
                            <p style ="margin-bottom:0px"> Placed on <?php echo $suscrib->order_date;?></p>
                            <p style="margin-bottom:0px;margin-top:0px;color:#DAC08E"> € <?php echo number_format($suscrib->total_amount,2);?></p> </div>
                          </div>
                            
                        </div>
                    </div>  <!-- Left side pane of the right account panel -->
                  </div>
                </div></div>
                <!-- <a href="!#" class="center" style="color:#DAC08E;">Renew</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top:0px">
          <div class="col l12"> 
            <div class="card"style="background:transparent;padding:10px;border:1px solid #fff;height:240px">
              <div class="card-content">
                  <div class="row"><div class="col l12">
                  <h5 class="left-align"> Delivery Information</h5>
                  <hr>
                  <div class="row">
                    <div class="col l12 m12"><p class="white-text">Shipping Address</p></div>
                  </div>

                  <div class="row center" style="margin-top:25px;padding-left:0px;">
                    <div class="col l11 m11">
                        <div class="row">
                          <div class="col l8 s8">
                            <div style="margin-top:0px">
                            <p style ="margin-bottom:0px"> 
                              <?php 
                                $i = $connect2db->prepare("SELECT DISTINCT(user_id) as user, country, state, lga, zip_code,apartment FROM shipping_details WHERE user_id=? and order_id=?");
                                $i->execute([$id,$order]);
                                
                                if($i->rowcount() <1){
                                  echo "Delivery Information not found";
                                }else{$col = $i->fetch();?> 
                                  <?php echo $col->apartment;?> <br>
                                 <?php echo $col->lga;?> <br>
                                 <?php echo $col->state . ''. $col->country;?> <br>

                                <?php } ?>
                            </p>
                            </div>
                          </div>  <!-- Left side pane of the right account panel -->
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- right panel -->
    </div>
        <div class="row" style="margin-top:0px">
          <div class="col l12"> 
            <div class="card"style="background:transparent;padding:10px;border:1px solid #fff;height:320px">
              <div class="card-content">
                  <div class="row"><div class="col l12">
                  <h5 class="left-align"> Payment Information</h5>
                  <hr>
                  <div class="row">
                    <div class="col l12 m12"><p class="white-text">Payment Method:  <span class="white-text">Ideal</span></p> </div>
                  </div>

                  <div class="row center" style="margin-top:15px;padding-left:0px;">
                    <div class="col l11 m11">
                      <h5 class="white-text left-align">Payment Detail</h5>
                        <div class="row">
                          <div class="col l4 s4">
                            <div style="margin-top:0px">
                            <p style ="margin-bottom:0px"> Product Total:</p>
                            <p style ="margin-bottom:0px"> Shipping Fee:</p>
                            <p style ="margin-bottom:0px"> Total:</p>
                            </div>
                          </div>  <!-- Left side pane of the right account panel -->
                          <div class="col l8">
                            <p style="margin-bottom:0px;margin-top:0px;color:#DAC08E"> €<?php echo number_format($suscrib->price,2);?></p>
                            <p style="margin-bottom:0px;margin-top:0px;color:#DAC08E"> €1,000.00</p>
                            <p style="margin-bottom:0px;margin-top:0px;color:#DAC08E"> €<?php echo number_format($suscrib->price + 1000, 2);?></p>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- right panel -->
    </div>
<?php 
  $r = $connect2db->prepare("SELECT user_id, rating, title,message FROM review WHERE user_id=? AND prd_id=?");
  $r->execute([$id,$prSuID]);
  if($r->rowcount() >0 ){$ri = $r->fetch();?>
        <div class="row" style="margin-top:0px">
          <div class="col l12"> 
            <div class="card"style="background:transparent;padding:10px;border:1px solid #fff;">
              <div class="card-content">
                  <div class="row"><div class="col l12">
                  <h5 class="left-align" style="margin-top:0px"> Your Review</h5>
                  <hr>
                  <div class="row" style="padding-left:15px">
                     <div class="left-align">
                      <?php
                      for($i=1;$i<=$ri->rating;$i++){
                          echo "<img src='images/icon/star.png' style='margin-top:7px'>";
                        }
                      ?>
                      </div>
                    <p class="white-text"> <?php echo $ri->title;?></p> <br>
                    <p class="white-text" style ="margin-bottom:0px;width:85%"><?php echo $ri->message; ?></p>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- right panel -->
    </div>

  <?php
  }else{ ?>
    <form method="POST">
        <div class="row" style="margin-top:0px">
          <div class="col l12"> 
            <div class="card"style="background:transparent;padding:10px;border:1px solid #fff">
              <div class="card-content">
                  <div class="row"><div class="col l12">
                  <h5 class="left-align"> Schrijf een recensie</h5>
                  <hr>
                  <div class="row">
                    <div class="col l12 m12"><p class="white-text">Beoordeel onze service</p></div>
                    <!-- rating stars -->
                    <br>
                    <div class="rateyo" id= "rating" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3">
                     </div>
                         <span class='result'>0</span>
                      <input type="hidden" name="rating">
                  </div>

                  <div class="row center" style="margin-top:25px;padding-left:0px;">
                    <div class="col l11 m11">
                        <div class="row">
                          <div class="col l12 s12">
                            <div style="margin-top:0px">
                              <div class="row">
                                <div class="col s12 input-field">
                                  <label for="title" style="padding-left: 20px;">Title <span class="red-text">*</span> </label>
                                  <input type="text" id="title" class="browser-default input" name="title">
                                </div>
                                <div class="col s12 input-field">
                                  <label for="phone" style="padding-left: 20px;">Message <span class="red-text">*</span> </label>
                                  <textarea class="browser-default input" style="height: 111px;" name="message"></textarea>
                                </div>
                                <div class="col s12 input-field">
                                    <!-- <input type="submit" class="btn planbtn" name=""> -->
                                    <button class="btn planbtn right" type="submit" name="submit">Submit</button>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </form>


            </div>
          </div>
        </div>

        <?php } ?>
      </div> <!-- right panel -->
    </div>
  </div>
</section>
<!-- Description Section End -->
<!-- <img src="images/icon/user.png"style="width:24px;height:24px"> -->
<?php include ('footer.php'); ?>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card -->
<script type="text/javascript" src="js/flip.min.js"></script>
<!-- rating animation script -->
<script src="js/rateyo.min.js"></script>

<script type="text/javascript">
  AOS.init();
  $('.carousel').carousel({
    fullWidth: true,
    indicators: true
});

var autoplay = true;

setInterval(function() { 
    if(autoplay) $('.carousel.carousel-slider').carousel('next');
}, 4500);


</script>
<script>
 
 
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
 
</script>
<?php include 'script.php' ?>