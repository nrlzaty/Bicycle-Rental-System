<?php
// Database connection (make sure you have this part included in your script)
$con = mysqli_connect('localhost', 'root', '', 'bikerental');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve rental_id from POST data
$rental_id = $_POST['rental_id'];

// Update rental status to 'returned'
$update_rental_query = "UPDATE rentals SET status = 'returned' WHERE rental_id = $rental_id";

if (mysqli_query($con, $update_rental_query)) {
    // Retrieve bike_id associated with the rental
    $get_bike_query = "SELECT bike_id FROM rentals WHERE rental_id = $rental_id";
    $result = mysqli_query($con, $get_bike_query);
    $row = mysqli_fetch_assoc($result);
    $bike_id = $row['bike_id'];

    // Update bike quantity (increment by 1)
    $update_bike_query = "UPDATE bikes SET quantity = quantity + 1 WHERE bike_id = $bike_id";

    if (mysqli_query($con, $update_bike_query)) {
        // Bike stock updated successfully
        $response = array(
            'status' => 'success',
            'message' => 'Rental marked as returned successfully. Bike stock updated.'
        );
    } else {
        // Error updating bike stock
        $response = array(
            'status' => 'error',
            'message' => 'Error updating bike stock: ' . mysqli_error($con)
        );
    }
} else {
    // Error marking rental as returned
    $response = array(
        'status' => 'error',
        'message' => 'Error marking rental as returned: ' . mysqli_error($con)
    );
}

mysqli_close($con);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
