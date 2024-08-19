<?php 
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-danger">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"> <img src="./static/images/logo2.png" alt="bloodaid logo" height="32px" width="150px"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <?php
            // Check if session is started and role_id is set
            if (isset($_SESSION["user_id"])) {
                // User is logged in
                if (isset($_SESSION["role_id"])) {
                    if ($_SESSION["role_id"] == 2) {
                        // User is a donor
                        ?>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="donorform.php">Donate Blood</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="patientform.php">Request Blood</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="viewdonations.php">View Donations</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="viewrequests.php">View Requests</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                        </li>
                        <?php
                    } elseif ($_SESSION["role_id"] == 1) {
                        // User is an admin
                        ?>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="donation_requests.php">Donation Requests</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="patient_requests.php">Patient Requests</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="blood_stock.php">Blood Stock</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="donation_history.php">Donor History</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="patient_history.php">Patient History</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                        </li>
                        <?php
                    }
                } 
            } else {
                // User is not logged in
                ?>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                </li>
                <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Add other header content if needed -->
