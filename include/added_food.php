<?php

 

include "db_conn.php";
 session_start();




$pes = $_SESSION['id'];
$sql = "SELECT * FROM add_food_details WHERE donor_id = $pes AND quantity>0";

 

$stmt = $conn->prepare($sql);
$stmt->execute();


 
if ($stmt->rowCount() > 0) {
    
    echo "<table>
    <tr>
    <th>Food Name</th>
    <th>Quantity</th>
    <th>Details</th>
    </tr>";
    

       
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . $row['food_name'] . "</td>";
          echo "<td>" . $row['quantity'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
      }

 else {
    echo "0 results";
}

?>