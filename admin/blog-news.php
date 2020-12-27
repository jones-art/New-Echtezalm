<?php include 'head.php';include 'includes/connection.php'; ?>
<?php 
$fullname =$_SESSION['fullname'];
if(isset($_GET['details'])){
    $data = urldecode(base64_decode($_GET['details']));
    $blogID = (($data/123456789/987)*789);
    $sql = $connect2db->prepare("SELECT * FROM blog WHERE id=?");
    $sql->execute([$blogID]);
    if($sql->rowcount() >0){
      $blog = $sql->fetch();
    }

if(isset($_POST['comment'])){
  $name = '';
  isset($_SESSION['id'])?$name = $_SESSION['fullname']:$name=$_POST['userName'];
  $comment = trim($_POST['commentMessage']);
  $ins = $connect2db->prepare("INSERT INTO comments(user,prd_id,comment,page_like,dislike)VALUES(?,?,?,?,?)");
  $ins->execute([$name,$blogID,$comment,0,0]);
}
  if(isset($_GET['like-id'])){
    echo $like = $_GET['like-id'];
    // echo "<script> alert($like);</script>";
    $upd = $connect2db->prepare("UPDATE comments SET page_like=page_like+1 WHERE id=?");
    $upd->execute([$like]);
  }


}

?>
<!-- First Coloum -->
<section style="background:#0F0F0F">
  <div class="container" style="padding-top: 2%">
    <div class="collection"></div>
  </div>

  <div class="container">
      <img src="admin/blog/<?php echo $blog->image;?>" class="card-img-top" alt="..." style="max-height:70vh;width:100%">
      <div style="padding-top:10px;margin-bottom: 20px">
        <h4 class="left-align white-text"><?php echo date('F j, Y',strtotime($blog->created_on));?></h4>
        <p class="text-white mt-2"><?php echo $blog->blog_title;?></p>
      </div>

      <div class="text-white left-align white-text">
        <?php echo $blog->content;?>
      </div>

  <div class="container-fluid align-left">
      <div class="row">
        <div class="col s2">
          <p class="white-text" style="font-weight:400;font-size:16px;letter-spacing:5%;line-height:24px">Delen </p>
        </div>
        <div class="col s10">
     <a class="btn text-white" style="background:#3A559F;text-transform:capitalize;height:36px;display: inline-flex;">
      <img src="images/icon/facebook3.png" style="margin-top:3px;width:30px;height:30px">Facebook</a>
     <a class="btn text-white" style="background:#1BD741;text-transform:capitalize;display:inline-flex;"><img src="images/icon/whatsapp.png" style="margin-top:6px;height:26;width:26px"> Whatsapp</a>
    <a class="btn text-white" style="background:#50ABF1;text-transform:capitalize;display:inline-flex;"><img src="images/icon/twitter.png" style="margin-top:6px;height:26;width:26px"> Twitter </a>
        </div>
      </div>
    <div class="mt-4 ml-0">
 
    </div>
    <div class="container" style="padding-bottom: 3%">
       <!--  <div class="collection"></div> -->
    </div>
  </div>
</section>
<section style="background:#0F0F0F;margin-bottom:0px">
  <div class="container">
    <div class="row" style="margin-bottom:0px">
      <div class="col s8">
        <h4 class="left-align" style="color:#DAC08E"> Laat een antwoord achter</h4>
        <hr style="border: 1px solid rgba(255, 255, 255, 0.3);margin-bottom:31px;margin-top:31px">
        <div class="collection" style="border:0px;padding-top:20px">
           <form method="POST">
            <div class="form-row">
              <?php if(!isset($_SESSION['id'])){?>
              <div class="col s12">
                <input type="text" name="userName" placeholder="Input Username" class="browser-default" style="width:100%;height:36px;border:1px solid grey;background:transparent;margin-bottom:15px;padding-left:10px;color:#fff">
              </div>
            <?php }?>
              <div class="col s12">
                <textarea class="form-control text-white" style="height:200px; background:transparent;color:#fff" placeholder=" Start a discussion" name="commentMessage"></textarea>
                <button type="submit" name="comment" class="btn-primary btn-lg btn planbtn right" style="margin-left:0px"> Plaats een reactie</button> 
              </div>           
            </div>
          </form>         
        </div>
        <div class="mt-4">
          <hr style="border: 1px solid rgba(255, 255, 255, 0.3);margin-bottom:31px;margin-top:31px">
<div  style="max-height: 300px;margin-bottom: 50px">
<?php 
  $sq = $connect2db->prepare("SELECT * FROM comments WHERE prd_id=?");
  $sq->execute([$blogID]);
  if($sq->rowcount() <1){?>
          <p class="white-text center"> wees de eerste om te reageren</p>
        <?php }else{while($comm = $sq->fetch()){$comID = urlencode($comm->id);?>
          <div class="row">
            <div class="col l8"> <p class="whte-text"> <?php echo $comm->user;?></p></div>
            <div class="col l4"><p class="whte-text">
              <?php echo date('F j, Y', strtotime($comm->created_on));?> </p></div>
            <div class="col s12">
              <p class="white-text" style="text-align:justify-all;"> <?php echo $comm->comment;?></p>
            </div>
          </div>
        <div class="row">
          <div class="col s3">
            <?php if(isset($_SESSION['id'])){?>
            <ul style="display:inline-flex;">
              
              <li> <a href="<?php echo $_SERVER['PHP_SELF'];?>?details=<?php echo $_GET['details']?>&like-id=<?php echo $comID?>"><img src="images/icon/like-up.png" style="margin-top:0px"></a></li>
              <li> <span class="white-text" style="margin-right:30px"> 
                <?php 
                $q = $connect2db->prepare("SELECT like FROM comments WHERE user=? AND page_like!=?");
                $q->execute([$fullname,0]);
                  if($q->rowcount()>0){
                    echo '';
                  }else{
                    echo $comm->page_like;
                  }
                  ?></span></li>
              <li> <img src="images/icon/like-down.png" style="margin-top:0px"></li>
              <li> <span class="grey-text"> 23</span></li>
            </ul>
          <?php }?>
          </div>
        </div>        
      <?php }}?>
        </div>

</div>   
      </div>
      <div class="col s4">
        <h4 style="color:#DAC08E"> Gerelateerd artikel</h4>
        <hr style="border: 1px solid rgba(255, 255, 255, 0.3);margin-bottom:31px;margin-top:31px">
  <!-- <marquee direction="down" scroll-amount="2"> -->
<?php
$getBlogDetails = $connect2db->prepare("SELECT * FROM blog ORDER BY id DESC LIMIT 5");
          $getBlogDetails->execute();
          if ($getBlogDetails->rowcount() > 0) {
            while ($row = $getBlogDetails->fetch()) {
              $data = (($row->id*123456789*987)/789);
              $url = urlencode(base64_encode($data)); 
              ?>
              <div class="card"  style="margin-bottom:0px;background: #3A3A3A;">
                <div class="card-image">
                  <img src="admin/blog/<?php echo $row->image?>" style="margin-top:0px;height:265px">
                </div>
                <div class="card-content " style="padding-bottom:28px;padding-left:20px;padding-right:30px">
                    <h6 class="blogTit"><?php echo date('F j, Y', strtotime($row->created_on));?></h6>
                    <p class="blogPar white-text" style="line-height:26.66px;font-size:18px"> 
                      <a href="blog-news.php?details=<?php echo$url;?>" class="white-text"> <?php echo($row->blog_title);?> </a>
                    </p>
                </div>
               </div>
      <?php }}?>
  <!-- </marquee> -->
      <div style="height:121px"></div>
      </div>
    </div>
  </div>
</section>
<!-- Blog comment and reply -->
<hr style="border: 1px solid rgba(255, 255, 255, 0.3);margin:0px">
<section style="background:#0F0F0F;padding-top:45px;padding-bottom:56px">
  <div class="container">
    <div class="row">
      <div class="col s5">
        <p class="white-text"> Meld u nu aan voor ons kortingsproduct</p>
      </div>
      <div class="col s7">
        <form>
          <div class="form-row">
            <div class="col s12 l6">
              <input type="text" placeholder="Johndoe@gmail.com" name="" class="form-control text-white" style="border: 2px solid rgba(255, 255, 255, 0.3);color:grey;background: transparent;height:50px;padding-left:10px">
            </div>
            <div class="col s12 l6">
              <button class="btn text-white btn-primary planbtn btn-lg Subscribe">Subscribe</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php include('footer.php') ?>