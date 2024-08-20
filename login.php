<?php include('header.php'); ?>

<?php
include('database.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a statement
    $qery = $conn->prepare("SELECT * FROM user WHERE username = ? and password = ?");
    $qery->bind_param("ss", $username, $password); // "s" denotes the type as string
    // Execute the statement
    $qery->execute();

    // Store the result
    $result = $qery->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // You should also validate the password here
        // For simplicity, assume login is successful
        echo "('Login successful')";
        
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role_id"] = $row["role_id"];
        if ($row["role_id"] == 2) {
            header('Location: donorform.php');
        } else {
            header('Location: blood_stock.php');
        }
        exit();
    } else {
        echo '<div class="alert alert-danger" style="position: absolute; top: 10%; left: 50%; transform: translateX(-50%); text-align: center; width: 275px; margin-top: 20px;" role="alert">
            Invalid username or password!..
            </div>';
    }

    // Close the statement
    $qery->close();
}
?>

<!-- Centered container -->
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="margin-top: -50px; position: relative;">
    <div class="col-md-4 col-lg-3 mt-1"> <!-- Adjusted margin-top here -->
        <h1 class="text-center mb-4">LOGIN</h1>

        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
            </div>
            <input type="submit" value="Login" class="btn btn-primary w-100 bg-danger">
            <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
