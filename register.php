<?php include('header.php')?>
<?php
    include('database.php');
    if(isset($_POST['submit'])){
        $username = $_POST['Username'];
        $password = $_POST['password'];
        $phonenumber = $_POST['phone_number'];
        $bloodgroup = $_POST['blood_group'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];

        $qery = mysqli_query($conn ,"INSERT into user(username,password,phone_number,blood_group,dob,address,city,state,pin_code) VALUES('$username','$password','$phonenumber','$bloodgroup','$dob','$address','$city','$state','$pincode')");

        if($qery){
            echo "<script>alert('registration sucessful')</script>";
        } else{
            echo "<script>alert('error')</script>";
        }

    }
?>
<div class="container justify-content-center align-items-center min-vh-100 mt-5 col-lg-3">
    <form class="row g-3" action="register.php" method="post">
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Username</label>
          <input type="text" class="form-control" id="inputEmail4" name="Username">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="form-control" id="inputPassword4" name="password">
        </div>

        <div class="col-12">
          <label for="inputPhone" class="form-label">Phone</label>
          <input type="text" class="form-control" id="inputPhone" placeholder="" name="phone_number">
        </div>

        <div class="col-md-6">
          <label for="inputDOB" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="inputDOB" name="dob">
        </div>
        <div class="col-md-6">
          <label for="inputBloodGroup" class="form-label">Blood Group</label>
          <select id="inputBloodGroup" name="blood_group" class="form-select">
            <option value="" disabled selected>blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
          </select>
        </div>

        <div class="col-12">
          <label for="inputAddress" class="form-label">Address</label>
          <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
        </div>

        <div class="col-md-6">
          <label for="inputCity" class="form-label">City</label>
          <input type="text" class="form-control" id="inputCity" name="city">
        </div>
        <div class="col-md-6">
          <label for="inputState" class="form-label">State</label>
          <select id="inputState" name="state" class="form-select">
            <option value="">Select a State</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select>
          </select>
        </div>

        <div class="col-md-12">
          <label for="inputZip" class="form-label">Pincode</label>
          <input type="text" class="form-control" id="inputZip" name="pincode">
        </div>

        <div class="col-12">
            <button type="submit" name="submit"  class="btn btn-primary bg-danger">Register</button>
          </div>
          
      </form>
</div>



<?php include('footer.php'); ?>