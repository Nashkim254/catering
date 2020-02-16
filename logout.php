<?php 
session_start();
include_once './includes/header.inc';
if (isset($_SESSION['id'])) {
	session_destroy();
}
header("Location: index.php");
exit();
 ?>