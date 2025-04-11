<?php
// Start session
session_start();

// Establish database connection
$con = new mysqli('localhost', 'root', '', 'bikerental');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the user is logged in
if (isset($_SESSION['id_stud'])) {
    $id_stud = $_SESSION['id_stud'];

    // Prepare and bind
    $stmt = $con->prepare("SELECT name_stud, id_stud, fon_stud FROM user WHERE id_stud = ?");
    $stmt->bind_param("s", $id_stud);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($userName, $userMatrixNumber, $userPhone);
    $stmt->fetch();

    // Close the statement before executing a new query
    $stmt->close();

    // Fetch rental history
    $rental_query = $con->prepare("SELECT rental_id, bike_id, rental_date, return_date, status FROM rentals WHERE id_stud = ?");
    $rental_query->bind_param("s", $id_stud);
    $rental_query->execute();
    $rental_result = $rental_query->get_result();

    // Store rental history in an array
    $rentals = [];
    while ($row = $rental_result->fetch_assoc()) {
        $rentals[] = $row;
    }

    // Close the statement and connection
    $rental_query->close();
} else {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Close the connection
$con->close();
?>
