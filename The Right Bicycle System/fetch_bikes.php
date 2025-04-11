<?php
$con = mysqli_connect('localhost', 'root', '', 'bikerental');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$query = "SELECT bike_id, bike_type, quantity, available FROM bikes";
$result = mysqli_query($con, $query);

$bikes = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $row['status'] = $row['available'] ? 'Available' : 'Not Available';
        $bikes[] = $row;
    }
}

mysqli_close($con);
?>
