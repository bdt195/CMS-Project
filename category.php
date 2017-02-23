<?php

include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";

?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                if(isset($_GET['category'])){
                    $category_title = $_GET['category'];
                    $query = "SELECT * FROM categories WHERE cat_title LIKE '$category_title'";
                    $select_category_query = mysqli_query($connection, $query);
                    if(!$select_category_query){
                        die('QUERY FAILED: ' . mysqli_error($connection));
                    }

                    if(mysqli_num_rows($select_category_query) == 0){
                        echo "<h1>Category not found!</h1>";
                    } else {
                        $row = mysqli_fetch_assoc($select_category_query);
                        $category_id = $row['cat_id'];
                        $query = "SELECT * FROM posts WHERE post_category_id = $category_id";
                        $select_post_query = mysqli_query($connection, $query);
                        if(!$select_post_query){
                            die('QUERY FAILED: ' . mysqli_error($connection));
                        }

                        if(mysqli_num_rows($select_post_query) == 0){
                            echo "<h1>Category is empty!</h1>";
                        } else {
                        while($row = mysqli_fetch_assoc($select_post_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];

                    ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?id=<?php echo $post_title ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                <?php } } } } ?>





            </div>
            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php

include "includes/footer.php";

?>
