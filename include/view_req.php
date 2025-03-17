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

 


$user_id=$_SESSION['id'];
$sql = "SELECT req_food.id,recv_id ,quantity_needed,add_food_details.food_name,rsignup.orgname  FROM req_food 
LEFT OUTER JOIN rsignup ON req_food.recv_id = rsignup.id
LEFT OUTER JOIN add_food_details ON req_food.food_id = add_food_details.id
WHERE status=1 AND $user_id = add_food_details.donor_id; ";
 


$stmt = $conn->prepare($sql);
$stmt->execute();

 

if ($stmt->rowCount() > 0) {
    
    echo "<table>
    <tr>
    <th>Receiver</th>
    <th>Food Name</th>
    <th>Quantity Requested</th>
    <th>Action</th>
    </tr>";
    
       
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          $recv=$row['id'];
        echo "<td>" . $row['orgname'] . "</td>";
          echo "<td>" . $row['food_name'] . "</td>";
          echo "<td>" . $row['quantity_needed'] . "</td>";
          $qty=$row['quantity_needed'];
          echo'<td><button class="verify-button" style="background:green;" type="button" onclick="Accept('.$recv.','.$qty.')">Accept</button>
        <button class="verify-button"style="background:red;" type="button" onclick="Reject('.$recv.')">Reject</button></td>';
        
          echo "</tr>";
        }
        echo "</table>";
      }

 else {
    echo "0 results";
}
?>
<script>
    function Accept(id,quan) {
        console.log(id);
        console.log(quan + 'abc');
        var xmlhttp = new XMLHttpRequest();
      
        xmlhttp.open("POST", "include/accept_reject.php", true);
       
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               
                var response = xmlhttp.responseText;
                console.log(response); 
                location.reload();
            }
        };
       
        var data = "id=" + id + "&quan=" + quan ;
       
        xmlhttp.send(data);
    }
    function Reject(id) {
        console.log("button clicked");
       
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.open("POST", "include/reject.php", true);
       
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                
                var response = xmlhttp.responseText;
                console.log(response); 
                location.reload();
            }
        };
       
        var data = "id=" + id ;
       
        xmlhttp.send(data);
    }
</script>
