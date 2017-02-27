<?php

if(isset($_POST['create_user'])){
    $new_username = $_POST['new_username'];
    $new_user_password = $_POST['new_user_password'];
    $new_user_firstname = $_POST['new_user_firstname'];
    $new_user_lastname = $_POST['new_user_lastname'];
    $new_user_email = $_POST['new_user_email'];
    $new_user_role = $_POST['new_user_role'];
    $new_user_date = date('y-m-d');

    $query = "INSERT INTO ";
    $query .= "users(username, user_password, user_firstname, user_lastname, user_email, user_role, user_date) ";
    $query .= "VALUES('{$new_username}', '{$new_user_password}', '{$new_user_firstname}', '{$new_user_lastname}', '{$new_user_email}', '{$new_user_role}', '{$new_user_date}')";

    $add_user_query = mysqli_query($connection, $query);

    if(!$add_user_query){
        die("QUERY FAIL: " . mysqli_error($connection));
    }

}

?>

<form action="" method = "post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="new_username">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="new_user_password">
    </div>

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="new_user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="new_user_lastname">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="new_user_email">
    </div>

    <div class="form-group">
        <label for="role">Role</label><br>
        <select style="height: 30px" name="new_user_role">
            <option value='subscriber'>Select an option</option>
            <option value='subscriber'>Subscriber</option>
            <option value='admin'>Admin</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>

</form>