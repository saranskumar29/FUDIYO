<?php

 

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "fudiyo";

$id = $_POST['id'];
$newStatus = 2 ;


try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE rsignup SET verify_status = 2 WHERE id = :id";
    
    // echo $id;

    $stmt = $conn->prepare($sql);


    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  
    $stmt->execute();
   
    // header("Location:../receiver_db.php");
    exit(); 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
