<?php 
include 'head.php' ?>


<!-- Why You Should Use EchteZalm? -->
<section style="margin-top: 72px;background:#3A3A3A;">
  <div class="container" style="height:50px"></div>
  <div class="container"  data-aos="zoom-in" data-aos-duration="1000">
    <h5 class="center" style="margin-bottom:62px">Select Your Box Collection</h5>
        <div class="row" style="margin-bottom:71px">
          <?php
          include 'includes/connection.php';
          $getCollection = $connect2db->prepare("SELECT * FROM collection WHERE status = ? ");
          $getCollection->execute([true]);
          if ($getCollection->rowcount() > 0) {
            while ($row = $getCollection->fetch()) {
              $data = (($row->id*123456789*987)/789);
              $url = urlencode(base64_encode($data)); ?>
              <div class="col s12 l4 m6"  data-aos="flip-right" data-aos-duration="1000">
              <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
                <div class="card-image">
                  <img src="admin/collection/<?php echo($row->images); ?>" style="margin-top:0px;height:301px;">
                </div>
                <div class="card-content" style="padding-bottom: 16px">
                  <h5 class="white-text center" style="margin-bottom:0px">
                    <?php echo($row->Coll_details); ?>
                  </h5>
                  <p class="white-text center" style="margin-bottom:0px"><?php echo($row->info_details)?></p>
                    <h5 style="margin-bottom: 15px"> <strong> €<?php echo $row->price; ?></strong></h5>
                    <a href="<?php if (isset($_SESSION['email'])) {
                      echo 'collection_page_description.php?id='.$url;}else{echo 'login.php';}?>" style="margin-top:11px;color:#AD976E"> See features</a>
                    <a href="<?php if (isset($_SESSION['email'])) {
                      echo 'custom_collection_checkout.php?id='.$url;}else{echo 'login.php';}?>" class="webBtn center" style="margin-top:30px;margin-bottom:15px">Select Plan</a>
                </div>
              </div>
            </div> 
           <?php }
          }
        ?></div>

            <!--   First Coloum -->
            
            <!-- <div class="col s6 l4 m6"  data-aos="flip-right" data-aos-duration="1000">
              <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
                <div class="card-image">
                  <img src="images/collection/dutch-edition.png" style="margin-top: 0px">
                </div>
                <div class="card-content" style="padding-bottom: 16px">
                  <h5 class="white-text center" style="margin-bottom:0px">Dutch Edition</h5>
                  <p class="white-text center" style="margin-bottom:0px">wine - 5, 15 or 30 pieces</p>
                    <h5 style="margin-bottom: 15px"> <strong> €39.95</strong></h5>
                    <a href="" style="margin-top:11px;color:#AD976E"> See features</a>
                    <a href="<?php if (isset($_SESSION['email'])) {
                      echo 'product_page_description.php?id=1';}else{echo 'login.php';}?>" class="webBtn center" style="margin-top:30px;margin-bottom:15px">Select Plan</a>
                  </div>
               </div>
            </div>
            
            <div class="col s6 l4 m6"  data-aos="flip-right" data-aos-duration="1000">
              <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px">
                <div class="card-image">
                  <img src="images/collection/classic-edition.png" style="margin-top: 0px">
                </div>
                <div class="card-content" style="padding-bottom: 16px">
                  <h5 class="white-text center" style="margin-bottom:0px">Classic Edition</h5>
                  <p class="white-text center" style="margin-bottom:0px">wine - 5, 15 or 30 pieces</p>
                    <h5 style="margin-bottom: 15px"> <strong> €39.95</strong></h5>
                    <a href="" style="margin-top:11px;color:#AD976E"> See features</a>
                    <a href="<?php if (isset($_SESSION['email'])) {
                      echo 'product_page_description.php?id=1';}else{echo 'login.php';}?>" class="webBtn center" style="margin-top:30px;margin-bottom:15px">Select Plan</a>
                  </div>
               </div>
            </div>
        </div> -->
    <div class="row">
    <div class="container center" style="margin-top:71px;margin-bottom:42px">
      <h5 class="center" style="margin-top:68px">Select and Customize Your Box</h5>
      <p class="white-text center" style="margin-bottom:82px">Choose from our selection of salmon and create your perfect box</p>
      <div class="row"><div class="col s12 l3 m6"></div>
        <div class="col s12 l4 m6 center" style="padding-left:40px">
              <div class="card black"  style="border:solid 1px #fff;margin-bottom:0px;width:316px">
                <div class="card-image">
                  <img src="images/collection/premium-edition.png" style="margin-top: 0px">
                </div>
                <div class="card-content" style="padding-bottom: 16px">
                  <h5 class="white-text center" style="margin-bottom:0px">Premium Custom Box</h5>
                   <h6 style="margin-bottom: 15px"> <strong> Starting from - €80.95</strong></h6>
                    <a href="<?php if (isset($_SESSION['email'])) {
                      echo 'custom_collection_page.php?id=1';}else{echo 'login.php';}?>" class="webBtn center">Select Plan</a>
                  </div>
               </div>
        </div><div class="col s12 l5 m6"></div>
      </div>
    </div>
    </div>
      <!-- Blog coloums Ends Here -->
      <div class="container" style="height:77px"></div>
  
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
  $('.carousel').carousel({
    fullWidth: true,
    indicators: true
});

var autoplay = true;

setInterval(function() { 
    if(autoplay) $('.carousel.carousel-slider').carousel('next');
}, 4500);


</script>
<?php include 'script.php' ?>
