<?php include('header.php');?>

<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>

<?php include('database.php');?>
<div class="container">
    <h1>Donation history</h1>
   <table class="table">
     <thead>
         <tr>
             <th>Units</th>
             <th>Disease</th>
             <th>date</th>
             <th>Status requests</th>
         </tr>
     </thead>
     <?php
        if (isset($_SESSION['user_id'])) { // Check if user_id is set in the session
            $user_id = $_SESSION['user_id'];
            $qery = $conn->prepare("SELECT units, disease, donated_date, status FROM donation WHERE user_id = ?");
            $qery->bind_param("s", $user_id);
            $qery->execute();

            // Store the result
            $result = $qery->get_result();

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['units']; ?></td>
                        <td><?php echo $row['disease']; ?></td>
                        <td><?php echo $row['donated_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<div class="alert alert-primary" role="alert">
                    No donations found!!... add one ..
            </div>';
            }

            // Close the statement
            $qery->close();
        } 
        ?>
    </table>
  </div>
  <?php include('footer.php');?>