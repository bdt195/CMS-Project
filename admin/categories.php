<?php

include "includes/admin_header.php";
include "includes/functions.php";

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
                        <!-- FORM ADD CATEGORIES -->
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title"\>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category"\>
                            </div>

                        </form>

                        <!-- ADD CATEGORIES -->
                        <?php add_categories(); ?>

                        <!-- UPDATE CATEGORIES -->
                        <?php

                        if(isset($_GET['edit'])||isset($_POST['update']))

                            include "includes/update_category.php";

                        ?>
                    </div>

                    <!--Show All Categories -->
                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php find_all_categories(); ?>

                            </tbody>
                        </table>
                    </div>

                    <?php delete_categories(); ?>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

     </div>
    <!-- /#page-wrapper -->

<?php

include "includes/admin_footer.php"

?>