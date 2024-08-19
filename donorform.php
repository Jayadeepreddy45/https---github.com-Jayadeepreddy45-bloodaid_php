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
        $Disease = $_POST['disease'];
        $Donateddate = $_POST['donated_date'];
        $userid = $_SESSION["user_id"];
        $qery = mysqli_query($conn ,"INSERT into donation(user_id,units,disease,donated_date) VALUES($userid,'$units','$Disease','$Donateddate')");

        if($qery){
            echo '<div class="alert alert-success" role="alert">
            Donation request sucessful!
            </div>';

        } else{
            echo  '<div class="alert alert-danger" role="alert">
            Donation request failed!
            </div>';
        }

    }
    ?>

<div class="container">

  <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-3">
          <h3 style="text-align: center;"> Donote blood</h3>
            <form class="g-3 mb-3" action="donorform.php" method="post">

                <div class="mb-3">
                    <label for="units" class="form-label">Units of blood (in ml)</label>
                    <input type="number" class="form-control" id="units" name="units" required>
                </div>
                <div class="mb-3">
                    <label for="disease" class="form-label">Disease if any</label>
                    <input type="text" class="form-control" id="disease" name="disease" required>
                </div>
                <div class="mb-3">
                    <label for="donated-date" class="form-label">Donated date</label>
                    <input type="date" class="form-control" id="donated-date" name="donated_date" required>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary bg-danger" name="submit" type="submit">Donate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php include('footer.php');?>
