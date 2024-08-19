<?php include ('header.php'); ?>

<?php
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<?php include ('database.php'); ?>



<div class="container">
    <h1>Patients Requests</h1>
    <?php
    if (isset($_POST['submit'])) {

        $request_id = $_POST["request_id"];
        $status = $_POST["status"];
        $update_query = mysqli_query($conn, "UPDATE patient_requests  SET status = '$status' WHERE request_id = $request_id ");



        if ($update_query) {
            $select_query = $conn->prepare("SELECT patient_request.units,user.blood_group,blood_stock.units from patient_request inner join user on user.user_id = patient_request.user_id join blood_stock on blood_stock.bloodgroup = user.blood_group where request_id =  ?");
            $select_query->bind_param("s", $request_id);
            $select_query->execute();
            $result = $select_query->get_result();


    // Check if any rows were returned
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // $_SESSION["user_id"] = $row["user_id"];
                $bloodgroup = $row["blood_group"];
            }



            if ($status == "accepted") {
                echo '<div class="alert alert-success" role="alert">
                    Patient request accepted!
                    </div>';
            } else if ($status == 'rejected') {

                echo '<div class="alert alert-danger" role="alert">
                        Patient request rejected!
                        </div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Patient request failed!
            </div>';
        }
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>request id</th>
                <th>Username</th>
                <th>Blood Group</th>
                <th>Units</th>
                <th>Reason</th>
                <th>Date</th>
                <th>Phone Number</th>
                <th>Status Requests</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch donation requests from the database
            $qery = $conn->prepare("SELECT request_id,username, blood_group, units, reason, requested_date, phone_number,status FROM user JOIN patient_requests ON user.user_id = patient_requests.user_id");
            $qery->execute();
            $result = $qery->get_result();

            // Loop through each donation request
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
                    <td>
                        <?php if ($patient['status'] == 'accepted' || $patient['status'] == 'rejected') { ?>
                            <span><?php echo $patient['status']; ?></span>
                        <?php } else { ?>
                            <form action="patient_requests.php" method="post" style="display:inline;">
                                <input type="hidden" name="request_id" value="<?php echo $patient['request_id']; ?>">
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" name="submit" class="btn btn-outline-success btn-sm">Accept</button>
                            </form>
                            <form action="patient_requests.php" method="post" style="display:inline;">
                                <input type="hidden" name="request_id" value="<?php echo $patient['request_id']; ?>">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" name="submit" class="btn btn-outline-danger btn-sm mx-2">Reject</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }

            // Close the statement
            $qery->close();
            ?>
        </tbody>
    </table>
</div>


<?php include ('footer.php'); ?>