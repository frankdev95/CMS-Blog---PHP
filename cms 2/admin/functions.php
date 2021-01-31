<?php 

function show_error($query) { 
    
    global $connection;
    if(!$query) {
        die("Query Failed " . mysqli_error($connection));
    }
}


function insert_categories() {
    
    global $connection;
    
    if(isset($_POST['submit'])) {
        $title = escape($_POST['cat_title']);
        if($title === "" || empty($title)) {
           // echo "Please input some text.";
        } else {
            $query = mysqli_query($connection, "INSERT INTO categories (cat_title) VALUE ('$title')");
            if(!$query) {
                die("Query failed." . " " . mysqli_error());
            }
        }
    }
}

function update_categories() {
    
    global $connection;
     
    if(isset($_GET['edit'])) {
         $cat_id = ($_GET['edit']);
         include "includes/update_cat.php";
     } 
}

function select_all() {
    
    global $connection;
    $cat_query = mysqli_query($connection, "SELECT * FROM categories"); 
    show_error($cat_query);

    while($row = mysqli_fetch_assoc($cat_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>
              <td>$cat_id</td>
              <td>$cat_title</td>
              <td><a href='categories.php?edit=$cat_id'>Edit</a></td>
              <td><a href='categories.php?delete=$cat_id'>Delete</a></td>
              </tr>";
    }
}

function delete_cat() {
    
    global $connection;
    
    if(isset($_GET['delete'])) {
        
        $cat_id = escape($_GET['delete']);
        $cat_query = mysqli_query($connection, "DELETE FROM categories WHERE cat_id = $cat_id");
        show_error($cat_query);
        header("Location: categories.php");
    }
}

function users_online() {

    if(isset($_GET['onlineUsers'])) {

        global $connection;
        
        if(!$connection) {
            session_start();
            include("includes/db_admin.php");
        }
        
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;

        $online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE session = '$session'");
        $online_count = mysqli_num_rows($online_query);

        if($online_count == NULL) {
            mysqli_query($connection, "INSERT INTO users_online (session, time) VALUES ('$session', $time)");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = $time WHERE session = '$session'");
        }

        $users_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > $time_out");
        echo $users_online = mysqli_num_rows($users_query);
    }
}

users_online();

function escape($string) {
    
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

?>