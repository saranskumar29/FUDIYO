<?php 

if(isset($_POST['food_name']) && 
   isset($_POST['quantity']) && 
   isset($_POST['description'])){

    include "db_conn.php";

    $food_name = $_POST["food_name"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    $data = "food_name=".$food_name."&quantity=".$quantity."&description=".$description;

    
  if (empty($food_name)) {
    $em = "Food Name is required";
    header("Location: ../donor_db.php?error=$em&$data");
    exit;
}else if(empty($quantity)){
    $em = "quantity is required";
    header("Location: ../donor_db.php?error=$em&$data");
    exit;
}else if(empty($description)){
    $em = "Description is required";
    header("Location: ../donor_db.php?error=$em&$data");
    exit;
}else {
    $pee = $_SESSION['id'];
    $sql = "INSERT INTO add_food_details(donor_id, food_name, quantity, description) 
    	        VALUES(?,?,?,?)";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$pee, $food_name, $quantity, $description]);
        

    	header("Location: ../donor_db.php?success=Food details added successfully");
	    exit;
    }

    }else {
	header("Location: ../dlogin.php?error=error");
	exit;
   
    
}