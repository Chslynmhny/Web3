<?php include_once("include/header.php")?>

<br><br><br><br><br><br><br>

<div class="container" style="width: 500px;">
    <h3>Registration Form</h3><br>
    <form method="post" action="registration_save.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Full Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Full Name" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>
        <?php
        // Calculate age based on Date of Birth
        if (isset($_POST['dob'])) {
            $dob = new DateTime($_POST['dob']);
            $currentDate = new DateTime();
            $age = $currentDate->diff($dob)->y;
        } else {
            $age = ""; // Default value if DOB is not provided
        }
        ?>
        <!-- <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>" readonly>
        </div> -->
       
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once("include/footer.php")?>
