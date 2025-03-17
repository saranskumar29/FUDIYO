<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['orgname'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Donor Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/donor_db.css">
</head>
<body>
  <div class="header">
    <h1>Donor Dashboard</h1>    
    <div class="user-info">
      <span>Welcome,<?=$_SESSION['orgname']?></span>
      
      <a href="logout.php">Logout</a>
    </div>
  </div>
  <?php if(isset($_GET['success'])){ ?>
    		<div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
			</div>
		    <?php } ?>

  <div class="container">
    <h2>Add Food Details</h2>
    <form action="include/add_food.php" method="POST">
      <label for="food_name">Food Name:</label>
      <input type="text" id="food_name" name="food_name" value="<?php echo (isset($_GET['food_name']))?$_GET['food_name']:"" ?>" required>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" value="<?php echo (isset($_GET['quantity']))?$_GET['quantity']:"" ?>" required>

      <label for="description">Details:</label>
      <textarea id="description" name="description" value="<?php echo (isset($_GET['description']))?$_GET['description']:"" ?>" required></textarea>

      <input type="submit" value="Submit">
    </form>

    <h2>Added Food Details</h2>
    <?php include 'include/added_food.php'; ?>


  </br><h2>View Requests</h2>
  <?php include 'include/view_req.php'; ?>
  </div>

</body>

</html>

<?php }else {
	header("Location: dlogin.php");
	exit;
} ?>