<?php include('header.php');?>
<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>
<?php include('database.php');?>
<div class="container">
    <h1>REQUEST LIST </h1>
   
     <?php
        if (isset($_SESSION['user_id'])) { // Check if user_id is set in the session
            $user_id = $_SESSION['user_id'];
            $qery = $conn->prepare("SELECT units, reason, requested_date, status FROM patient_request WHERE user_id = ?");
            $qery->bind_param("s", $user_id);
            $qery->execute();

            // Store the result
            $result = $qery->get_result();

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                echo '<table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Units</th>
                            <th>Reason</th>
                            <th>date</th>
                            <th>Status requests</th>
                        </tr>
                    </thead>';
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['units']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><?php echo $row['requested_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<div class="alert alert-primary" role="alert">
                No requests made !.. add one
                </div>';
            }

            // Close the statement
            $qery->close();
        } else {
            echo '<div class="alert alert-success" role="alert">
            user not logged in!!
            </div>';
        }
        ?>
    </table>
  </div>
  <?php include('footer.php');?>