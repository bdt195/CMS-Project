<?php

if(isset($_POST['create_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('y-m-d');
    $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO ";
    $query .= "posts(post_title, post_author, post_category_id,post_status, post_image, post_tags, post_content, post_date, post_comment_count) ";
    $query .= "VALUES('{$post_title}', '{$post_author}', '{$post_category_id}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', '{$post_date}', '{$post_comment_count}')";

    $add_post_query = mysqli_query($connection, $query);

    if(!$add_post_query){
        die("QUERY FAIL: " . mysqli_error($connection));
    }

}

?>

<form action="" method = "post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
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
                echo "<option value='$cat_id' ?> $cat_title</option>";
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <script src="js/init-editor.js"></script>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>