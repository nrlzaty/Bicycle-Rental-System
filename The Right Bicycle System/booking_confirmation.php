<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Confirmation</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script>
    // Function to show popup message
    function showPopup() {
      alert("Booking Successful! Please show this confirmation at your profile to the worker.");
    }
  </script>
</head>
<body onload="showPopup()">
  <!-- Header -->
  <header class="header" id="header">
    <!-- Header content (same as previous) -->
  </header>

  <!-- Main Content -->
  <main class="main">
    <!-- Booking Confirmation Section -->
    <section id="booking-confirmation" class="section">
      <div class="container">
        <h2 class="section-heading">Booking Confirmation</h2>
        <br/>
        <div class="booking-details">
          <?php
          session_start();
          if (isset($_SESSION['booking_details'])) {
              $booking_details = $_SESSION['booking_details'];
              echo "<p>Thank you, {$booking_details['name']}! Your booking is confirmed.</p>";
              echo "<p>Matrix Number: {$booking_details['id_stud']}</p>";
              echo "<p>Phone: {$booking_details['fon_stud']}</p>";
              echo "<p>Bike Type: {$booking_details['bike_type']}</p>";
              echo "<p>Rental Date: {$booking_details['rental_date']}</p>";
              echo "<p>Return Date: {$booking_details['return_date']}</p>";
              echo "<p>Duration: {$booking_details['duration']} hours</p>";
              echo "<p>Total Price: RM {$booking_details['total_price']}</p>";
              echo "<p>Please show this confirmation at your profile to the worker.</p>";
          } else {
              echo "<p>Booking details not found.</p>";
          }
          ?>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <!-- Footer content (same as previous) -->
  </footer>
</body>
</html>
