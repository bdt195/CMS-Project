<?php

include "includes/admin_header.php";

?>

    <div id="wrapper">

    <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin Page
                        <small></small>
                    </h1>

                    <div class="col-xs-6">

                        <?php

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

                        ?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title"\>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category"\>
                            </div>

                        </form>

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
                    </div><!-- Add category form-->

                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            // FIND ALL CATEGORIES QUERY
                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_assoc($select_categories)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                                echo "<tr>";
                                echo "<td>{$cat_id}</td>";
                                echo "<td>{$cat_title}</td>";
                                echo "<td><a href='categories.php?delete={$cat_id}'>Delete<a></a></td>";
                                echo "<td><a href='categories.php?edit={$cat_id}'>Edit<a></a></td>";
                                echo "</tr>";
                            }

                            ?>

                            <?php

                            // DELETE QUERY
                            if(isset($_GET['delete'])){
                                $cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id={$cat_id}";
                                $delete_query = mysqli_query($connection, $query);
                                if(!$delete_query){
                                    die('QUERY FAILED' . mysqli_error($connection));
                                }
                                header("Location: categories.php");
                            }

                            ?>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

     </div>
    <!-- /#page-wrapper -->

<?php

include "includes/admin_footer.php"

?>