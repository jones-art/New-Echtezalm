<?php
	if (isset($_POST['data'])) {

		include 'includes/connection.php';
		$items = json_decode($_POST['data']);
		$output = '';
		$subTotal = "";
		foreach ($items as $item) {
			$data = $item;
			$product = $data->id;
			$quantity = $data->qty;
			
			$getProduct = $connect2db->prepare("SELECT * FROM product WHERE id = ?");
			$getProduct->execute([$product]);
			$product = $getProduct->fetch();
			$output = '<div class="row white-text" style="height:129px;background-color:#3A3A3A;margin-bottom:0px">
              <div class="col m6 s12">
                <div class="row" style="margin-bottom:0px">
                  <div class="col s12 m3" style="padding: 12px;">
                    <img src="admin/product/'.$product->image.'" style="height:102px;width:102px" class="responsive-img">
                  </div>

                  <div class="col s12 m8" style="padding-top:10px;padding-bottom:57px;">'.$product->prd_name.'</div>
                  <div class="col s12 m8" id='.$product->id.' style="padding-bottom:7px" onclick=Delete(this);><span ><img src="images/icon/trash.png"></span> &nbsp; Delete</div>
                </div>
              </div>
               <div class="col m2 s12" style="padding-top:22px;">

                <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;" class="min" onclick="var result = document.getElementById(sst6'.$product->id.'_menu); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;">-</button>

                        <input type="text" name="quantity" readonly="true" class="white-text browser-default input" style="width:40px;height:40px;padding:5px;text-align:center;border-radius:5px" data-id="$product->id" value="'.$quantity.'" id="sst6'.$product->id.'_menu">

                        
                        <button style="color:#fff;font-weight:500;font-size:20px;margin:5px;background: none; border:none;cursor:pointer;" class="add" type="button" onclick="var result = document.getElementById(sst6'.$product->id.'_menu); var sst = result.value; if( !isNaN( sst )) result.value++;return false;">+</button>

              </div>
              
              <div class="col m2 s12 unit" style="padding-top: 22px;" >
                '.$product->price.'
              </div>
              <div class="col m2 s12 total" style="padding-top: 22px;" >'.$quantity*$product->price.'</div>
            </div><br style="margin-top: 0px;">';
            $subTotal = $subTotal + $product->price;
            $output .= '<p class="right p" > Sub Total &nbsp; &nbsp; &nbsp; <span class="span">€ '.$subTotal.'</span></p>';
            echo($output);
		}

		


	}
?>