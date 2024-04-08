
<!DOCTYPE html>
<html lang="en">
    <style>
  .sidebar-nav .nav-link.collapsed i {
    font-size: 14px !important;
}
</style>
<body>
    
<?php include "sidebar.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
     
    </div>
  </main>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script>
  function confirmSignOut() {
    if (confirm("Are you sure you want to sign out?")) {
      window.location.href = "signout.php";
    }
  }
</script>
<?php include "../footer.php"; ?>
