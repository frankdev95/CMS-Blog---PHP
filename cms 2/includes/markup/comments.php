 <?php
            
if(isset($_POST['create_comment'])) {
    
    $post_id = escape($_GET['post_id']);
    $comment_author = escape($_POST['comment_author']);
    $comment_email = escape($_POST['comment_email']);
    $comment_content = escape($_POST['comment_content']);
    
    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ) {
        $comment_query = mysqli_query($connection, "INSERT INTO comments (comment_post_id, comment_author, comment_content, comment_email, comment_status, comment_date) VALUES ($post_id, '$comment_author', '$comment_content', '$comment_email', 'Refused', now())");
        show_error($comment_query);
        
        $post_comment_count_query = mysqli_query($connection, "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id");
    } else {
        echo "<script>alert('Fields cannot be empty');</script>";
    }

    
}

?>
<!-- Blog Comments -->

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form action="" method="post">
        <div class="form-group">
            <label for="author">Author</label>
            <input id="author" class="form-control" type="text" name="comment_author">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="comment_email">
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea id="comment" class="form-control" rows="3" name="comment_content"></textarea>
        </div>
        <button type="submit" name="create_comment" class="btn btn-primary">Submit Comment</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->

<!-- Comment -->

<?php 

$post_id = escape($_GET['post_id']);

$comment_query = mysqli_query($connection, "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'Approved' ORDER BY comment_id DESC");

show_error($comment_query);

while($row = mysqli_fetch_assoc($comment_query)) {
    $comment_date = $row['comment_date'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content']; ?>
    
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?php echo $comment_author ?>
            <small><?php echo $comment_date; ?></small>
        </h4>
        <p>
        <?php echo $comment_content; ?>
        </p>
    </div>
</div>

<?php } ?>
