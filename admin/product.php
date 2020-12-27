<?php include 'header.php'?>
<style type="text/css">
	
</style>
<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background: #2B2B2B;align-items: center;">
    <div class="container-fluid" >
    	<!-- Content Start From Here -->
        
        <div style="height:80vh;" class="container mt-3 text-center">
            <div class="row container-fluid ml-5" style="position: relative;top: 50%;">
                <div class="col-lg-2"></div>
                <a href="product-webshop.php">
                    <div class="col-lg-2">
                        <div style="width:170px;height:170px;background:#3A3A3A;border-radius: 50%;" class="text-center pt-5">
                            <img src="images/webshop-icon.png">
                        </div>
                        <div class="text-center pl-5 mt-3" style="color:#DAC08E;">Webshop</div>
                    </div>
                </a>


                <div class="col-lg-2"></div>
               
               <a href="collection.php" class="text-center">
                   <div class="col-lg-3">
                    <div style="width:170px;height:170px;background:#3A3A3A;border-radius: 50%;" class="text-center pt-5">
                        <img src="images/collection-icon.png">
                    </div>
                    <div class="text-center pl-5 mt-3" style="color:#DAC08E;">Collection</div>
                </div>
               </a>

            </div>
        </div>

    	<!-- Content Ends Here -->
    </div>
  </div>

<?php include 'footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#default-datatable').DataTable();
	});
</script>
