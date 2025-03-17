<?php

 

include "db_conn.php";


$sql = "SELECT rsignup.id,orgname,email,phone,filepath,verification_status.status FROM rsignup
LEFT OUTER JOIN status_details AS verification_status ON rsignup.verify_status = verification_status.id
WHERE verify_status=2";

$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {

    echo "<table>
    <tr>
    <th>Donor Name</th>
    <th>Email</th>
    <th>Phone </th>
    <th>Uploaded Document</th>
    
    </tr>";

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    $recv=$row['id'];
    echo "<td>" . $row['orgname'] . "</td>";
    echo "<td>" . $row['email']   . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    
    echo '<td><a href="uploads/'.$row['filepath'].'" target="_blank">View document</a></td>';
    echo "</tr>";
  }
  echo "</table>";
}
// }
else {
echo "0 results";
}
?>