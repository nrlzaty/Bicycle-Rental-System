<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

  <!-- Header -->
  <header class="header" id="header">
      <nav class="nav" id="nav">
        <a href="dashboard_admin.php"><img src="bikelogo.png" class="logo" alt="site logo"/></a>
     <div class="nav_menu" id="nav-menu">
          <ul class="nav_list">
            <li class="nav_item">
              <a href="#manage-rentals" class="nav_link">Manage Rentals</a></li>
            <li class="nav_item">
              <a href="#manage-users" class="nav_link">Manage Users</a>
            </li>
            <li class="nav_item">
              <a href="#manage-inventory" class="nav_link">Manage Inventory</a>
            </li>
          </ul>
        </div>
     <div class="book-cta"><a href="logout.php">Logout</a></div>
        
		</nav>
  </header>

  <!-- Main Content -->
  <main class="main-admin">

    <section id="manage-rentals" class="section">
      <div class="container">
        <h2 class="section-heading">Manage Rentals</h2>
        <div class="admin-dashboard">
          <div class="card">
            <div class="card-header">Recent Rentals</div>
            <div class="card-body">
              <div class="table-responsive">
                <table>
                  <thead>
                    <tr>
                      <th>Rental ID</th>
                      <th>Bike ID</th>
                      <th>Matrix No</th>
                      <th>Rental Date</th>
                      <th>Return Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
    include 'fetch_rentals.php'; // Include script to fetch rentals data
    if (count($rentals) > 0) {
        foreach ($rentals as $rental) {
            echo "<tr>
                    <td>" . htmlspecialchars($rental["rental_id"]) . "</td>
                    <td>" . htmlspecialchars($rental["bike_id"]) . "</td>
                    <td>" . htmlspecialchars($rental["id_stud"]) . "</td>
                    <td>" . htmlspecialchars($rental["rental_date"]) . "</td>
                    <td>" . htmlspecialchars($rental["return_date"]) . "</td>
                    
                    <td>";

            if ($rental["status"] == 'booked') {
                // Form for returning bike
                echo "<form action='return_rental.php' method='post'>
                        <input type='hidden' name='rental_id' value='" . $rental['rental_id'] . "'>
                        <button type='submit' class='action-btn'>Return Bike</button>
                      </form>";
            } else {
                // Display 'Returned' if already returned
                echo "Returned";
            }

            echo "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No rentals found</td></tr>";
    }
    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="manage-users" class="section">
      <div class="container">
        <h2 class="section-heading">Manage Users</h2>
        <div class="admin-dashboard">
          <div class="card">
            <div class="card-header">User List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table>
                  <thead>
                    <tr>
                      <th>Matrix No</th>
                      <th>Name</th>
                      <th>Phone</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                    include 'fetch_users.php';
                    if (count($users) > 0) {
                        foreach ($users as $user) {
                            echo "<tr>
                            <td>" . htmlspecialchars($user["id_stud"]) . "</td>
                            <td>" . htmlspecialchars($user["name_stud"]) . "</td>
                            <td>" . htmlspecialchars($user["fon_stud"]) . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No users found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="manage-inventory" class="section">
  <div class="container">
    <h2 class="section-heading">Manage Inventory</h2>
    <div class="admin-dashboard">
      <div class="card">
        <div class="card-header">Bike List</div>
        <div class="card-body">
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Bike ID</th>
                  <th>Bike Type</th>
                  <th>Quantity</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'fetch_bikes.php';
                if (count($bikes) > 0) {
                    foreach ($bikes as $bike) {
                        echo "<tr>
                        <td>" . htmlspecialchars($bike["bike_id"]) . "</td>
                        <td>" . htmlspecialchars($bike["bike_type"]) . "</td>
                        <td>" . htmlspecialchars($bike["quantity"]) . "</td>
                        <td>" . htmlspecialchars($bike["status"]) . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No bikes found</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  </main>

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
<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // Handle form submission for returning bike
    $('form').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Send AJAX request to return_rental.php
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Show success message
                    alert(response.message);
                    // Reload the page to show updated data
                    location.reload();
                } else {
                    // Show error message
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Show error message if AJAX request fails
                alert('Error: ' + status + ' - ' + error);
            }
        });
    });
});
</script>


  
</body>
</html>
