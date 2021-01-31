<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/markup/header.php"; ?>
<?php include "includes/markup/nav.php"; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

       
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- First Blog Post -->
            <?php

             if(isset($_GET['post_id'])) {
                 
                 $post_id = escape($_GET['post_id']);
                 
                 $views_query = mysqli_query($connection, "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $post_id");
                 
                 $select_query = mysqli_query($connection, "SELECT * FROM posts WHERE post_id = $post_id");
                 
                 show_error($select_query);

                 while($row = mysqli_fetch_assoc($select_query)) {
                     $post_title = $row['post_title'];
                     
                     $post_author = $row['post_author'];
                     
                     $user_query = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $post_author");
                     show_error($user_query);
                     
                     while($user_row = mysqli_fetch_assoc($user_query)) {
                         $user_first_name = $user_row['user_first_name'];
                         $user_last_name = $user_row['user_last_name'];
                         $username = $user_row['username'];
                         if(!empty($user_first_name)) {
                             $name = $user_first_name . " " . $user_last_name;     
                         } else {
                             $name = $username;
                         }
                     }
                     
                     $post_date = $row['post_date'];
                     $post_img = $row['post_img'];
                     $post_content = $row['post_content'];
                     $post_tags = $row['post_tags'];
                 }
            ?>
            <h1>    
                <?php echo "<a href='post.php?post_id=$post_id'>$post_title</a>"; ?>
            </h1>
            <p class="lead">
                <?php echo "by <a href='author_post.php?author=$post_author&post_id=$post_id'>$name</a>"; ?>
            </p>
            <p>
                Posted on August 28, 2013 at 10:00 PM
                <span class="glyphicon glyphicon-time"></span> 
            </p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="placeholders">
            <hr>
            <p>
                <?php echo $post_content; ?>    
            </p>
            <hr>
            <?php } else { header("Location: index.php"); } ?>
            <?php include "includes/markup/comments.php"; ?>
        </div>
<?php include "includes/markup/sidebar.php"; ?>
<?php include "includes/markup/footer.php"; ?>

