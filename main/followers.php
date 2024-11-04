<?php 

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers</title>
</head>
<body>

    <h2>Followers</h2>
        <?php
        if(isset($_POST["submit"])) {

            require_once("../scripts/connection.php");

            $id = mysqli_real_escape_string($connect, $_POST["profile_id"]);
            $sql_followers = "SELECT u.username as username, u.id AS user_id, u.description as descript, foll.users_id as users_id, foll.userToFollowId as userToFollowId FROM follows as foll
            JOIN users as u ON (foll.users_id = u.id) WHERE userToFollowId = '$id'";
            $query_followers = mysqli_query($connect, $sql_followers);

            if ($query_followers && mysqli_num_rows($query_followers) > 0) {
                while ($row_followers = mysqli_fetch_assoc($query_followers)) {
                echo '<a href="profile.php?id=' . $row_followers["user_id"] . '&username=' . $row_followers["username"] . '"><br>'.$row_followers["username"] .'</a><br><p>'.$row_followers["descript"].'</p>';
                }
            }

        }
        ?>
</body>
</html>