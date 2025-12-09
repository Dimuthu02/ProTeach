<?php
//Include DB Connection
require_once 'ConnectionUserAcc.php';

//check the delete id parameter in the URL

if(isset($_GET['Delete_ID'])){
    $DeleteID = $_GET['Delete_ID'];

    $sql = "DELETE FROM user_details WHERE EnrollmentID = '$DeleteID'";
    if($conn -> query($sql) === TRUE){
        echo "<script> alert ('User Account Deleted');</script>";
        echo "<script>  window.location.href = 'Display.php';</script>";
    }else{
        echo "Account deleted Failed";
    }
}else{
    echo "Delete ID parameter not found";
}

$conn -> close();
?>