<?php include('header.php'); ?>

<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>

<?php include('database.php'); ?>

<div class="container">
    <h1>Donation History</h1>
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
                    <td><?php echo $donor['status']; ?></td>
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
