<?php

 

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "fudiyo";

 

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

 
$x = $_SESSION['id'];

$sql = "SELECT donor_details.orgname AS donor_name, food_details.food_name AS food, quantity_needed ,food_details.description AS food_description , req_status.status AS food_status FROM req_food
LEFT OUTER JOIN add_food_details AS food_details ON req_food.food_id = food_details.id 
LEFT OUTER JOIN status_details AS req_status ON req_food.status = req_status.id
LEFT OUTER JOIN dsignup AS donor_details ON req_food.donor_id = donor_details.id
WHERE recv_id =$x";
// $sql = "SELECT  food_details.food_name AS food, quantity_needed ,food_details.description AS food_description , req_status.status AS food_status FROM req_food
// LEFT OUTER JOIN add_food_details AS food_details ON req_food.food_id = food_details.id 
// LEFT OUTER JOIN status_details AS req_status ON req_food.status = req_status.id

// WHERE recv_id =$x";

 


$stmt = $conn->prepare($sql);
$stmt->execute();

 


if ($stmt->rowCount() > 0) {
    
    echo "<table>
    <tr>
    <th>Donor</th>
    <th>Food Name</th>
    <th>Quantity Needed</th>
    <th>Details</th>
    <th>Status</th>
    </tr>";
    
       
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . $row['donor_name'] . "</td>";
          echo "<td>" . $row['food'] . "</td>";
          echo "<td>" . $row['quantity_needed'] . "</td>";
          echo "<td>" . $row['food_description'] . "</td>";
          echo "<td>" . $row['food_status'] . "</td>";
        
          echo "</tr>";
        }
        echo "</table>";
      }

 else {
    echo "0 results";
}
?>