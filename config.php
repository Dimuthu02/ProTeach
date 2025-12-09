<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'proteach');

// Create database connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Get current user ID
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Get current user info
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    // Cache user data in session to avoid repeated queries
    if (isset($_SESSION['user_data'])) {
        return $_SESSION['user_data'];
    }
    
    $conn = getDBConnection();
    $userId = getCurrentUserId();
    
    $stmt = $conn->prepare("SELECT id, username, email, full_name FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();
    
    // Cache in session
    if ($user) {
        $_SESSION['user_data'] = $user;
    }
    
    return $user;
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}
?>
