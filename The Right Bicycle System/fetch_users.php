<?php
// Database connection
$con = new mysqli('localhost', 'root', '', 'bikerental');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch user data
$sql = "SELECT id_stud, name_stud, fon_stud FROM user";
$result = $con->query($sql);

$users = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Close the connection
$con->close();
?>
