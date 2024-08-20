<?php include('header.php'); ?>

<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>

<?php include('database.php'); ?>

<div class="container">
    <h1>DONATION REQUESTS</h1>
    <?php
    if(isset($_POST['submit'])) {
    
        $donation_id = $_POST["donation_id"];
        $status = $_POST["status"];
        $update_query = mysqli_query($conn, "UPDATE donation SET status = '$status' WHERE donation_id = $donation_id");

        if ($update_query) {
            $select_query = $conn->prepare("SELECT donation.units, user.blood_group 
                                            FROM donation 
                                            INNER JOIN user ON user.user_id = donation.user_id 
                                            WHERE donation_id = ?");
            $select_query->bind_param("s", $donation_id);
            $select_query->execute();
            $result = $select_query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $bloodgroup = $row["blood_group"];
                $units_donated = $row["units"];

                if ($status == "accepted") {
                    // Increase the blood stock
                    $update_stock = $conn->prepare("UPDATE blood_stock SET units = units + ? WHERE bloodgroup = ?");
                    $update_stock->bind_param("is", $units_donated, $bloodgroup);
                    $update_stock->execute();

                    echo '<div class="alert alert-success" role="alert">
                        Donation request accepted, and blood stock updated!
                        </div>';
                } else if ($status == 'rejected') {
                    echo '<div class="alert alert-danger" role="alert">
                        Donation request rejected!
                        </div>';
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Donation request failed!
            </div>';
        }
    }
    ?>
            <?php
            // Fetch donation requests from the database
            $qery = $conn->prepare("SELECT donation_id, username, blood_group, units, disease, donated_date, phone_number, status 
                                    FROM user 
                                    JOIN donation ON user.user_id = donation.user_id");
            $qery->execute();
            $result = $qery->get_result();

            // Loop through each donation request

            if ($result->num_rows > 0) {
              echo ' <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Donation ID</th>
                        <th>Username</th>
                        <th>Blood Group</th>
                        <th>Units</th>
                        <th>Disease</th>
                        <th>Date</th>
                        <th>Phone Number</th>
                        <th>Status Requests</th>
                    </tr>
                </thead>';
            while ($donor = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $donor['donation_id']; ?></td>
                    <td><?php echo $donor['username']; ?></td>
                    <td><?php echo $donor['blood_group']; ?></td>
                    <td><?php echo $donor['units']; ?></td>
                    <td><?php echo $donor['disease']; ?></td>
                    <td><?php echo $donor['donated_date']; ?></td>
                    <td><?php echo $donor['phone_number']; ?></td>
                    <td>
                        <?php if ($donor['status'] == 'accepted' || $donor['status'] == 'rejected') { ?>
                            <span><?php echo $donor['status']; ?></span>
                        <?php } else { ?>
                            <form action="donation_requests.php" method="post" style="display:inline;">
                                <input type="hidden" name="donation_id" value="<?php echo $donor['donation_id']; ?>">
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" name="submit" class="btn btn-outline-success btn-sm">Accept</button>
                            </form>
                            <form action="donation_requests.php" method="post" style="display:inline;">
                                <input type="hidden" name="donation_id" value="<?php echo $donor['donation_id']; ?>">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" name="submit" class="btn btn-outline-danger btn-sm mx-2">Reject</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<div class="alert alert-primary" role="alert">
                    No donations found!
            </div>';

        }

            // Close the statement
            $qery->close();
            ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
