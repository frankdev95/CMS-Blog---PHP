<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
               
               <?php 
                $cat_query = mysqli_query($connection, "SELECT * FROM categories");
                
                show_error($cat_query);
                
                while($row = mysqli_fetch_assoc($cat_query)) {
                    $cat_title = $row['cat_title'];
                    echo "<li><a href='#'>$cat_title</li>";
                }
                    
                echo "<li><a href='admin'>Admin</a></li>";
                echo "<li><a href='registration.php'>Register</a></li>";
                
                
                if(isset($_SESSION['username'])) {
                    if(isset($_GET['post_id'])) {
                        
                        $post_id = escape($_GET['post_id']);
                        echo "<li><a href='../cms/admin/posts.php?source=edit_post&edit=$post_id'>Edit Post</a></li>";
                    }
                }
                ?> 
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
