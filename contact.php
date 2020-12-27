<?php $page = 'contact'; include 'head.php' ?>
<?php
  if (isset($_POST['feedbackBtn'])) {
    include 'includes/connection.php';
    $sender = $_POST['sender'];
    $pnum = $_POST['pnum'];
    $message = $_POST['message'];
    $email = $_POST['email'];

    if (empty($sender)||empty($pnum)||empty($message)||empty($email)) {
      echo "<script>alert('All Fields Are Required');</script>";
    } else{

      $addProduct = $connect2db->prepare("INSERT INTO feedback (name,email,pnum,message) VALUES (?,?,?,?)");
          $query = $addProduct->execute([$sender,$email,$pnum,$message]);
          $query ?
          print "<script>alert('feedback Successfully Sent');</script>":
          print "<script>alert('Error Sending Feedback, Please Try Again');</script>";

      // if (empty($_FILES['upload'])) {
      //   $imageName = "null.jpg";
      // }else{
      //   $imageName = $_FILES['upload']['name'];
      //   $imageSize = $_FILES['upload']['size'];
      //   $imageType = $_FILES['upload']['type'];
      //   $imageTemp = $_FILES['upload']['tmp_name'];
      // }

      // $type = explode('.', $imageName);
      //   $type = strtolower(end($type));
      //   $allow = ['jpg', 'png', 'jpeg'];
      //   $uniq = uniqid();
      //   $imageName = $uniq.".".$type;
      //   if (in_array($type, $allow)) {
      //     if (!is_dir('feedback')) {
      //       mkdir('feedback');
      //     }

      //     if (move_uploaded_file($imageTemp, 'feedback/'.$imageName)) {
      //       $addProduct = $connect2db->prepare("INSERT INTO feedback (name,email,pnum,message,image) VALUES (?,?,?,?)");
      //     $query = $addProduct->execute([$sender,$email,$pnum,$message,$imageName]);
      //     $query ?
      //     print "<script>alert('feedback Successfully Sent');</script>":
      //     print "<script>alert('Error Sending Feedback, Please Try Again');</script>";
      //     } else{
      //     echo "<script>alert('Feedback Folder Missing');</script>";
      //   }

      //   } else{
      //     echo "<script>alert('File type not Acceptable".$type."');</script>";
      //   }


    }
  }
?>

<?php
  include 'includes/connection.php';
  $getDetails = $connect2db->prepare("SELECT * FROM pages WHERE page_name = ? AND status = ?");
  $getDetails->execute([$page, 1]);
  if ($getDetails->rowcount()>0) {
    $data = $getDetails->fetch();

    $title = $data->page_title;
    $address = $data->file1;
    $pnum = $data->file2;
    $email = $data->file3;
  } else{

    $title = 'A Special Experience Of Taste And Tradition';
    $address = '359  Frankenroda Rd, Mihla, Deutche.';
    $pnum = '+32 011 240 193';
    $email='Johndoe@nomail.com';
  }
?>



<!-- Google Map -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKXKdHQdtqgPVl2HI2RnUa_1bjCxRCQo4&amp;callback=initMap"
    async defer></script>
<section>
	<div class="container">
		<h5 class="center" style="padding-bottom: 108px;"><?php echo $title?></h5>
    <form id="feedbackFrm" method="POST" enctype="multipart/form-data" action="">
		<div class="row">
			<div class="col m5 s12 card black" >
				<h5>Keep in touch</h5>
				<p style="margin-bottom: 58px; color: white;">Reach out to us for any enquiry</p>
				<div class="row">
					<div class="col s12 input-field">
						<label for="name" style="padding-left: 20px;">Name <span class="red-text">*</span> </label>
						<input type="text" id="name" class="browser-default input" name="sender">
					</div>

					<div class="col s12 input-field">
						<label for="email" style="padding-left: 20px;">E-mail <span class="red-text">*</span> </label>
						<input type="email" id="email" class="browser-default input" name="email">
					</div>

					<div class="col s12 input-field">
						<label for="phone" style="padding-left: 20px;">Phone <span class="red-text">*</span> </label>
						<input type="text" id="phone" class="browser-default input" name="pnum">
					</div>

					<div class="col s12 input-field">
						<label for="phone" style="padding-left: 20px;">Message <span class="red-text">*</span> </label>
						<textarea class="browser-default input" style="height: 111px;" name="message"></textarea>
					</div>

					<div class="row">
						<div class="col s5 left input-field upload">
						<label for="uploadImg"> <i class="fas fa-cloud-upload-alt"></i>Upload file</label>
		  					<input type="file" id="uploadImg" name="upload">
						</div>

						<div class="col s6 input-field">
							<!-- <input type="submit" class="btn planbtn" name=""> -->
							<button class="btn planbtn" id="feedbackBtn" type="submit" name="feedbackBtn">Send Message</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Map Div Start From Here -->
			<div class="col s12 m7 right card black" id="style-map" style="height: 552px; width: 563px; margin-top: 55px;"></div>

		</div>
	</div>
  </form>
</section>

<hr style="width:100%; ">

<section>
	<div class="container">
		<div class="row">
			<div class="col m6 s12 card black white-text">
				<div class="row">
					<div class="col s1 black" style="padding-top: 24px;">
            <img src="images/icon/location.png">      
          </div>
          
          <div class="col s11" style="padding-top: 56px;">
            <p style="color: #DAC08E;">Location</p>
            <p style="margin-top: 10px;"><?php echo $address; ?></p>
          </div>
				</div>
			</div>

      <div class="col s12 m3 card black white-text">
        <div class="row">
          <div class="col s2 black" style="padding-top: 24px;">
            <img src="images/icon/phone.png">      
          </div>
          
          <div class="col s10" style="padding-top: 56px;">
            <p style="color: #DAC08E;">Phone</p>
            <p><?php echo $pnum; ?></p>
          </div>
        </div>
      </div>

      <div class="col s12 m3 card black white-text">
        <div class="row">
          <div class="col s2 black" style="padding-top: 24px;">
            <img src="images/icon/mail.png">      
          </div>
          
          <div class="col s10" style="padding-top: 56px;">
            <p style="color: #DAC08E;">E-mail</p>
            <p><?php echo $email; ?></p>
          </div>
        </div>
      </div>

		</div>
	</div>
</section>


<?php include 'footer.php' ?>
<script type="text/javascript">
	var map;
      function initMap() {
        let myLatLng = {lat: 52.1326, lng: 5.2913}
var map = new google.maps.Map(document.getElementById('style-map'), {
          center: myLatLng,
          zoom: 4,
          styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
        });

  var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          // icon: 'images/cart.png'
        });
		
		
      }


      $(document).ready(function(){
        $('#feedbackBtn').click(function(){

        })
      })
   </script>

