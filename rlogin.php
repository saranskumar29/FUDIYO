<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body><header>
    <div class="container">
        <div class="row">
            
            <div class="col-lg-10">
			<style>
    .col-lg-10 {
        text-align: right;
        margin-right: 30px;
    }

    .col-lg-10 a {
        display: inline-block;
        padding: 1px 1px;
        background-color: #0d6efd; 
        color: #fff;
        text-decoration: none;
        border: 1px solid #4CAF50; 
        border-radius: 1px;
        transition: background-color 0.3s, color 0.3s;
        margin-right: 10px; 
    }

    .col-lg-10 a .home-icon {
        margin-right: 5px;
    }

    .col-lg-10 a:hover {
        background-color: #45a049; 
        border-color: #45a049; 
    }
</style>




    <a href="index.php">Home</a>
</div>
        </div>
    </div>
</header>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<form class="shadow w-450 p-3" 
    	      action="include/rlogin.php" 
    	      method="post">

    		<h4 class="display-4  fs-1">LOGIN</h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		  <div class="mb-3">
		    <label class="form-label">Email</label>
		    <input type="text" 
		           class="form-control"
		           name="email"
		           value="<?php echo (isset($_GET['email']))?$_GET['email']:"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="pass">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Login</button>
		  <a href="rsignup.php" class="link-secondary">Sign Up</a>
		</form>
    </div>
</body>
</html>