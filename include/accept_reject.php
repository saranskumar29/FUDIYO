<?php

 

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "fudiyo";

$id = $_POST['id'];
$quantity=$_POST['quan'];
$newStatus = 2 ;

echo $quantity;
try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $sql = "UPDATE req_food SET status = 2 WHERE id = :id";
    $sql = "UPDATE req_food 
    LEFT OUTER JOIN add_food_details AS food_details ON req_food.food_id = food_details.id
    SET status = 2 , food_details.quantity = food_details.quantity - :quan 
    WHERE req_food.id = :id AND food_details.quantity >= :quan";
    echo $id;
    

   
    $stmt = $conn->prepare($sql);

    
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':quan', $quantity, PDO::PARAM_INT);
    
    $stmt->execute();
    
    header("Location:../receiver_db.php");
    exit(); 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

