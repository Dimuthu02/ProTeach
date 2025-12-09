<?php
//Insert DB connection
require_once 'ConnectionUserAcc.php';

//Retriew data from the database
$sql = "SELECT * FROM user_details";
$result = $conn -> query($sql);

if ($result -> num_rows > 0){
    while ($row = $result -> fetch_assoc()){
        echo "<tr>";
        echo "<td>" .$row["EnrollmentID"] . "</td>";
        echo "<td>" .$row["UserID"] . "</td>";
        echo "<td>" .$row["CourseID"] . "</td>";
        echo "<td>" .$row["EnrollmentDate"] . "</td>";
        echo "<td>" .$row["CompletionStatus"] . "</td>";
        echo "<td>";
        echo "<button onClick=\"redirectToUpdateForm('" . $row["EnrollmentID"] . "')\">Update</button>";
        echo "<a href=\"Delete.php?Delete_ID=" . $row["EnrollmentID"] . "\"> Delete </a>";
        echo "</td>";
        echo "</tr>";
     }
}else{
    echo "No data available";
}
$conn -> close();
?>