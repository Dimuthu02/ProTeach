<?php

require_once 'connection.php';

if (isset($_GET['CID'])) {

    $C_id = $_GET['CID'];

    $query = "DELETE FROM coursedetails WHERE CID = $C_id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Course Deleted Successfully !'); window.location.href = 'read_course.php';</script>";

    } else {
        echo "<script>alert('Course Deletion UnSuccessfull !'); window.location.href = 'read_course.php';</script>";
    }
}
