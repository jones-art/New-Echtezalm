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
          <div class="card" style="background:#3A3A3A;">
            <div class="card-body">
              <div class="table-responsive">
              	<table id="default-datatable" class="table">
                <thead style="background: #3A3A3A;color:#fff">
                    <tr>
                    	<th></th>
                    	<th>ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>E-mail</th>
                        <th>State</th>
                        <th>Member Since</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                		include '../includes/connection.php';
                		$getUser = $connect2db->prepare("SELECT * FROM users WHERE role=? ");
                		$getUser->execute(['user']);
                		$i = 1;
                		while ($row = $getUser->fetch()) {
                			?>
                			<tr>
		                    	<td><input type="checkbox" name="" style="border: 1px solid #fff;color:#000;"></td>
		                    	<td><?php echo $i; ?></td>
		                    	<td><?php echo $row->fname." ".$row->lname; ?></td>
		                    	<td><?php echo $row->dob; ?></td>
		                    	<td><?php echo $row->email; ?></td>
		                    	<td><?php echo $row->country; ?></td>
		                    	<td><?php echo ($row->dob); ?></td>
		                    	<td>Subscribe</td>
		                    	<td><a href="profile.php?id=<?php echo($row->id);?>" style="color:#DAC08E;">View</a></td>
		                    </tr>
                		<?php
                		$i=$i+1;
                		}
                	?>
                   
                  </tbody>
                  <tfoot>
                    <tr>
                    	<th></th>
                    	<th>ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>E-mail</th>
                        <th>State</th>
                        <th>Member Since</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
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
