<?php include_once("include/header.php")?>

<br><br><br><br><br><br><br>

<div class="container" style="width: 500px;">
    <h3>Login Form</h3><br>
    <form method="post" action="login_check.php"> 

        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Enter username" name="username">  
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>    
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="register.php">Register</a>
    </form>
</div>

<?php include_once("include/footer.php")?>
