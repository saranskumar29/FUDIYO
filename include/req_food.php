<?php

 

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "fudiyo";
// if (isset($_POST['id']) && isset($_POST['quantity'])&& isset($_POST['donor_id'])) {
//     $id = $_POST['id'];
//     $quantityNeeded = $_POST['quantity'];
//     $receiverId = $_SESSION['id'];
//     $donor_id = $_POST['donor_id'];





   
//     echo "Received ID: " .$receiverId . ", Quantity Needed: " . $quantityNeeded ;
//     echo $donor_id;
// } else {
    
//     echo "Error: Invalid data received.";
// }
$id = $_POST['id'];
    $quantityNeeded = $_POST['quantity'];
    $receiverId = $_SESSION['id'];
    $donor_id = $_POST['donor_id'];
    

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
   $sql = "INSERT INTO req_food(food_id,quantity_needed,status,recv_id,donor_id) 
    VALUES(?,?,?,?,?)";
  
    
    $stmt = $conn->prepare($sql);       
    $stmt->execute([$id,$quantityNeeded,1,$receiverId,$donor_id]);
    header("Location:../receiver_db.php");

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



