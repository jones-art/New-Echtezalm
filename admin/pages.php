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

    <div class="row">
        <div class="col-xl-12">

          <div class="card" style="background:transparent;">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="default-datatable"> <!-- id="default-datatable"  -->
                <thead style="color:#fff">
                    <tr>
                      <th></th>
                      <th>Title </th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Modified</th>
                        <th>
                          
                        </th>
                    </tr>
                </thead>
                <tbody>
                      <tr class="mt-3 mb-3" style="background: #3A3A3A;">
                          <td><input type="checkbox" name="" style="border: 1px solid #fff;background:transparent;"></td>
                          <td>Home</td>
                          <td>Enable</td>
                          <td>3/08/2020</td>
                          <td>31/08/2020</td>
                          <!-- <td>
                            <select class="form-control" style="width:100px;height:30px">
                              <option value="" disabled selected> Action </option>
                               <a href="pages.php" style="color:#DAC08E;"><option> Delete</option></a>
                               <a href="edit-page-home.php" style="color:#DAC08E;"> <option> Edit</option></a>
                            </select>
                            </td> -->
                            <td> <a href="edit-page-home.php">Edit </a></td>
                        </tr>
                      <tr class="mt-3 mb-3" style="background: #3A3A3A;">
                          <td><input type="checkbox" name="" style="border: 1px solid #fff;background:transparent;"></td>
                          <td>Collection</td>
                          <td>Enable</td>
                          <td>3/08/2020</td>
                          <td>31/08/2020</td>
                         <!--  <td>
                            <select class="form-control" style="width:100px;height:30px">
                              <option value="" disabled selected> Action </option>
                               <a href="pages.php" style="color:#DAC08E;"><option> Delete</option></a>
                               <a href="edit-page-collection.php" style="color:#DAC08E;"> <option> Edit</option></a>
                            </select>
                            </td> -->
                            <td> <a href="edit-page-collection.php">Edit </a></td>
                        </tr>
                      <tr class="mt-3 mb-3" style="background: #3A3A3A;">
                          <td><input type="checkbox" name="" style="border: 1px solid #fff;background:transparent;"></td>
                          <td>Webshop</td>
                          <td>Enable</td>
                          <td>3/08/2020</td>
                          <td>31/08/2020</td>
                          <!-- <td>
                            <select class="form-control" style="width:100px;height:30px">
                              <option value="" disabled selected> Action </option>
                               <a href="pages.php" style="color:#DAC08E;"><option> Delete</option></a>
                               <a href="edit-page-webshop.php" style="color:#DAC08E;"> <option> Edit</option></a>
                            </select>
                            </td> -->
                            <td> <a href="edit-page-webshop.php">Edit </a></td>
                        </tr>
                      <tr class="mt-3 mb-3" style="background: #3A3A3A;">
                          <td><input type="checkbox" name="" style="border: 1px solid #fff;background:transparent;"></td>
                          <td>About Us</td>
                          <td>Enable</td>
                          <td>3/08/2020</td>
                          <td>31/08/2020</td>
                         <!--  <td>
                            <select class="form-control" style="width:100px;height:30px">
                              <option value="" disabled selected> Action </option>
                               <a href="pages.php" style="color:#DAC08E;"><option> Delete</option></a>
                               <a href="edit-page-about.php" style="color:#DAC08E;"> <option> Edit</option></a>
                            </select>
                            </td> -->
                            <td> <a href="edit-page-about.php">Edit </a></td>
                        </tr>
                      <tr class="mt-3 mb-3" style="background: #3A3A3A;">
                          <td><input type="checkbox" name="" style="border: 1px solid #fff;background:transparent;"></td>
                          <td>Contact</td>
                          <td>Enable</td>
                          <td>3/08/2020</td>
                          <td>31/08/2020</td>
                          <!-- <td>
                            <select class="form-control" style="width:100px;height:30px">
                              <option value="" disabled selected> Action </option>
                               <a href="pages.php" style="color:#DAC08E;"><option> Delete</option></a>
                               <a href="edit-page-contact.php" style="color:#DAC08E;"> <option> Edit</option></a>
                            </select>
                            </td> -->
                            <td> <a href="edit-page-contact.php">Edit </a></td>
                        </tr>
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
