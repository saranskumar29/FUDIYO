<?php 
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['email'])) {
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" type="text/css" href="assets/css/admin_db.css">
</head>
<body>
  <div class="header">
    <h1>Admin Dashboard</h1>
    <!-- WELCOME -->
    <a href="logout.php">Logout</a>
  </div>

  <div class="container">
    <h2>Receiver Verification</h2>
    <?php include 'include/recv_verify.php'; ?> 
    <?php include "include/verified_receiver.php";?>

</br><h2>Donor Verification</h2>
    <?php include "include/donor_verify.php";?>
    <?php include "include/verified_donor.php";?>
  </div>

</body>
</html>

<?php } else {
	header("Location: alogin.php");
	exit;
} ?>