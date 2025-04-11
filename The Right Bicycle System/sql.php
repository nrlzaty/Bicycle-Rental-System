<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'bikerental');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Function to check if a table exists
function tableExists($conn, $table) {
  $result = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
  return $result && mysqli_num_rows($result) > 0;
}

// Create bikes table if not exists
if (!tableExists($con, 'bikes')) {
  $sql = "CREATE TABLE bikes (
    bike_id INT AUTO_INCREMENT PRIMARY KEY,
    bike_type VARCHAR(255) NOT NULL,
    available BOOLEAN DEFAULT TRUE,
    quantity INT NOT NULL DEFAULT 0
  )";
  
  if (mysqli_query($con, $sql) === TRUE) {
    echo "Table 'bikes' created successfully.<br>";

    // Insert some sample data
    $sql = "INSERT INTO bikes (bike_type, available, quantity) VALUES
      ('Blue Bike', TRUE, 15),
      ('Gray Bike', TRUE, 2),
      ('Green Bike', TRUE, 3),
      ('Yellow Bike', TRUE, 5)";
    
    if (mysqli_query($con, $sql) === TRUE) {
      echo "Sample data inserted into 'bikes' table successfully.<br>";
    } else {
      echo "Error inserting data: " . mysqli_error($con) . "<br>";
    }
  } else {
    echo "Error creating table: " . mysqli_error($con) . "<br>";
  }
} else {
  echo "Table 'bikes' already exists.<br>";
}

// Create rentals table if not exists
if (!tableExists($con, 'rentals')) {
  $sql = "CREATE TABLE rentals (
    rental_id INT AUTO_INCREMENT PRIMARY KEY,
    bike_id INT NOT NULL,
    id_stud VARCHAR(255) NOT NULL,
    rental_date DATE NOT NULL,
    return_date DATE NOT NULL,
    duration_type ENUM('hours', 'weeks') NOT NULL,
    duration_amount INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('booked', 'returned') DEFAULT 'booked',
    FOREIGN KEY (bike_id) REFERENCES bikes(bike_id)
  )";
  
  if (mysqli_query($con, $sql) === TRUE) {
    echo "Table 'rentals' created successfully.<br>";
  } else {
    echo "Error creating table: " . mysqli_error($con) . "<br>";
  }
} else {
  echo "Table 'rentals' already exists.<br>";
}

mysqli_close($con);
?>
