<?php include "includes/db.php"; ?>
<?php include "includes/markup/header.php"; ?>

<!-- Navigation -->

<?php include "includes/markup/nav.php"; ?>

<?php 

if(isset($_POST['submit'])) {
    
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
        
        $username = escape($_POST['username']);
        $password = escape($_POST['password']);
        $email = escape($_POST['email']);

        $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
        
        $user_query = mysqli_query($connection, "INSERT INTO users (username, user_email, user_password, role) VALUES ('$username', '$email', '$password', 'Subscriber' )"); 
        show_error($user_query);   
        
        $message = "Your Registration has been Submitted!";
        
    } else {
        $message = "Fields cannot be empty";
    }
} else {
    $message = '';
}

?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h5 class="text-center"><?php echo $message ?></h5>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div>
                <!-- /.col-xs-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/markup/footer.php";?>