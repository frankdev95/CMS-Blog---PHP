<?php include "includes/db.php"; ?>
<?php include "includes/markup/header.php"; ?>
<?php include "includes/markup/nav.php"; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

       
        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- Categories Blog Post -->
            <?php

             if(isset($_GET['category'])) {
                 $cat_id = escape($_GET['category']);
                 $query = mysqli_query($connection, "SELECT * FROM posts WHERE post_category_id = $cat_id");
             }
                
                 
             while($row = mysqli_fetch_assoc($query)) {
                 $post_id = $row['post_id'];
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
                 $post_content = substr($row['post_content'], 0,200);
                 $post_tags = $row['post_tags'];
            ?>
            <h2>    
            <?php echo "<a href='post.php?post_id=$post_id'>$post_title</a>"; ?>
            
            </h2>
            <p class="lead">
               
            <?php echo "by <a href='author_post.php?author=$post_author'>$name</a>"; ?>
                
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="placeholders">
            <hr>
            
            <?php echo "<p>$post_content</p>"; ?>
            
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
            <?php } ?>
        </div>
<?php include "includes/markup/sidebar.php"; ?>
<?php include "includes/markup/footer.php"; ?>

