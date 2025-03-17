<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['orgname'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Receiver Dashboard</title>
  <link rel="stylesheet" type="text/css" href="assets/css/receiver_db.css">
</head>
<body>
  <div class="header">
    <h1>Receiver Dashboard</h1>
    <div class="header-right">
      <span class="welcome-message">Welcome,<?=$_SESSION['orgname']?></span>
      <a href="logout.php" >Logout</a>
    </div>
  </div>

  <div class="container">
    <h2>Available Food List</h2>
    <?php include 'include/recv_food.php'; ?>
   

    
</br>
    <h2>Requested Food Status</h2>
    <?php include 'include/req_food_status.php'; ?>
   
  </div>


  

</body>
</html>

<?php }else {
	header("Location: rlogin.php");
	exit;
} ?>