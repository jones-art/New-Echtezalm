<?php include 'header.php'; ?>

<?php
include '../includes/connection.php';
	
	use PHPMailer\PHPMailer\PHPMailer;

	require_once "PHPMailer/PHPMailer.php";
	require_once "PHPMailer/SMTP.php";
	require_once "PHPMailer/Exception.php";

function getProduct(){
	include '../includes/connection.php';
	$output = '';
	$sel = $connect2db->prepare("SELECT * FROM product WHERE status = ?");
		$sel->execute([1]);
		if ($sel->rowcount()<1) {?>
			<option selected="" disabled="">No Available Product</option>
		<?php }else{
			while ($row = $sel->fetch()) {
			 $output .='<option value="'. $row->id .'" data-amt="'.$row->price.'">  '.$row->prd_name.' </option>';
			
			}
		}
		return $output;
}
?>
<?php
	if (isset($_POST['request'])) {
		$items = $_POST['item-name'];
		$qty = $_POST['qty'];
		$total = $_POST['total'];

		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$desc = trim($_POST['desc']);
		$date = date('d-M-Y H:i:s');
		$status = 0;

		$quote_id = rand(00000,99999);
		$created = $_SESSION['id'];

		function getProducts(){
			include '../includes/connection.php';
			$items = $_POST['item-name'];
			$qty = $_POST['qty'];
			$total = $_POST['total'];

			$output='';
			foreach ($items as $i => $item) {
				$getprdName = $connect2db->prepare('SELECT prd_name FROM product WHERE id = ?');
				$getprdName->execute([$item]);
				$prdname = $getprdName->fetch();
				$itemName = $prdname->prd_name;
				$output .= '<tr><td>'.$itemName.'('.$qty[$i].')<br>€ '.$total[$i].'</td></tr>';
			}
			return $output;
		}

		$pdfDoc = '<div style="background:#3A3A3A;color:#fff;padding:13px;"><div><img src="images/logo-white.png"></div>';

$pdfDoc .='<h4 style="padding-top:24px;font-style: normal;font-weight: 500;font-size: 22px;line-height: 33px;">Hello '.$name.'</h4>';

$pdfDoc .= '<p style="padding-top:24px;font-style:normal;font-weight:300;font-size:22px;line-height:15px;"> 
			'.$desc.'
		</p>';

$pdfDoc .='<h4 style="padding-top:24px;font-style:normal;font-weight:500;font-size:22px;line-height:33px;">Your Order #'.$quote_id.' <span>('.$date.')</span></h4>';



$pdfDoc.='<table class="table table-striped" >
	<tr><th><center>Item Ordered</center></th></tr>
	<tbody style="background:#3A3A3A;">
		'. getProducts().'
	</tbody>
</table>
	</div>	
    ';

		$createQuote = $connect2db->prepare("INSERT INTO quote (name,email,description,order_id,date,status, createdby, payment_status)VALUES (?,?,?,?,?,?,?,?)");
		if ($createQuote->execute([$name,$email,$desc,$quote_id,$date,$status,$created,$status])) {
			$idquoute = $connect2db->lastInsertId();
			foreach ($items as $i => $item) {

				$quoteItems = $connect2db->prepare("INSERT INTO quote_items (product_id, user_id, total_amount, quantity, order_id)VALUES (?,?,?,?,?)");
				$quoteItems->execute([$item,$idquoute,$total[$i],$qty[$i],$quote_id]);
			}

			if ($quoteItems) {
				include('pdf.php');
				$file_name = md5(rand()) . '.pdf';

				$html_code = '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
				$html_code .= '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
				$html_code .= $pdfDoc;
				$pdf = new Pdf();
				$pdf->setPaper('letter');
				$pdf->load_html($html_code);
				$pdf->render();
				$file = $pdf->output();
				$file_location = $_SERVER['DOCUMENT_ROOT']."/finalProject/echtezalm/admin/invoice/".$file_name;
				file_put_contents($file_location, $file);

				$mail = new PHPMailer();

					$mail->isSMTP();
					$mail->Host = "smtp.gmail.com";
					$mail->SMTPAuth = true;
					$mail->Username = 'younghallajinoni@gmail.com';				//Sets SMTP username
					$mail->Password = 'Muthorlib123';
					$mail->Port = 465;
					$mail->SMTPSecure = 'ssl';

					$mail->isHTML(true);
					$mail->setFrom('sodiq.mutolib@hybridsoft.com.ng');
					$mail->addAddress($email);
					$mail->AddAttachment("invoice/".$file_name); 
					$mail->Subject = ("Invoice for Order ID:".$quote_id);
					$mail->Body = "Download Invoice Attachment";

					if ($mail->send()) {
						$update = $connect2db->prepare("UPDATE quote SET file = ? WHERE id = ? AND order_id = ? ");
						$update->execute([$file_name, $idquoute, $quote_id]);

						$insertInvoice = $connect2db->prepare("INSERT INTO invoice (user_id, order_id, invoice, created) VALUES (?,?,?,?)");
						if ($insertInvoice->execute([$name, $quote_id, $file_name, $date])) {
							echo("<script>alert('Invoice Successfully Created');</script>");
						}else{
							echo("<script>alert('Error Creating Invoice');</script>");
						}
					}




				// echo "<script> alert('Quote Successfully created');</script>";
			}else{
				echo "<script> alert('Error on second query');</script>";
			}
		}else{
				echo "<script> alert('Error on First query');</script>";
			}


	}
 ?>

<div class="clearfix"></div>
  
  <div class="content-wrapper" style="background: #2B2B2B;">
    <div class="container-fluid">
    	<br><br><br>
    	<div class="row">
    		<form class="container" method="POST" action="">
    		<div class="col-sm-12 text-right">
    			<input class="btn btn-primary" name="request" value="Request" type="submit"><br><br>
    		</div>
    		
    			  <div class="col-sm-12 col-lg-9">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header invoice-card text-white" style="background:#3A3A3A;">
				            	Bill To
				            </div>

				            <div class="card-body card-bodys">
				              <div class="form-group row">
								  <label for="name" class="col-sm-3 col-form-label">Name</label>
								  <div class="col-sm-8">
									<input type="text" name="name" class="form-control custom-input" id="name" >
								  </div>
								</div>

								 <div class="form-group row">
								  <label for="email" class="col-sm-3 col-form-label">E-mail</label>
								  <div class="col-sm-8">
									<input type="email" name="email" class="form-control custom-input" id="email" >
								  </div>
								</div>

								 <div class="form-group row">
								  <label for="pname" class="col-sm-3 col-form-label">Description</label>
								  <div class="col-sm-8">
									<textarea name="desc" class="custom-input" id="desc" cols="65" rows="5"></textarea>
								  </div>
								</div>

				            </div>
				          </div>
				        </div>


				          <div class="col-sm-12 col-lg-12">
				          <div class="card" style="border: 1px dashed rgba(255, 255, 255, 0.5)">
				            <div class="card-header invoice-card text-white row" style="background:#3A3A3A;">
				            	<div class="col-md-4">Item Ordered</div>
				            	<div class="col-md-6 text-right"><span id="add" style="cursor:pointer;">Add New Item</span></div>
				            </div>
				            <div class="card-bodys card-body items">
				              <div class="form-group row">
								  <label for="pname" class="col-sm-1 col-form-label">Item Name</label>
								  <div class="col-sm-3">
									
									<span>
										<select name="item-name[]" class="custom-input single-select" data-row-id="row_1" id="product_1" onchange="getProductData(1)">
											<option selected="" disabled="">Select Product</option>
											<?php 
												echo getProduct();
											?>
										</select>
									</span>
								  </div>

								  <label class="col-sm-1 col-form-label">Quantity</label>
								  <div class="col-sm-2">
									<input type="text" id="qty_1" name="qty[]" required="true" class="form-control custom-input" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" onkeyup="getTotal(1)" >
								  </div>

								  <label  class="col-sm-1 col-form-label">Total</label>
								  <div class="col-sm-2">
									<input type="text" readonly="true" name="total[]" id="total_1" class="form-control custom-input" style="color:#fff;background-color:transparent;"  >
								  </div>
								</div>
							</div>
				          </div>
				        </div>
    		</form>	
    	</div>
    </div>
  </div>


<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {

	let count = "";
	let row_id = "";


	$('#add').click(function(){

		let count = $('select').length;
	let row_id = count+1;


		let html = "<span>";

		html += ' <div class="form-group row"><label for="pname" class="col-sm-1 col-form-label">Item Name</label> <div class="col-sm-3"><select name="item-name[]" onchange="getProductData('+row_id+')" class="custom-input  single-select" data-row-id=row_'+row_id+' id=product_'+row_id+' ><option selected="" disabled="">Select Product</option><?php echo getProduct(); ?></select></div>';

		html += "<label for='qty' class='col-sm-1 col-form-label'>Quantity</label> <div class='col-sm-2'><input type='text' id=qty_"+row_id+" name='qty[]' required='true' class=form-control custom-input onkeyup='getTotal("+row_id+")' > </div>";

		html +="<label for='total' class='col-sm-1 col-form-label'>Total</label><div class='col-sm-2'><input type='text'id=total_"+row_id+" required='true' name='total[]' class='form-control custom-input'  readonly='readonly' style='color:#fff;background-color:transparent;'>	</div>";

		html += '<div class="col-sm-12 col-lg-1"><button class="btn btn-danger" id="remove">-</button></div></div></span>';

		$('.items').append(html);

		$('.single-select').select2();

		
	});
	 

// Remove Select Btn
 $(document).on('click', '#remove', function(){
  $(this).closest('span').remove();
 });



 $('.single-select').select2();

     // $('.span').each(function(amt){
     // 	let price = ''
     // 	$(this).change('.single-select',function(){
     // 		price = $(this).find(':selected').data('amt');
     // 		alert(price);
     // 	});

     // 	let qty = $('#qty').val()
     // })




	});
function getProductData (row_id)
  {
  	let price = $('#product_'+row_id).find(':selected').attr('data-amt');
    let product_id = $('#product_'+row_id).val();    
    let qty = $("#qty_"+row_id);
    let total = $("#total_"+row_id);
    if (product_id == "") {
    	qty.val() = "";
    	total.val() = ""
    }

    else{

    	qty.val(1);
    	let amount = Number(price);
    	total.val(amount.toFixed(2));
    }

}

function getTotal(row_id){
	let price = Number($('#product_'+row_id).find(':selected').attr('data-amt'));
	let qty = Number($("#qty_"+row_id).val());
    let total = $("#total_"+row_id);

    totalAmount = (price*qty)
	total.val(totalAmount.toFixed(2))
}
</script>

