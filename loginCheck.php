<?php
session_start();
include('config.php'); // Include database connection

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from the users table
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if user_type is Trainer or Learner and redirect accordingly
        if ($user['user_type'] === 'Trainer') {
            $_SESSION['userId'] = $user['userId']; // Store user ID in session
            echo "<script>alert('Trainer Login Successful!')</script>";
            echo "<script>window.location.href='Trainer-dashboard.php';</script>";
        } elseif ($user['user_type'] === 'Learner') {
            $_SESSION['userId'] = $user['userId']; // Store user ID in session
            echo "<script>alert('Learner Login Successful!')</script>";
            echo "<script>window.location.href='learner-dashboard.php';</script>";
        } else {
            echo "<script>alert('Unauthorized user type!')</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password!')</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Please provide a username and password.')</script>";
    echo "<script>window.location.href='login.php';</script>";
}
?>