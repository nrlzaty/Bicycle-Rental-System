<?php
// Establish database connection
$con = mysqli_connect('localhost', 'root', '', 'bikerental');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Query to fetch rental data
$query = "SELECT rental_id, bike_id, id_stud, rental_date, return_date, status FROM rentals";
$result = mysqli_query($con, $query);

$rentals = [];

// Fetch and store rental data in $rentals array
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rentals[] = $row;
    }
} else {
    echo "Error fetching rentals: " . mysqli_error($con);
}

// Close database connection
mysqli_close($con);
?>
