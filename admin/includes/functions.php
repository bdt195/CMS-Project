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

function delete_comment($id){
    global $connection;
    $comment_id = $id;

    $query = "SELECT comment_post_id FROM comments WHERE comment_id={$comment_id}";
    $select_post_id_query = mysqli_query($connection, $query);
    $post_id = mysqli_fetch_assoc($select_post_id_query)['comment_post_id'];

    $query = "DELETE FROM comments WHERE comment_id={$comment_id}";
    $delete_query = mysqli_query($connection, $query);
    if(!$delete_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }

    $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id={$post_id}";
    $update_query = mysqli_query($connection, $query);
    if(!$update_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }

    header('Location: comments.php');
}

function approve_comment($id){
    global $connection;
    $comment_id = $id;

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id={$comment_id}";
    $update_query = mysqli_query($connection, $query);
    if(!$update_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }

    header('Location: comments.php');
}

function unapprove_comment($id){
    global $connection;
    $comment_id = $id;

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id={$comment_id}";
    $update_query = mysqli_query($connection, $query);
    if(!$update_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }

    header('Location: comments.php');
}

function delete_user($user_id){
    global $connection;
    $query = "DELETE FROM users WHERE user_id={$user_id}";
    $delete_query = mysqli_query($connection, $query);
    if(!$delete_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
    header('Location: users.php');
}

?>