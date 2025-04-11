<?php include('fetch_customer.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="header" id="header">
    <nav class="nav" id="nav">
        <a href="#"><img src="bikelogo.png" class="logo" alt="site logo"/></a>
        <div class="nav_menu" id="nav-menu">
            <ul class="nav_list">
                <li class="nav_item"><a href="rentalBicycle.html" >Home</a></li>
                <li class="nav_item"><a href="rentalBicycle.html" class="nav_link">Rental Info</a></li>
                <li class="nav_item"><a href="rentalBicycle.html" class="nav_link">Pricing</a></li>
                <li class="nav_item"><a href="rentalBicycle.html" class="nav_link">Why us</a></li>
                <li class="nav_item"><a href="profile.php">Profile</a></li>
            </ul>
        </div>
        <div class="book-cta"><a href="booking.html">Book Now</a></div>
        <div class="book-cta"><a href="logout.php">Logout</a></div>
        <div class="nav_toggle" id="nav-toggle">
            <i class="fas fa-bars icon"></i>
        </div>
    </nav>
</header>

<div class="section">
    <h1>User Profile</h1>
</div>

<div class="wrapper">
    <div class="profile-container">
        <div class="profile-header">
            <img src="profile.jpeg" alt="User Profile Picture">
            <h1><?php echo htmlspecialchars($userName); ?></h1>
            <p>Username: <?php echo htmlspecialchars($userMatrixNumber); ?></p>
        </div>

        <div class="scroll-container">
            <div class="content">
                <div class="profile-body">
                <h3>Contact Information</h3>
                <p>Matrix Number: <?php echo htmlspecialchars($userMatrixNumber); ?></p>
                <p>Phone: <?php echo htmlspecialchars($userPhone); ?></p>
                <h3>Rental History</h3>
                <?php if (!empty($rentals)) { ?>
                    <ul>
                        <?php foreach ($rentals as $rental) { ?>
                            <li>
                                Bike ID: <?php echo htmlspecialchars($rental['bike_id']); ?>, 
                                Rental Date: <?php echo htmlspecialchars($rental['rental_date']); ?>, 
                                Return Date: <?php echo htmlspecialchars($rental['return_date']); ?>, 
                                Status: <?php echo htmlspecialchars($rental['status']); ?>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p>No rental history found.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
    

        <!--FOOTER-->
        <footer class="footer2">
          <div class="container">
            <div class="row">
              <div class="footer-col">
                <div class="footer-about">
                  <img
                  src="logofoot.png"
                  alt="footer logo"
                  class="footer-logo"
                  />
                  <p class="description-foot">
                    Universiti Tun Hussein Onn Malaysia (UTHM),
                    86400 Parit Raja, Batu Pahat , Johor, Malaysia
                  </p>
              </div> 
              </div>
              <div class="footer-col">
                <h4>company</h4>
                <ul>
                  <li><a href="#">about us</a></li>
                  <li><a href="#">our services</a></li>
                  <li><a href="#">privacy policy</a></li>
                  <li><a href="#">affiliate program</a></li>
                </ul>
              </div>
              <div class="footer-col">
                <h4>get help</h4>
                <ul>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">returns</a></li>
                  <li><a href="#">order status</a></li>
                  <li><a href="#">payment options</a></li>
                </ul>
              </div>
              <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                  <img src="instagram.png">
                  <img src="ficon.png">
                  <img src="twitter.png">
                </div>
              </div>
            </div>
          </div>
       </footer>

</body>
</html>