<?php
//DB Connection
require_once 'ConnectionUserAcc.php';

if (isset($_GET['EnrollmentID'])){
    $EnrollmentID = $_GET['EnrollmentID'];

    //Retriev the recor with the given ID
    $sql ="SELECT * FROM user_details WHERE EnrollmentID = '$EnrollmentID'";
    $result = $conn -> query($sql);

    if ($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        $UserID = $row["UserID"];
        $CourseID = $row["CourseID"];
        $EnrollmentDate = $row["EnrollmentDate"];
        $CompletionStatus = $row["CompletionStatus"];

        //Display the update form
        echo "<form action= 'Update.inc.php' method='POST'>";
        echo "<input type='hidden' name='EnrollmentID' value ='". $EnrollmentID ."' required><br>";

        echo "<label for='UserID'>User ID</label> <br>";
        echo "<input type='text' name='UserID' value ='". $UserID ."' required><br>";

        echo "<label for='CourseID'>Course ID</label> <br>";
        echo "<input type='text' name='CourseID' value ='". $CourseID ."' required><br>";
       
        echo "<label for='EnrollmentDate'>Enrollment Date</label> <br>";
        echo "<input type='text' name='EnrollmentDate' value ='". $EnrollmentDate ."' required><br>";
       
        echo "<select name='CompletionStatus' required>";
        echo "<option value='Not Started'" . ($CompletionStatus == 'Not Started' ? ' selected' : '') . ">Not Started</option>";
        echo "<option value='In progress'" . ($CompletionStatus == 'In progress' ? ' selected' : '') . ">In progress</option>";
        echo "<option value='Completed'" . ($CompletionStatus == 'Completed' ? ' selected' : '') . ">Completed</option>";
        echo "</select><br>";

        echo "<button type='submit'> update </button>";

        echo "</form>";
    }else{
        echo "No recode available";
    }
}else{
    echo "EnrollmentID is missing";
}
$conn -> close();
?>