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

                    <?php

                    if(isset($_GET['source']) && $_GET['source'] == 'add_user') {
                        include "includes/add_user.php";
                    } else if(isset($_GET['delete'])) {
                        $user_id = $_GET['delete'];
                        delete_user($user_id);
                    } else if(isset($_GET['edit'])) {
                        include "includes/edit_user.php";
                    } else {
                        include "includes/view_all_users.php";
                    }

                    ?>


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