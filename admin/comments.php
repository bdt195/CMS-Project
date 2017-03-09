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

                    include "includes/view_all_comments.php";

                    if(isset($_GET['delete'])) {
                        $comment_id = $_GET['delete'];
                        delete_comment($comment_id);
                    }
                    if(isset($_GET['approve'])) {
                        $comment_id = $_GET['approve'];
                        approve_comment($comment_id);
                    }
                    if(isset($_GET['unapprove'])) {
                        $comment_id = $_GET['unapprove'];
                        unapprove_comment($comment_id);
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