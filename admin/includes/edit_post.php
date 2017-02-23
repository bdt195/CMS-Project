<?php

$post_id = $_GET['id'];
$query = "SELECT * FROM posts WHERE post_id = {$post_id}";
$edit_query = mysqli_query($connection, $query);

if(!$edit_query){
    die("QUERY FAILED: " . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($edit_query);
$post_title = $row['post_title'];
$post_cat_id = $row['post_category_id'];
$post_author = $row['post_author'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_tags = $row['post_tags'];
$post_content = $row['post_content'];

?>

<form action="" method = "post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select style="height: 30px" name="post_category_id">
            <?php

            $query = "SELECT * FROM categories";
            $select_cat_query = mysqli_query($connection, $query);

            if(!$select_cat_query){
                die("QUERY FAILED: " . mysqli_error($connection));
            }

            while($cat_set = mysqli_fetch_assoc($select_cat_query)){
                $cat_id = $cat_set['cat_id'];
                $cat_title = $cat_set['cat_title'];
                if($cat_id == $post_cat_id) echo "<option value='$cat_id' selected ?> $cat_title</option>";
                else echo "<option value='$cat_id' ?> $cat_title</option>";
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status ?>">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img width="150" src="../images/<?php echo $row['post_image']; ?>" alt="<?php echo $post_image; ?>" />
        <br><br>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Publish Post">
    </div>

</form>

<?php

if(isset($_POST['edit_post'])){
    $new_post_title = $_POST['post_title'];
    $new_post_cat_id = $_POST['post_category_id'];
    $new_post_author = $_POST['post_author'];
    $new_post_status = $_POST['post_status'];
    $new_post_image = $_FILES['image']['name'];
    $new_post_image_temp = $_FILES['image']['tmp_name'];
    $new_post_tags = $_POST['post_tags'];
    $new_post_date = date('y-m-d');
    $new_post_content = $_POST['post_content'];
    if(empty($new_post_image)) {
        $query = "UPDATE posts SET ";
        $query .= "post_title = '$new_post_title', ";
        $query .= "post_category_id = '$new_post_cat_id', ";
        $query .= "post_author = '$new_post_author', ";
        $query .= "post_status = '$new_post_status', ";
        $query .= "post_tags = '$new_post_tags', ";
        $query .= "post_content = '$new_post_content', ";
        $query .= "post_date = '$new_post_date' ";
        $query .= "WHERE post_id = $post_id";
        $edit_post_query = mysqli_query($connection, $query);
        if(!$edit_post_query){
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("Location: posts.php");
    } else {
        move_uploaded_file($new_post_image_temp, "../images/$new_post_image");
        $query = "UPDATE posts SET ";
        $query .= "post_title = '$new_post_title', ";
        $query .= "post_category_id = '$new_post_cat_id', ";
        $query .= "post_author = '$new_post_author', ";
        $query .= "post_status = '$new_post_status', ";
        $query .= "post_tags = '$new_post_tags', ";
        $query .= "post_image = '$new_post_image', ";
        $query .= "post_content = '$new_post_content', ";
        $query .= "post_date = '$new_post_date' ";
        $query .= "WHERE post_id = $post_id";
        $edit_post_query = mysqli_query($connection, $query);
        if(!$edit_post_query){
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("Location: posts.php");
    }

}
?>