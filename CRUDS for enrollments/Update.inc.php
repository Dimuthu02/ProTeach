<?php
//Include DB Connection
include 'ConnectionUserAcc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $EnrollmentID = $_POST['EnrollmentID'];
    $UserID = $_POST['UserID'];
    $CourseID = $_POST['CourseID'];
    $EnrollmentDate = $_POST['EnrollmentDate'];
    $CompletionStatus = $_POST['CompletionStatus'];

    //Update data in the database

    $sql = "UPDATE user_details SET UserID='$UserID',
    CourseID= '$CourseID', EnrollmentDate= '$EnrollmentDate', CompletionStatus='$CompletionStatus' 
    WHERE EnrollmentID = '$EnrollmentID'";

    //Check if update was Successful
    if($conn->query($sql) === TRUE){
        echo "<script>alert('User Details Updated Successfully');</script>";
        echo "<script>window.location.href ='Display.php'; </script>";
    }
    else{
        echo "Details Updated Failed: " . $conn->error;
    }
}
//close connection
$conn -> close();

?>