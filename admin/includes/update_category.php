<form action="categories.php" method="POST">
    <div class="form-group">
        <?php
        if(isset($_GET['edit'])){
            echo "<label for='cat_title'>Edit Category</label>";
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
            $select_category = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_category)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            }
            ?>

            <input class="form-control" type="text" name="cat_title" value="<?php if(isset($cat_title)) echo $cat_title; ?>" >

        <?php } ?>

    </div>

    <div class="form-group">
        <?php

        if(isset($_GET['edit']))
            echo "<input type='hidden' name='cat_id' value='{$cat_id}'>";

        ?>
    </div>

    <div class="form-group">
        <?php

        if(isset($_GET['edit']))
            echo "<input class='btn btn-primary' type='submit' name='update' value='Update Category'>";

        ?>
    </div>

    <?php

    if(isset($_POST['update'])){

        $cat_title = $_POST['cat_title'];
        $cat_id = $_POST['cat_id'];
        $query = "UPDATE categories SET cat_title='{$cat_title}' WHERE cat_id={$cat_id}";
        echo $query;
        $update_query = mysqli_query($connection, $query);
        if(!$update_query){
            die('QUERY FAILED' . mysqli_error($connection));
        }
        header("Location: categories.php");
    }

    ?>

</form>