<?php include('header.php'); ?>

<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>

<?php include('database.php'); ?>

<div class="container">
    <h1>Donation Requests</h1>

    <?php
    // Flash messages
    // if (isset($_SESSION['flash_messages']) && !empty($_SESSION['flash_messages'])) {
    //     $message = $_SESSION['flash_messages'][0];
    //     echo '<div id="flash-message" class="alert alert-' . htmlspecialchars($message['category']) . '">';
    //     echo htmlspecialchars($message['message']);
    //     echo '</div>';
    //     // Clear the flash message after displaying it
    //     unset($_SESSION['flash_messages']);
    // }
    ?>

<?php
    if(isset($_POST['submit'])){
    
        $donation_id = $_POST["donation_id"];
        $status =$_POST["status"];
        $update_query=mysqli_query($conn,"UPDATE donation  SET status = '$status' WHERE donation_id = $donation_id");
                // cur.execute("SELECT donation.units,user.blood_group,blood_stock.units from donation inner join user on user.user_id = donation.user_id join blood_stock on blood_stock.bloodgroup = user.blood_group where donation_id = %s",[donation_id])
        // $query = mysqli_query($conn,"SELECT donation.units,user.blood_group,blood_stock.units from donation inner join user on user.user_id = donation.user_id join blood_stock on blood_stock.bloodgroup = user.blood_group where donation_id = ",[donation_id])";
        if ($update_query) {
            $select_query = $conn->prepare("SELECT donation.units,user.blood_group,blood_stock.units from donation inner join user on user.user_id = donation.user_id join blood_stock on blood_stock.bloodgroup = user.blood_group where donation_id =  ?");
            $select_query->bind_param("s", $donation_id);
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
                    Donation request accepted!
                    </div>';
            } else if ($status == 'rejected') {

                echo '<div class="alert alert-danger" role="alert">
                        Donation request rejected!
                        </div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Donation request failed!
            </div>';
        }
    }
?>

    <table class="table">
        <thead>
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
        </thead>
        <tbody>
            <?php
            // Fetch donation requests from the database
            $qery = $conn->prepare("SELECT donation_id,username, blood_group, units, disease, donated_date, phone_number,status FROM user JOIN donation ON user.user_id = donation.user_id");
            $qery->execute();
            $result = $qery->get_result();

            // Loop through each donation request
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

            // Close the statement
            $qery->close();
            ?>
        </tbody>
    </table>
</div>


<?php include('footer.php'); ?>
