<?php

if(isset($_POST['checkBoxArray'])){
    $option = $_POST['option'];
    switch($option){
        case 'draft' :
            foreach($_POST['checkBoxArray'] as $checkBoxValue){
                $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $checkBoxValue";
                mysqli_query($connection, $query);
            }
            break;

        case 'publish' :
            foreach($_POST['checkBoxArray'] as $checkBoxValue){
                $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $checkBoxValue";
                mysqli_query($connection, $query);
            }
            break;

        case 'delete' :
            foreach($_POST['checkBoxArray'] as $checkBoxValue){
                $query = "DELETE * FROM posts WHERE post_id = $checkBoxValue";
                mysqli_query($connection, $query);
            }
            break;
    }
}
?>
<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="OptionContainer" class="col-xs-4">
            <select name="option" class="form-control" id="">
                <option value="">Select Option</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        
        <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment = $row['post_comment_count'];
            $post_date = $row['post_date'];

            //
            $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
            $select_category_id = mysqli_query($connection, $query);
            $post_category_title = mysqli_fetch_assoc($select_category_id)['cat_title'];

            echo "<tr>";
            echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='{$post_id}'></td>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";
            echo "<td>{$post_category_title}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img class='img-responsive' width='100' src='../images/$post_image' alt='$post_image'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='posts.php?source=edit&id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?source=delete&id={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }

        ?>

        </tbody>
    </table>
</form>