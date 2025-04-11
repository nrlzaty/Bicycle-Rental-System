<?php

// Database connection 
$con = mysqli_connect('localhost', 'root', '', 'bikerental');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create user table if it doesn't exist
$create_table_sql = "CREATE TABLE IF NOT EXISTS user (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name_stud VARCHAR(50) NOT NULL,
                        id_stud VARCHAR(30) NOT NULL,
                        fon_stud VARCHAR(15) NOT NULL,
                        password VARCHAR(255) NOT NULL
                    )";
mysqli_query($con, $create_table_sql);

// Get the POST records
$name_stud = $_POST['name_stud'];
$id_stud = $_POST['id_stud'];
$fon_stud = $_POST['fon_stud'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash(trim($password), PASSWORD_DEFAULT);

// Check if the password was hashed successfully
if (!$hashed_password) {
    die("Password hashing failed.");
}

// Database insert SQL code
$sql = "INSERT INTO user (name_stud, id_stud, fon_stud, password) VALUES ('$name_stud', '$id_stud', '$fon_stud', '$hashed_password')";

// Insert into database
$qry = mysqli_query($con, $sql);

// Check if the query was successful
if ($qry) {
    // Redirect to dashboard_customer.html
    header("Location: dashboard_customer.html?user=success");
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}

// Close the connection
mysqli_close($con);

?>
