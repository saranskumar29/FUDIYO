<?php

 

include "db_conn.php";


$sql = "SELECT * FROM dsignup
WHERE verify_status=1";

$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {

    echo "<table>
    <tr>
    <th>Donor Name</th>
    <th>Email</th>
    <th>Phone </th>
    <th>Uploaded Document</th>
    <th>Action</th>
    </tr>";

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    $recv=$row['id'];
    echo "<td>" . $row['orgname'] . "</td>";
    echo "<td>" . $row['email']   . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    // echo "<td>" . $row['filepath'] . "</td>";
    echo '<td><a href="uploads/'.$row['filepath'].'" target="_blank">View document</a></td>';
    echo'<td><button class="verify-button" type="button" onclick="Accept('.$recv.')">Verify</button>
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
    function Accept(id) {
        console.log(id);
        var xmlhttp = new XMLHttpRequest();
      
        xmlhttp.open("POST", "include/donor_accept.php", true);
       
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
    function Reject(id) {
        console.log("button clicked");
       
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.open("POST", "include/donor_reject.php", true);
       
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
