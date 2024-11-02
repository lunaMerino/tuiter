<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Following</title>
</head>
<body>
    <?php
        if (isset($_POST["submit"])) {

            require_once("../scripts/connection.php");

            $id = mysqli_real_escape_string($connect, $_POST["profile_id"]);
            $sql_following = "SELECT u.username as username, u.id as user_id, u.description as descript, foll.userToFollowId as userToFollowId, foll.users_id as users_id FROM follows as foll
            JOIN users as u ON (foll.userToFollowId = u.id) WHERE users_id = '$id'";
            $query_following = mysqli_query($connect, $sql_following);

        
            if ($query_following && mysqli_num_rows($query_following) > 0) {
                while ($row_following = mysqli_fetch_assoc($query_following)) {
                    echo '<a href="profile.php?id=' . $row_following["user_id"] . '&username=' . $row_following["username"] . '">'.$row_following["username"] .'</a><br><p>'.$row_following["descript"].'</p>';
                }
            }

        }
    ?>
</body>
</html>