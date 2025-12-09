<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Cname = $_POST['Cname'];
    $C_Description = $_POST['C_Description'];
    $C_category = $_POST['C_category'];
    $C_image = $_POST['C_image'];
    $Cbutton = $_POST['Cbutton'];

    $query = "INSERT INTO coursedetails(Cname,C_Description,C_category,Cbutton)
                VALUES('$Cname' , '$C_Description' , '$C_category' , '$Cbutton')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('New Course Added Successfully'); window.location.href = 'trainer-dashboard.php'; </script>";
    } else {
        echo "<script>alert('New Course Added Unsuccessfully')</script>";
    }

}