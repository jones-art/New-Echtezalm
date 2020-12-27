<?php
session_start();
include 'includes/connection.php';
		$id = $_SESSION['id'];
		$date = date('Y-m-d');
			$getData = $connect2db->prepare("SELECT * FROM chat WHERE (sender = ? OR receiver = ?) AND m_date = ? AND status != 2 ORDER BY id DESC ");
			$getData->execute([$id, $id, $date]);
			while ($msg=$getData->fetch()) {
				$sender = $msg->sender;
				($sender == $id) ? $class = 'sender' : $class = 'admin';
						
				echo "<div class=$class> $msg->message </div><br>";
			
		}
?>