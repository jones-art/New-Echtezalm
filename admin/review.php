<?php include 'header.php'?>
<style type="text/css">
  input{
    border:1px solid #fff;
    background: #000;
  }
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
              <a class="btn btn-primary" href="edit-review.php">Add Review</a>
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
                      <th>ID</th>
                      <th>Created</th>
                      <th>Status</th>
                      <th>Title</th>
                      <th>Customer Name</th>
                      <th>Visibility</th>
                      <th>Product</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // include '../includes/connection.php';
                        $product = $connect2db->prepare("SELECT * FROM review ");
                        $product->execute();
                        while ($row=$product->fetch()) {
                          
                        
                       
                            ?>

                            <tr class="mt-3 mb-3" style="background: #3A3A3A;">
                                
                                <td></td>
                                <td><?php echo $row->created?></td>
                                <td><?php ($row->visibility==0)?print'Pending':print'Live'; ?></td>
                                <td><?php echo $row->title; ?></td>
                                <td><?php 
                                  $user_id = $row->user_id; 
                                  $getName = $connect2db->prepare("SELECT fname, lname FROM users WHERE id = ?");$getName->execute([$user_id]);
                                  if ($getName->rowcount()>0) {
                                    $data = $getName->fetch();
                                    echo $data->fname." ".$data->lname;
                                  }
                                  ?>
                                  
                                </td>
                                <td><?php echo $row->rating; ?></td>
                                
                                <td><?php echo $row->visibility; ?></td>
                                <td><a href="edit-review.php?rid=<?php echo($row->id);?>" style="color:#DAC08E;">Edit</a></td>
                            </tr>
                        <?php
                        }
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
