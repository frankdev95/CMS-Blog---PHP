<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input type="text" name="search" class="form-control">
            <span class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-default" >
                <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        </form> <!-- form end -->
        <!-- /.input-group -->
    </div>
    
    <!-- Login  -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/markup/login.php" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Login</button>
            </span>
        </div>
        </form> <!-- form end -->
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
        
                    <?php 
                
                    $cat_query = mysqli_query($connection, "SELECT * FROM categories");
                    show_error($cat_query);
                    
                    while($row = mysqli_fetch_assoc($cat_query)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                    }
                    ?> 
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>
</div>
</div>