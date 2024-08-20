<?php include('header.php'); ?>

<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>

<?php include('database.php'); ?>

<div class="container">
    <h1>PATIENTS HISTORY</h1>

            <?php
            // Fetch donation requests from the database
            $qery = $conn->prepare("SELECT request_id,username, blood_group, units, reason, requested_date, phone_number,status FROM user JOIN patient_requests ON user.user_id = patient_requests.user_id");
            $qery->execute();
            $result = $qery->get_result();

            // Loop through each donation request
            if ($result->num_rows > 0) {
                echo ' <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Request ID</th>
                        <th>Username</th>
                        <th>Blood Group</th>
                        <th>Units</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Phone Number</th>
                        <th>Status Requests</th>
                    </tr>
                </thead>';
            
            while ($patient = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $patient['request_id']; ?></td>
                    <td><?php echo $patient['username']; ?></td>
                    <td><?php echo $patient['blood_group']; ?></td>
                    <td><?php echo $patient['units']; ?></td>
                    <td><?php echo $patient['reason']; ?></td>
                    <td><?php echo $patient['requested_date']; ?></td>
                    <td><?php echo $patient['phone_number']; ?></td>
                    <td><?php echo $patient['status']; ?></td>
                </tr>
                <?php
            }
        } else {
            echo '<div class="alert alert-primary" role="alert">
                    No Patient history found!
            </div>';
        }

            // Close the statement
            $qery->close();
            ?>
        </tbody>
    </table>
</div>


<?php include('footer.php'); ?>
