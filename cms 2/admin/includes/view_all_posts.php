<?php 

if(isset($_GET['delete'])) {
    
    $post_id = escape($_GET['delete']);
    
    if(isset($_SESSION['role'])) {
        if($_SESSION['role'] === 'Admin') {
            $query = mysqli_query($connection, "DELETE FROM posts WHERE post_id = $post_id");
            show_error($query);
            header("Location: posts.php");
        }
    }
}

if(isset($_GET['reset'])) {
    
    $post_id = escape($_GET['reset']);
    
    if(isset($_SESSION['role'])) {
        if($_SESSION['role'] === 'Admin') {
            $query = mysqli_query($connection, "UPDATE posts SET post_view_count = 0 WHERE post_id = $post_id");
            show_error($query);
            header("Location: posts.php");
        }
    }
}
?>

<?php 

if(isset($_POST['checkBoxArray'])) {
        
    $box_array = $_POST['checkBoxArray'];
    $bulk_options = escape($_POST['bulk_options']);

    foreach($box_array as $posts) {        
        switch($bulk_options) {
            case 'publish':
                $post_query = mysqli_query($connection, "UPDATE posts SET post_status = 'Published' WHERE post_id = $posts" );
                
                show_error($post_query);
                break;
            case 'draft': 
                $post_query = mysqli_query($connection, "UPDATE posts SET post_status = 'Draft' WHERE post_id = $posts" );
                
                show_error($post_query);
                break;
            case 'delete':
                $post_query = mysqli_query($connection, "DELETE FROM posts WHERE post_id = $posts" );
                
                show_error($post_query);
                
                header("Location: posts.php");
                break;
            case 'clone':
                $post_query = mysqli_query($connection, "SELECT * FROM posts WHERE post_id = $posts" );
                show_error($post_query);
                
                while($row = mysqli_fetch_assoc($post_query)) {
                    $cat_id = $row['post_category_id'];
                    $title = $row['post_title'];
                    $author = $row['post_author'];
                    $image = $row['post_img'];
                    $content = $row['post_content'];
                    $tags = $row['post_tags'];
                    $status = $row['post_status'];
                }
                
                $insert_post_query = mysqli_query($connection, "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) VALUES ($cat_id, '$title', '$author', now(), '$image', '$content', '$tags', '$status')");
                show_error($insert_post_query);
                
                header("Location: posts.php");
                break;
            default:
                echo "Please select an option.";
                break;
        }
    }
}

?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-2">
            <select class="form-control post-options" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col_xs_4">
            <input class="btn btn-success apply-btn" type="submit" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Category</th>
                <th>Title</th>
                <th>User</th>
                <th>Date</th>
                <th>Image</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Status</th>
                <th>Views</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $post_query = mysqli_query($connection, 'SELECT * FROM posts ORDER BY post_id DESC');
            show_error($post_query);

            while($row = mysqli_fetch_assoc($post_query)) {
                $post_id = $row['post_id'];
                $cat_id = $row['post_category_id'];
                $title = $row['post_title'];
                $author = $row['post_author'];
                
                $user_query = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $author");
                show_error($user_query);

                while($user_row = mysqli_fetch_assoc($user_query)) {
                    $user_id = $user_row['user_id'];
                    $username = $user_row['username'];
                }
                
                $date = $row['post_date'];
                $image = $row['post_img'];
                $content = $row['post_content'];
                $tags = $row['post_tags'];
                
                $comment_query = mysqli_query($connection, "SELECT * FROM comments WHERE comment_post_id = $post_id");
                show_error($comment_query);
                $comment_count = mysqli_num_rows($comment_query);
                    
                $status = $row['post_status'];
                $views = $row['post_view_count'];
                ?>
                <tr>
                <td>
                    <input class="checkBoxes" id="selectAllBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id ?>">
                </td>
                <?php 
                echo 
                   "<td>$post_id</td>";
                    

                    $cat_query = mysqli_query($connection, "SELECT * FROM categories WHERE cat_id = $cat_id");

                    show_error($cat_query);

                    while($row = mysqli_fetch_assoc($cat_query)) { 

                        $category = $row['cat_title'];

                        echo "<td>$category</td>";
                    }

               echo
                   "<td>$title</td>
                    <td><a href='users.php?source=edit_user&edit_user=$user_id'>$username</td>
                    <td>$date</td>
                    <td><img width='100' class='img-responsive' src='../images/$image'></td>
                    <td>$content</td>
                    <td>$tags</td>
                    <td><a href='comments.php?source=view_post_comments&comment_post_id=$post_id&post_title=$title'>$comment_count</a></td>
                    <td>$status</td>
                    <td><a href='posts.php?reset=$post_id'>$views</a></td>
                    <td><a href='../post.php?post_id=$post_id'>View</a></td>
                    <td><a href='posts.php?source=edit_post&edit=$post_id'>Edit</a></td>
                    <td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete=$post_id'>Delete</a></td>
                </tr>";
            }
            ?>    
        </tbody>
    </table>
</form>