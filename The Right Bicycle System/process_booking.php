<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'bikerental');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $id_stud = $_POST['id_stud'];
    $fon_stud = $_POST['fon_stud'];
    $bike_id = $_POST['bike-type'];
    $rental_date = $_POST['rental-date'];
    $duration_type = $_POST['rental-duration'];
    $duration_amount = $_POST['duration-amount'];
    $return_date = $_POST['return-date'];
    
    // Calculate the total price
    if ($duration_type == 'hours') {
        $total_price = $duration_amount * 3; // RM 3 per hour
    } else if ($duration_type == 'weeks') {
        $total_price = $duration_amount * 10; // RM 10 per week
    }
    
    // Check bike availability
    $result = mysqli_query($con, "SELECT quantity FROM bikes WHERE bike_id = '$bike_id' AND available = TRUE");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['quantity'] > 0) {
            // Insert rental record
            $sql = "INSERT INTO rentals (bike_id, id_stud, rental_date, return_date, duration_type, duration_amount, total_price, status)
                    VALUES ('$bike_id', '$id_stud', '$rental_date', '$return_date', '$duration_type', '$duration_amount', '$total_price', 'booked')";
            
            if (mysqli_query($con, $sql) === TRUE) {
                // Update bike quantity
                $sql_update = "UPDATE bikes SET quantity = quantity - 1 WHERE bike_id = '$bike_id'";
                mysqli_query($con, $sql_update);
                
                // Close database connection
                mysqli_close($con);

                // JavaScript for showing popup and redirecting
                echo '<script>';
                echo 'alert("Booking successful! Click OK to view details in your profile.");';
                echo 'window.location.href = "profile.php";'; // Redirect to profile page
                echo '</script>';
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "<p>Sorry, the selected bike type is currently unavailable. Please choose another bike type.</p>";
        }
    } else {
        echo "<p>Sorry, the selected bike type is currently unavailable. Please choose another bike type.</p>";
    }
}

// Close database connection
mysqli_close($con);
?>
