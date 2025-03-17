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

 

$sql = "SELECT food_details.id, food_name, quantity, description, donor_details.orgname AS donor_name,donor_details.id AS donor_id FROM add_food_details AS food_details
LEFT OUTER JOIN dsignup AS donor_details ON food_details.donor_id = donor_details.id 
WHERE quantity>0";

 

$stmt = $conn->prepare($sql);
$stmt->execute();

 
if ($stmt->rowCount() > 0) {
    
    echo "<table>
    <tr>
    <th>Donor</th>
    <th>Food Name</th>
    <th>Quantity</th>
    <th>Details</th>
    <th>Quantity Needed</th>
    <th>Action</th>
    </tr>";
    
       
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          $recv=$row['id'];
          $donor=$row['donor_id'];
          echo "<td>" . $row['donor_name'] . "</td>";
          echo "<td>" . $row['food_name'] . "</td>";
          echo "<td>" . $row['quantity'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          
          echo '<td> <input type= "number" min="1" max="'.$row['quantity'].'" id="quantity_needed_'.$recv.'"></td>';
          echo'<td><button class="request-button" type="button" onclick="requestFood('.$recv.','.$donor.')">Request</button></td>';
          echo "</tr>";
        }
        echo "</table>";
       
      }
// }
 else {
    echo "0 results";
}
?>
<script>
    function requestFood(id,dnr) {
        // console.log("button clicked" + dnr);

       var quantityNeeded = document.getElementById("quantity_needed_" + id).value;
        // console.log(id,quantityNeeded);
       
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.open("POST", "include/req_food.php", true);
      
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                
                var response = xmlhttp.responseText;
                console.log(response); 
                location.reload();
            }
        };


        var data = "id=" + id + "&quantity=" + quantityNeeded + "&donor_id=" + dnr;


        xmlhttp.send(data);
    }
    
</script>
