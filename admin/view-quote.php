<?php include 'header.php'; ?>
<?php 
  
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $getDatas = $connect2db->prepare("SELECT * FROM quote WHERE id = ?");
    $getDatas->execute([$id]);
    $datas = $getDatas->fetch();
    $name = $datas->name;
    $order_id = $datas->order_id;
    $desc  = $datas->description;
    $date = $datas->date;
    $file = $datas->file;

   



  }

?>
<style type="text/css">
  .invoice-card{
    font-family: Poppins;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 22px;
    display: flex;
    align-items: center;
    letter-spacing: 0.05em;

    color: #FFFFFF;
  }
</style>

<div class="clearfix"></div>
  
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">

      <div class="row mt-5">
        <div class="col-sm-12 text-right pr-5 mt-4">
          <a class="btn" style="width:174px;height:51px;color:#fff; background-color:#AD976E;border:0px;padding-top:15px;" href="invoice/<?php echo $file?>">Download Invoice</a>
        </div>

        <div class="col-sm-12 container-fluid" style="padding: 10px 260px 0px 260px;">
          <div class="col-sm-12" style="background: #3A3A3A">
            <div class="pb-3 pt-2"><img src="images/logo-white.png"></div>

            <div>
              <h5 style="padding-top:24px;font-style:normal;font-weight:500;font-size:22px;line-height:33px;color:#fff;">Hello, <?php echo $name ?></h5>
              <p style="padding-top:15px;font-style:normal;font-weight:300;font-size:18px;color:#fff;text-align:justify;text-transform:capitalize;">
                <?php echo $desc ?>
              </p>
              
              <div style="padding-top:15px;padding-bottom:15px;font-style:normal;font-weight:500;font-size:22px;color:#fff;">Your Order #<?php echo $order_id ?> <small class="text-muted">(<?php echo $date ?>)</small></div>
          </div>
            
            <div class="row">
             

             


                <div class="col-sm-12 col-lg-12">
                  <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
                    <div class="card-header invoice-card text-white" style="background:#3A3A3A;">Item Ordered</div>
                    <div class="card-body card-bodys">
                      <?php
                        $sql = "SELECT quote.order_id, items.order_id, items.quantity, items.product_id,items.total_amount, product.prd_name, product.id FROM quote JOIN quote_items AS items ON quote.order_id = items.order_id JOIN product ON items.product_id = product.id WHERE quote.order_id = ?";
                        $getPrd = $connect2db->prepare($sql);
                        $getPrd->execute([$order_id]);
                        while ($row = $getPrd->fetch()) {?>
                         <p class="card-text"><?php echo $row->prd_name."(".$row->quantity.")<br>".$row->total_amount?> </p>
                       <?php }
                      ?>
                       
                    </div>
                  </div>
                </div>



            </div>

            


          </div>
        </div>
      </div>

    </div>
  </div>

<?php include 'footer.php'; ?>