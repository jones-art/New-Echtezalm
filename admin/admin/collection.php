<?php include 'header.php'?>
<style type="text/css">
	
</style>
<div class="clearfix"></div>
  
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
      <!-- Content Start From Here -->
      <br><br><br><br>
        <div class="row mt-3">
            <!-- LEFT COLOUMN DIV START HERE -->
        <div class="col-sm-8">
          <ul class="navbar-nav ml-4 ml-4 align-items-center">
            <li class="nav-item">
                &nbsp;
              <!-- <form class="search-bar">
                <input type="text" class="form-control" placeholder="Enter keywords" style="background:transparent;">
                 <a href="javascript:void();"><i class="icon-magnifier"></i></a>
              </form> -->
            </li>
          </ul>
        </div>
          <div class="col-sm-4 text-right" style="padding-right: 4%">
              <a class="btn btn-primary" href="add-collection.php">Add Collection</a>
         </div>
      </div><!--End Row-->
    <div class="row">
        <div class="col-xl-12">

          <div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="color:#fff">
                    <tr>
                        <th></th>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Visibility</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include '../includes/connection.php';
                        $product = $connect2db->prepare("SELECT * FROM collection ");
                        $product->execute(['user']);
                        for($a=0; $a< 10; $a++)
                         { 
                           for($b=1; $b< 11; $b++)
                              {
                                $i = $a.$b;
                                if ($row = $product->fetch()) {
                            ?>
                            <tr class="mt-3 mb-3" style="background: #3A3A3A;">
                                <td><input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td>
                                <td><img src="collection/<?php echo $row->images ?>" height="53px" width="53px"></td>
                                <td><?php if($i ==10){echo 10;}else{ echo $i;}?></td>
                                <td><?php echo $row->Coll_details; ?></td>
                                <td><?php echo number_format($row->price,2); ?></td>
                                <td><?php echo $row->quantity; ?></td>
                                <td><?php  $row->featured?$f='Home':$f='Null'; echo($f); ?></td>
                                <td><?php ($row->status)?$s='Available':$s='Not Available';echo($s); ?></td>
                                <td><a href="add-collection.php?eid=<?php echo($row->id);?>" style="color:#DAC08E;">Edit</a></td>
                            </tr>
                        <?php
                        }}}
                    ?>
                   
                  </tbody>
              </table>

              </div>
            </div>
        </div>
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