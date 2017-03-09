<?php

$user_id = $_GET['edit'];
$query = "SELECT * FROM users WHERE user_id = {$user_id}";
$select_user_query = mysqli_query($connection, $query);

if(!$select_user_query){
    die("QUERY FAILED: " . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($select_user_query);
$username = $row['username'];
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
$user_email = $row['user_email'];
$user_role = $row['user_role'];

?>

<form action="" method = "post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="new_username" value="<?php echo $username ?>">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="new_user_password">
    </div>

    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" name="new_user_firstname" value="<?php echo $user_firstname ?>">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="new_user_lastname" value="<?php echo $user_lastname ?>">
    </div>

<!--    TODO Edit image-->
<!--    <div class="form-group">-->
<!--        <label for="post_image">Post Image</label><br>-->
<!--        <img width="150" src="../images/--><?php //echo $row['post_image']; ?><!--" alt="--><?php //echo $post_image; ?><!--" />-->
<!--        <br><br>-->
<!--        <input type="file" name="image">-->
<!--    </div>-->

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="new_user_email" value="<?php echo $user_email ?>">
    </div>

    <div class="form-group">
        <label for="role">Role</label><br>
        <select style="height: 30px" name="new_user_role">
            <option value='subscriber' <?php if($user_role == 'subscriber') echo 'selected'; ?> >Subscriber</option>
            <option value='admin' <?php if($user_role == 'admin') echo 'selected'; ?> >Admin</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit_edit_user" value="Edit User">
    </div>

</form>

<?php

if(isset($_POST['submit_edit_user'])){
    $new_username = $_POST['new_username'];
    $new_user_password = $_POST['new_user_password'];
    $new_user_firstname = $_POST['new_user_firstname'];
    $new_user_lastname = $_POST['new_user_lastname'];
    $new_user_email = $_POST['new_user_email'];
    $new_user_role = $_POST['new_user_role'];

    $query = "UPDATE users SET ";
    $query .= "username = '$new_username', ";
    $query .= "user_password = '$new_user_password', ";
    $query .= "user_firstname = '$new_user_firstname', ";
    $query .= "user_lastname = '$new_user_lastname', ";
    $query .= "user_email = '$new_user_email', ";
    $query .= "user_role = '$new_user_role' ";
    $query .= "WHERE user_id = $user_id";
    $edit_user_query = mysqli_query($connection, $query);
    if(!$edit_user_query){
        die("QUERY FAILED: " . mysqli_error($connection));
    }
    header("Location: users.php");
}

?>