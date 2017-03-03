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
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->

                <?php include "includes/admin_widgets.php"; ?>

                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php

                                $query = "SELECT * FROM posts WHERE post_status = 'published'";
                                $select_published_post_query = mysqli_query($connection, $query);
                                $published_post_count = mysqli_num_rows($select_published_post_query);

                                $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                                $select_draft_post_query = mysqli_query($connection, $query);
                                $draft_post_count = mysqli_num_rows($select_draft_post_query);

                                $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
                                $select_approved_comment_query = mysqli_query($connection, $query);
                                $approved_comment_count = mysqli_num_rows($select_approved_comment_query);

                                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                                $select_unapproved_comment_query = mysqli_query($connection, $query);
                                $unapproved_comment_count = mysqli_num_rows($select_unapproved_comment_query);

                                $query = "SELECT * FROM users WHERE user_role = 'admin'";
                                $select_admin_query = mysqli_query($connection, $query);
                                $admin_count = mysqli_num_rows($select_admin_query);

                                $query = "SELECT * FROM categories";
                                $select_categories_query = mysqli_query($connection, $query);
                                $category_count = mysqli_num_rows($select_categories_query);

                                $element_text = ['Active Posts', 'Draft Post', 'Approved Comments', 'Unapproved Comments','Admin', 'Category'];
                                $element_count = [$published_post_count, $draft_post_count, $approved_comment_count, $unapproved_comment_count, $admin_count, $category_count];

                                for($count = 0 ; $count < 6 ; $count++){
                                    echo "['{$element_text[$count]}'" . "," . "{$element_count[$count]}],";
                                }

                                ?>
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                        }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php

include "includes/admin_footer.php"

?>