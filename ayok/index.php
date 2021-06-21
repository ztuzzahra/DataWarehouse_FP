<?php
session_start();
if (empty($_SESSION["username"]))
{
    echo "<script> alert('Silahkan Log In terlebih dahulu')</script>";
    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
    exit;
}

$conn = mysqli_connect("localhost", "root","","whsakila2021");
$username=$_SESSION["username"];
?>


<!-- Index Start -->
<?php
    if(empty($_GET['page']) OR $_GET['page']==NULL){
        include('sakila.php');
    }
    elseif(!empty($_GET['page']) && $_GET['page'] == 'login') {
            include('login.php');
    }
    elseif(!empty($_GET['page']) && $_GET['page'] == 'aksilogin') {
            include('ceklogin.php');
    }
    elseif(!empty($_GET['page']) && $_GET['page'] == 'logout') {
            include('logout.php');
    }
    elseif(!empty($_GET['page']) && $_GET['page'] == 'tables') {
            include('tables.php');
    }
    elseif(!empty($_GET['page']) && $_GET['page'] == 'profile') {
            include('profile.php');
    }


?>