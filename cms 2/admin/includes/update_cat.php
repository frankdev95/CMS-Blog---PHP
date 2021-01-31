
<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php 
        if(isset($_GET['edit'])) {
            
            $cat_id = escape($_GET['edit']);
            $cat_query = mysqli_query($connection, "SELECT * FROM categories WHERE cat_id = $cat_id");
            show_error($cat_query);
            
            while($row = mysqli_fetch_assoc($cat_query)) {
                $cat_title = $row['cat_title']; 

                echo "<input class='form-control' value='$cat_title' type='text' name='cat_title'</input>";
            }

        } 

        if(isset($_POST['update_cat'])) {
            
            $cat_title = escape($_POST['cat_title']);
            $cat_query = mysqli_query($connection, "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id;");
            show_error($cat_query);
        }
        
        ?>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="update_cat">Edit Category</button>
    </div>
</form>
