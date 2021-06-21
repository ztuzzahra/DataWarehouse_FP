<?php 
session_start();
$_SESSION["username"]='';
unset($_SESSION["username"]);
session_unset();
session_destroy();


echo "<meta http-equiv='refresh' content='1;url=index.php'>";
 echo "<script> alert('BERHASIL Log Out')</script>";

 ?>