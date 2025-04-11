<?php

// Database connection 
$con = new mysqli('localhost', 'root', '', 'bikerental');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get the POST records
$id_stud = $_POST['id_stud'];
$password = trim($_POST['password']);
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Check if the ID belongs to an admin
$admin_ids = array("admin1", "admin2", "admin3"); // Add all admin IDs here
if (in_array($id_stud, $admin_ids)) {
    // Fixed admin password
    $admin_password = "admin_password"; // Change this to your desired admin password

    // Verify admin password
    if ($password == $admin_password) {
        if ($action == 'logout') {
            // Update logout time in the admin activity table
            $admin_id = $id_stud;
            $update_query = "UPDATE admin_activity SET logout_time = CURRENT_TIMESTAMP WHERE admin_id = '$admin_id' AND logout_time IS NULL";
            $update_result = $con->query($update_query);
            
            if ($update_result === TRUE) {
                echo "Admin logout successful!";
            } else {
                echo "Error updating admin logout time: " . $con->error;
            }
        } else {
            // Create a table to record admin activity if it doesn't exist
            $create_table_query = "CREATE TABLE IF NOT EXISTS admin_activity (
                                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    admin_id VARCHAR(30) NOT NULL,
                                    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                    logout_time TIMESTAMP NULL DEFAULT NULL
                                  )";
            $create_table_result = $con->query($create_table_query);
            
            // Insert a record into the admin activity table
            $admin_id = $id_stud;
            $insert_query = "INSERT INTO admin_activity (admin_id) VALUES ('$admin_id')";
            $insert_result = $con->query($insert_query);
            
            // Start session and store admin ID
            session_start();
            $_SESSION['admin_id'] = $id_stud;
        
            // Redirect to admin panel
            header("Location: dashboard_admin.php");
            exit();
        }
    } else {
        echo "Invalid admin password.";
    }
} else {
    // Prepare and bind for regular users
    $stmt = $con->prepare("SELECT password FROM user WHERE id_stud = ?");
    $stmt->bind_param("s", $id_stud);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    if ($stored_password) {
        // Verify the password
        if (password_verify($password, $stored_password)) {
            // Start session and store user ID
            session_start();
            $_SESSION['id_stud'] = $id_stud;
        
            // Redirect to customer panel
            header("Location: dashboard_customer.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that student ID.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$con->close();

?>