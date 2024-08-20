<?php include('header.php'); ?>
<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>


<?php include('database.php');

// Prepare and execute the query
$qery = $conn->prepare("SELECT * FROM blood_stock");
$qery->execute();

// Get the result set
$result = $qery->get_result();
?>

<div class="container mt-5">
    <h1>BLOOD STOCK</h1>
    <div class="row">
        <?php
        // Check if there are rows to display
        if ($result->num_rows > 0) {
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['bloodgroup']; ?></h5>
                            <p class="card-text"><?php echo $row['units'] . " units"; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
            No blood stock available
            </div>';
        }
        ?>
    </div>
    <a href="index.php" class="btn btn-danger mt-3">Go back</a>
</div>

<?php
// Close the statement
$qery->close();
include('footer.php'); 
?>
