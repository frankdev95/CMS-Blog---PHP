<?php include "../db.php"; ?>
<?php session_start(); ?>


<?php 

if(isset($_POST['login'])) {
    
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
    
    $query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
    show_error($query);
    
    while($row = mysqli_fetch_assoc($query)) {
        
        $user_id = $row['user_id'];
        $db_username = $row['username'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_role = $row['role'];
    }
    
    if(password_verify($password, $user_password)) {
        
        $_SESSION['username'] = $db_username;
        $_SESSION['first_name'] = $user_first_name;
        $_SESSION['last_name'] = $user_last_name;
        $_SESSION['role'] = $user_role;
        
        header("Location: ../../admin/index.php");
    } else {
        header("Location: ../../index.php");
    }

}

?>