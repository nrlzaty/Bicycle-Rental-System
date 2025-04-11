<?php

session_start();

// Check if a user is logged in
if(isset($_SESSION['admin_id'])) {
    // Database connection 
    $con = new mysqli('localhost', 'root', '', 'bikerental');

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Get the admin ID from session
    $admin_id = $_SESSION['admin_id'];

    // Update the logout time in the admin activity table
    $update_query = "UPDATE admin_activity SET logout_time = CURRENT_TIMESTAMP WHERE admin_id = '$admin_id' AND logout_time IS NULL";
    $update_result = $con->query($update_query);

    if ($update_result === TRUE) {
        echo "Admin logged out successfully!";
    } else {
        echo "Error logging out: " . $con->error;
    }

    // Close the connection
    $con->close();

    // Destroy the admin session
    session_unset();
    session_destroy();

} elseif(isset($_SESSION['id_stud'])) {
    // If customer is logged in, destroy the session
    session_unset();
    session_destroy();
    
    echo "Customer logged out successfully!";
} else {
    // If no user is logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

?>
