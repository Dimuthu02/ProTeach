<?php
//include connection php file

require_once "ConnectionUserAcc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserID = $_POST ["UserID"];
    $CourseID = $_POST ["CourseID"];
    $EnrollmentDate = $_POST ["EnrollmentDate"];
    $CompletionStatus = $_POST ["CompletionStatus"];

//check userID
    $checkQuery = "SELECT * FROM user_details WHERE UserID = '$UserID'";
    $result = $conn -> query($checkQuery);

    if($result -> num_rows > 0){
        //userID alresdy Exists
        echo "<script>alert('This userID is already registere');</script>";
        echo "<script>window.location.href='Display.php';</script>";
        exit();
    }else{
        echo "Error :" . $sql . "<br>" . $conn -> error;
    }

    //Insert data into the database
    $sql = "INSERT INTO user_details (UserID,CourseID,EnrollmentDate,CompletionStatus)
    VALUES ('$UserID','$CourseID','$EnrollmentDate','$CompletionStatus')";
}
//check if the insert was successful
if ($conn -> query($sql) === TRUE){
    echo "<script>alert('Data Added Successfully')</script>";
    echo "<script>window.location.href='Display.php'</script>";
}
else{
    echo "Error : " . $sql . "<br>" . $conn -> error;
}

$conn -> close();

?>