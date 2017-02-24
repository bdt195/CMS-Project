<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>

    <?php

    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        //
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post = mysqli_query($connection, $query);
        $post_title = mysqli_fetch_assoc($select_post)['post_title'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td><a href='comments.php?source=edit&id'>Approve</a></td>";
        echo "<td><a href='comments.php?source=edit&id'>Unapprove</a></td>";
        echo "<td><a href='comments.php?source=delete&id={$comment_id}'>Delete</a></td>";
        echo "</tr>";
    }

    ?>

    </tbody>
</table>