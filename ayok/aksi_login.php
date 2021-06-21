<?php
session_start();
 $conn=mysqli_connect("localhost","root","","whsakila2021");

$username         = $_POST['username'];
$password          = $_POST['password'];

$get = $conn->query("SELECT * FROM akun WHERE username='$username' AND password='$password'");
if (mysqli_num_rows($get)===1){
$row=mysqli_fetch_assoc($get);

if ($row['password']==$password){
  $_SESSION["username"]=$username;
  $_SESSION["login"]=true;
  header("location:index.php");
}
}
else{
  echo "<meta http-equiv='refresh' content='1;url=login.php'>";
  echo "<script> alert('Username / Password Salah')</script>";

}
session_end();
?>