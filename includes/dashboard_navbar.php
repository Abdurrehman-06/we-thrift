<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Vendor CSS Files -->
  <link href="../dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../dashboard/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../dashboard/../dashboard/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../dashboard/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../dashboard/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../dashboard/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../dashboard/style2.css">

  <!-- Template Main CSS File -->
  <link href="../dashboard/assets/css/style.css" rel="stylesheet">


  <style>
  .sidebar-nav .nav-link.collapsed i {
    font-size: 14px !important;
}
.header .toggle-sidebar-btn {
    font-size: 32px;
    padding-left: 10px;
    cursor: pointer;
    color: #012970;
    padding-top: 12px;
}
</style>
</head>
<body>
    
        		<div id="preloader">
			<div id="container" class="container-preloader">
				<div class="animation-preloader">
					<div class="spinner"></div>
					<div class="txt-loading">
						<span preloader-text="W" class="characters">W</span>
						
						<span preloader-text="E" class="characters">E</span>
						
						<span preloader-text="T" class="characters">T</span>
						
						<span preloader-text="H" class="characters">H</span>
						
						<span preloader-text="R" class="characters">R</span>
						
						<span preloader-text="I" class="characters">I</span>
						
						<span preloader-text="F" class="characters">F</span>
						<span preloader-text="T" class="characters">T</span>
					</div>
				</div>	
				<div class="loader-section section-left"></div>
				<div class="loader-section section-right"></div>
			</div>
		</div>
      <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="col-12 d-flex  justify-content-between">
      <div class="col-md-4 d-flex justify-content-start">
        <a href="../../ecommerce/" class="logo d-flex align-items-center">
          <img src="../../assets/img/dashboard/logo.05b9ef59.svg" alt="">
        </a>
      </div>
      <div class="col-4 sellers-dash">
        <a href="#" class="logo sellers-logo d-flex text-dark align-items-center">
          <h4>Sellers Dashboard</h4>
        </a>
      </div>
      -<div class="col-4 d-flex justify-content-end pe-md-5 pe-3">
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
    </div>
  </header>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a href=""  onclick="confirmlogOut(event)" class="nav-link collapsed" >
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <span>Logout</span>
        </a>
      </li>
      <li class="nav-item" onclick="twon()">
        <a href="dashboard.php" class="nav-link collapsed" >
          <i class="fa-solid fa-user"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="nav-item" onclick="twon()">
        <a href="dashboard_with_stats.php" class="nav-link collapsed" >
          <i class="fa-solid fa-table-columns"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item" onclick="threen()">
        <a href="products.php" class="nav-link collapsed" >
          <i class="fa-solid fa-list-check"></i>
          <span>My Products</span>
        </a>
      </li>
      <li class="nav-item" onclick="fourn()">
        <a href="orders.php" class="nav-link collapsed" >
          <i class="fa-solid fa-check-to-slot"></i>
          <span>Orders</span>
        </a>
      </li>
      <li class="nav-item" onclick="fifthn()">
        <a href="../../ecommerce/live_chat.php" class="nav-link collapsed" >
          <i class="fa-solid fa-headset"></i>
          <span>Sellers Support</span>
        </a>
      </li>
    </ul>
  </aside>
  <main id="main" class="main">

    <div class="pagetitle">
     
    </div>
  </main>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>
    function confirmlogOut(event) {
      event.preventDefault(); // Prevents default action of the link
      if (confirm("Are you sure you want to log out?")) {
       window.location.href = "../user_dashboard/signout.php";
      }
    }
  </script>
  <?php include "../footer.php" ?>
