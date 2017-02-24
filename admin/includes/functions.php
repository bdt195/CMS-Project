<?php
function add_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
            $create_category_query = mysqli_query($connection, $query);
            if(!$create_category_query){
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete<a></a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit<a></a></td>";
        echo "</tr>";
    }
}

function delete_categories(){
    global $connection;
    if(isset($_GET['delete'])){
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id={$cat_id}";
        $delete_query = mysqli_query($connection, $query);
        if(!$delete_query){
            die('QUERY FAILED' . mysqli_error($connection));
        }
        header("Location: categories.php");
    }
}

function delete_posts(){
    global $connection;
    $post_id = $_GET['id'];
    $query = "DELETE FROM posts WHERE post_id={$post_id}";
    $delete_query = mysqli_query($connection, $query);
    if(!$delete_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
    header('Location: posts.php');
}

function delete_comments(){
    global $connection;
    $comment_id = $_GET['id'];
    $query = "DELETE FROM comments WHERE comment_id={$comment_id}";
    $delete_query = mysqli_query($connection, $query);
    if(!$delete_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
    header('Location: comments.php');
}

?>