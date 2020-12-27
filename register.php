<?php include 'includes/connection.php';


  if(isset($_POST['register'])){
	if (isset($_POST['fname'])) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$sex = $_POST['sex'];
		$country = 'Netherland';
		$state = $_POST['state'];
		$phone = $_POST['phone'];
		$address = trim($_POST['address']);
		$dob = $_POST['dob'];
		$email = $_POST['email'];
		$pass = md5($_POST['pass']);
		$date = date('Y-m-d');
		$role = 'user';
		$stmt = $connect2db->prepare("SELECT * FROM users WHERE email = ? ");
		$stmt->execute([$email]);
		if ($stmt->rowcount()>0) {
			echo "<script>alert('User already Available Please Use the Login');window.location='login';</script>";
		} else{
			$sql = "INSERT INTO users (fname, lname, email, password, address, state, phone, country, sex, dob, joined, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
			$ins = $connect2db->prepare($sql);
			$query = $ins->execute([$fname, $lname, $email, $pass, $address, $state, $phone, $country, $sex, $dob, $date, $role]);
			$query ?
			print "<script>alert('Registration Successful, You can now login');window.location='login';</script>":
			print "<script>alert('Error with Registration, Please Try Again');</script>";
		}
	}}

	if(isset($_GET['user_id']) AND isset($_GET['user_id']) !=''){
		$userID = $_GET['user_id'];
		// $userEmail = $_SESSION['email'];
		$u = $connect2db->prepare("SELECT * FROM users WHERE id=?");
		$u->execute([$userID]);
		$up = $u->fetch();
		$fname = $up->fname;
		$lname = $up->lname;
		$email = $up->email;
		$phone = $up->phone;
		$address = $up->address;
		$state = $up->state;
		$sex = $up->sex;
		$dob = $up->dob;
	}

	if(isset($_GET['user_id'])){
		if(isset($_POST['update'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$sex = $_POST['sex'];
		$state = $_POST	['state'];
		$phone = $_POST['phone'];
		$address = trim($_POST['address']);
		$dob = $_POST['dob'];
		$email = $_POST['email'];

			$upd = $connect2db->prepare("UPDATE users SET
				fname='$fname',
				lname='$lname',
				email='$email',
				phone='$phone',
				address='$address',
				state='$state',
				sex='$sex',
				dob='$dob'
				WHERE id=?
				");
			$upd->execute([$userID]);
			if($upd){
			echo "<script> alert('Updated Successfully');window.location='profile.php'; </script>";
			}
		}
	}
?>
<?php include 'head.php';  ?>

<section>
	<div class="form-back" data-aos="flip-down" data-aos-duration='2000'>
		<div class="white-text container">
			<h4> Welkom bij Fresh Smoked Salmon </h4>
			<p class="center">Al aangemeld? Hier inloggen </p>
			
			<div class="container">
				<!--  -->
			<form class="container" id="registration" method="POST">
				<div class="row container">
					<div class="col m6 s12 input-field">
						<input type="text" name="fname" class="white-text  browser-default input" placeholder="Voornaam" value="<?php if(isset($_GET['user_id'])){echo $fname;} ?>">
					</div>

					<div class="col m6 s12 input-field">
						<input type="text" name="lname"  class="white-text browser-default input" placeholder="Achternaam" value="<?php if(isset($_GET['user_id'])){echo $lname;} ?>">
					</div>

					<div class="col m6 s12 input-field">
						<select style="border: 1px solid #fff; padding-left: 20px; background: transparent;color: white; width: 100%;" class="browser-default" name="sex">
							<option selected="" disabled="">Geslacht</option>
							<option style="color: black;" <?php if(isset($_GET['user_id'])){if($sex=='Male'){echo 'selected';}} ?>>Male</option>
							<option style="color: black;" <?php if(isset($_GET['user_id'])){if($sex=='Female'){echo 'selected';}} ?>>Female</option>
						</select>
					</div>

					<div class="col m6 s12 input-field">
						<input type="<?php if(isset($_GET['user_id'])){echo 'text';}else{echo 'date';}?>" name="dob" class="browser-default white-text input" placeholder="Geboortedatum" value="<?php if(isset($_GET['user_id'])){echo $dob;} ?>">
					</div>

					<div class="col m12 s12 input-field">
						<input type="text" name="phone"  class="white-text browser-default input" placeholder="Mobile Number" value="<?php if(isset($_GET['user_id'])){echo $phone;} ?>" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
					</div>

					<div class="col m12 s12 input-field">
						<textarea name="address"  class="white-text browser-default input" placeholder="Address"><?php if(isset($_GET['user_id'])){echo $address;} ?></textarea>
					</div>

					<div class="col s12 input-field">
						<select  class="browser-default input" name="state">
							<option selected="" disabled="">state van verblijf</option>
							<?php 
							$st = $connect2db->query("SELECT * FROM state ORDER BY id ASC");
							while($sta = $st->fetch()){
							?>
							<option style="color: black;" <?php if(isset($_GET['user_id'])){if($state==$sta->stateName){echo 'selected';}} ?>><?php echo $sta->stateName; ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="col s12 input-field">
						<input type="email" name="email"  class="browser-default white-text input" placeholder="Jouw email" value="<?php if(isset($_GET['user_id'])){echo $email;} ?>">
					</div>

					<?php if(isset($_GET['user_id']) ==''){?>
					<div class="col s12 input-field">
						<input type="password" name="pass"  class="browser-default white-text input" placeholder="Je wachtwoord">
					</div>
					
					<div class="col s12 input-field">
						<p>
							<label>
								<input type="checkbox" name="" style="color: white;"><span>Ik ontvang graag het laatste Freshly Fish nieuws en weet wanneer de volgende visdoos verschijnt!</span>
							</label>
						</p>
					</div>

					<div class="col s12 input-field">
						<input type="submit" class="btn formbtn" name="register" value="Register">
					</div>
				<?php } ?>
				<p class="white-text"> <?php if(isset($_GET['user_id']) ==''){echo "<a href='profile.php' class='white-text'> <<back </a>";}?></p>
					<div class="col s12 input-field">
						<input type="submit" class="btn formbtn" name="update" value="Update">
					</div>
					

					<div>
						
					</div>
				</div>			
			</form>

			</div>
		</div>
	</div>
	
</section>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Animation on Scroll -->
<script type="text/javascript" src="js/aos.min.js"></script>
<!-- Flip Card -->
<script type="text/javascript" src="js/flip.min.js"></script>

<script type="text/javascript">
	AOS.init();
	$('.carousel').carousel({
    fullWidth: true,
    indicators: true
});

var autoplay = true;

setInterval(function() { 
    if(autoplay) $('.carousel.carousel-slider').carousel('next');
}, 4500);


</script>

<?php include 'script.php' ?>
<!-- <input type="button" name="" class="btn planbtn" style="width: 100% " placeholder="Username" value="login"> -->
<!-- width: 492px; height: 50px; padding-left:20px; padding-top: 14px; padding-bottom: 14px; 
	<input type="text" name="" style="border:2px solid white; margin-top: 30px; " placeholder="Username">

				<input type="submit" class="btn planbtn" style="width: 100%; height: 50px;" value="login" name="">
-->