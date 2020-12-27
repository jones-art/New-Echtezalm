<?php

$host = 'localhost';
$dbname = 'echtezalm';
$user = 'root';
$pass = '';

$dns = 'mysql: host='. $host.';dbname='.$dbname;

$connect2db = new PDO ($dns, $user, $pass);
$connect2db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

if (!$connect2db) {
	echo "error";
} 

?>