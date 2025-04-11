<?php
// Database connection 
$con = mysqli_connect('localhost', 'root', '', 'bikerental');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Function to create tables if they do not exist
function createTables($conn) {
    // Table creation queries
    $userTableSQL = "CREATE TABLE IF NOT EXISTS user (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name_stud VARCHAR(50) NOT NULL,
                        id_stud VARCHAR(30) NOT NULL,
                        fon_stud VARCHAR(15) NOT NULL,
                        password VARCHAR(255) NOT NULL
                    )";

    $bikesTableSQL = "CREATE TABLE IF NOT EXISTS bikes (
                        bike_id INT AUTO_INCREMENT PRIMARY KEY,
                        bike_type VARCHAR(50) NOT NULL,
                        quantity INT NOT NULL,
                        status VARCHAR(50) NOT NULL
                    )";

    $rentalsTableSQL = "CREATE TABLE IF NOT EXISTS rentals (
                        rental_id INT AUTO_INCREMENT PRIMARY KEY,
                        bike_id INT NOT NULL,
                        id_stud VARCHAR(30) NOT NULL,
                        rental_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        return_date TIMESTAMP NULL DEFAULT NULL,
                        status VARCHAR(50) NOT NULL,
                        FOREIGN KEY (bike_id) REFERENCES bikes(bike_id),
                        FOREIGN KEY (id_stud) REFERENCES user(id_stud)
                    )";

    $adminsTableSQL = "CREATE TABLE IF NOT EXISTS admins (
                        admin_id VARCHAR(30) PRIMARY KEY,
                        admin_name VARCHAR(100) NOT NULL,
                        admin_password VARCHAR(255) NOT NULL
                    )";

    // Execute queries
    if ($conn->query($userTableSQL) === TRUE) {
        echo "Table 'user' created successfully or already exists.<br>";
    } else {
        echo "Error creating table 'user': " . $conn->error . "<br>";
    }

    if ($conn->query($bikesTableSQL) === TRUE) {
        echo "Table 'bikes' created successfully or already exists.<br>";
    } else {
        echo "Error creating table 'bikes': " . $conn->error . "<br>";
    }

    if ($conn->query($rentalsTableSQL) === TRUE) {
        echo "Table 'rentals' created successfully or already exists.<br>";
    } else {
        echo "Error creating table 'rentals': " . $conn->error . "<br>";
    }

    if ($conn->query($adminsTableSQL) === TRUE) {
        echo "Table 'admins' created successfully or already exists.<br>";
    } else {
        echo "Error creating table 'admins': " . $conn->error . "<br>";
    }
}

// Call function to create tables
createTables($con);

// Close connection
$con->close();
?>
