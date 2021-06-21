
<?php 
$conn=mysqli_connect("localhost","root","","whsakila2021");

$sql ="SELECT s.nama_kota, SUM(f.amount) total
FROM store s, fakta_pendapatan f
WHERE s.store_id = f.store_id
GROUP BY s.nama_kota";
$result = mysqli_query($conn, $sql);

$sql1 = "SELECT COUNT(customer_id) cus from fakta_pendapatan";
$totcus = mysqli_query($conn, $sql1);

$sql2 = "SELECT sum(amount) tot FROM fakta_pendapatan";
$totpes = mysqli_query($conn, $sql2);

$sql3 = "SELECT COUNT(DISTINCT customer_id) unikcust FROM fakta_pendapatan";
$unicus = mysqli_query($conn, $sql3);

$sql4 = "SELECT round(AVG(lamapinjam)) rata FROM fakta_pendapatan";
$ratalapin = mysqli_query($conn, $sql4);

$sql5 = "SELECT  c.nama, SUM(f.amount) total FROM fakta_pendapatan f JOIN customer c ON (f.customer_id=c.customer_id) GROUP BY f.customer_id ORDER by total DESC LIMIT 5";
$res = mysqli_query($conn, $sql5);

$sqlku = "SELECT  c.nama nama , COUNT(f.customer_id) total_beli FROM fakta_pendapatan f JOIN customer c ON ( f.customer_id=c.customer_id) GROUP by f.customer_id ORDER by total_beli DESC LIMIT 5";
$resu = mysqli_query($conn, $sqlku);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin - DWO</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.php">
       <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Dashtreme WH Sakila</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="sakila.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a href="index.php?page=tables">
          <i class="zmdi zmdi-grid"></i> <span>Mondrian OLAP</span>
        </a>
      </li>

      <li>
        <a href="index.php?page=profile">
          <i class="zmdi zmdi-face"></i> <span>Profile</span>
        </a>
      </li>

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-envelope-open-o"></i></a>
    </li>
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i></a>
    </li>
    <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="index.php?page=profile">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php
                        echo $username;
                        ?></h6>
            <p class="user-subtitle"><?php
                        echo $username;
                        ?>@example.com</p>
            </div>
           </div>
          </a>
        </li>
        
        <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="logout.php">Log Out</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">

  <!--Start Dashboard Content-->

  <div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"> 
                    <?php
                    while ($oi= mysqli_fetch_array($totcus)) {
                     
                      echo $oi['cus'];
                      
                     } 
                    ?>
                    <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                    <div class="progress my-3" style="height:10px;">
                       <div class="progress-bar" style="width:20%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Pesanan </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">
                     <?php
                       while ($pes= mysqli_fetch_array($totpes)) {
                        echo $pes['tot'];  
                     } 
                    ?>

                   <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                    <div class="progress my-3" style="height:10px;">
                       <div class="progress-bar" style="width:80%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Pendapatan</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">
                    <?php
                       while ($cusunik= mysqli_fetch_array($unicus)) {
                        echo $cusunik['unikcust'];  
                     } 
                    ?>


                    <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                    <div class="progress my-3" style="height:10px;">
                       <div class="progress-bar" style="width:8%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Pelanggan</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">
                    <?php
                    while ($lapin= mysqli_fetch_array($ratalapin)) {
                     
                      echo $lapin['rata'];
                      
                     } 
                    ?>

                   <span class="float-right"><i class="fa fa-envira"></i></span></h5>
                    <div class="progress my-3" style="height:10px;">
                       <div class="progress-bar" style="width:5%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Rata-Rata Lama Peminjaman</p>
                </div>
            </div>
        </div>
    </div>
 </div>  
    
  <div class="row">
     <div class="col-12 col-lg-8 col-xl-8">
      <div class="card" style="height: 85%;">
     <div class="card-header">Traffic Penjualan
       <div class="card-action">
       <div class="dropdown">
       <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
        <i class="icon-options"></i>
       </a>
        <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="javascript:void();">Action</a>
        <a class="dropdown-item" href="javascript:void();">Another action</a>
        <a class="dropdown-item" href="javascript:void();">Something else here</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="javascript:void();">Separated link</a>
         </div>
        </div>
       </div>
     </div>
     
        
        <div class="card-body">
         <iframe src="http://localhost/DWO-UAS-GRAFIK/TAHUN-NAMA%20HARI/tahun-kategori.php" style="height: 100%; width: 100%; border: none; align-content: center; "></iframe>
        </div>
    
     
     
    </div>
   </div>


    <div class="col-12 col-lg-4 col-xl-4">
     <div class="card">
       <div class="card-header">Total Pendapatan Berdasarkan Kota
      <div class="card-action">
             <div class="dropdown">
             <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
              <i class="icon-options"></i>
             </a>
              <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="javascript:void();">Action</a>
              <a class="dropdown-item" href="javascript:void();">Another action</a>
              <a class="dropdown-item" href="javascript:void();">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="javascript:void();">Separated link</a>
               </div>
              </div>
             </div>
     </div>
         <div class="table-responsive">
                 <table class="table align-items-center table-flush table-borderless">
                  
                   
                     <th>Nama Kota</th>
                     <th>Total Pendapatan</th>
                     
                   <?php
                    while ($hadir= mysqli_fetch_array($result)) {
                      echo "<tr>";
                      echo "<td>".$hadir['nama_kota']."</td>";
                      echo "<td>$ ".$hadir['total']."</td>";
                      echo "</tr>";
                     } 
                    ?>
                  </table>
          </div>
     </div>

     <div class="card">
      <div class="card-body" >
       <h6 class="card-title"> TOP 5 Customers</h6>
          <div class="table-responsive">
                 <table class="table align-items-center  table table-striped">
                  
                   
                     <th>Nama Customer</th>
                     <th>Total Transaksi</th>
                     
                   <?php
                    while ($top= mysqli_fetch_array($res)) {
                      echo "<tr>";
                      echo "<td>".$top['nama']."</td>";
                      echo "<td>$ ".$top['total']."</td>";
                      echo "</tr>";
                     } 
                    ?>
                  </table>
          </div>
      </div>
      </div>
   </div>
   
     
  </div><!--End Row-->

    <div class="row">
   <div class="col-12 col-lg-12">
     <div class="card">
       <div class="card-header">
        <h5>TOP 5 Customers</h5>
      
     </div>
         <div class="table-responsive">
                 <table class="table align-items-center table-flush table-hover">
                <thead style="text-align: center;">
                  <tr>
                    <th scope="col" style="font-size: 14px;">Nama</th>
                    <th scope="col" style="font-size: 14px;">Total Pembelian</th>
                    
                  </tr>
                </thead>
                   
                   <tbody style="text-align: center;">
                     
                   <?php
                    while ($tcust= mysqli_fetch_array($resu)) {
                      echo "<tr>";
                      echo "<td>".$tcust['nama']."</td>";
                      echo "<td> ".$tcust['total_beli']." kali</td>";
                      echo "</tr>";
                     } 
                    ?>
                    </tbody>
                  </table>
               </div>
     </div>
   </div>
  </div><!--End Row-->

      <!--End Dashboard Content-->
    
  <!--start overlay-->
      <div class="overlay toggle-menu"></div>
    <!--end overlay-->
    
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  
  <!--Start footer-->
  
  <footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2021 Dashtreme Admin Sakila
        </div>
      </div>
    </footer>
  <!--End footer-->
  
  <!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
    <li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  
 <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- loader scripts -->
  <script src="assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
 
  <!-- Index js -->
  <script src="assets/js/index.js"></script>

  
</body>
</html> 
