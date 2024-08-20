<?php include('header.php');?>

<?php
if(empty($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
?>

<?php
    include('database.php');
    if(isset($_POST['submit'])){
        $units = $_POST['units'];
        $reason = $_POST['reason'];
        $requesteddate = $_POST['requested_date'];
        $userid = $_SESSION["user_id"];
        $query = mysqli_query($conn, "INSERT INTO patient_requests(user_id, units, reason, requested_date) VALUES('$userid', '$units', '$reason', '$requesteddate')");

        if($query){
            echo '<div class="alert alert-success" role="alert">
            Patient request successful!
            </div>';
        } else{
            echo '<div class="alert alert-danger" role="alert">
            Patient request failed!
            </div>';
        }
    }
?>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-3">
            <h3 class="text-center">Request Blood</h3>
            <form class="g-3 mb-3" action="patientform.php" method="post">
                <div class="mb-3">
                    <label for="units" class="form-label">Units of Blood (in ml)</label>
                    <input type="number" class="form-control" id="units" name="units" required>
                </div>
                <div class="mb-3">
                    <label for="reason" class="form-label">Reason</label>
                    <input type="text" class="form-control" id="reason" name="reason" required>
                </div>
                <div class="mb-3">
                    <label for="requested_date" class="form-label">Requested Date</label>
                    <input type="date" class="form-control" id="requested_date" name="requested_date" min="2024-01-01" required>
                </div>
                <div class="d-grid">
                    <button class="btn btn-danger" name="submit" type="submit">Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php include('footer.php');?>
