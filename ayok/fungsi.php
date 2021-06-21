<?php
function ceklogin($username,$password){
	global $conn;

	$sql="SELECT * FROM akun WHERE username='$username' AND password='$password'";
	$query=mysqli_query($conn,$sql);

	$cek=mysqli_fetch_array($query);
	$_SESSION['password']=$cek['password'];
	$_SESSION['username']=$cek['username'];
	

	if(mysqli_num_rows($query)>0){
		return true;
	}else{
		return false;
	}
}
function daftarakun($username,$password){
	global $conn;

	$sql="INSERT INTO `akun`(`username`, `password`) VALUES ('$username','$password')";
	
		if (mysqli_query($conn, $sql)) {
		    return true;
		} else {
		    return false;
		}
}
?>