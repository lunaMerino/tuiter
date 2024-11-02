<?php

    session_start();
    if (isset($_POST["submit"])) {

        require_once("./connection.php");

        $userToUnfollowId = mysqli_real_escape_string($connect, $_POST["profile_id"]);
        $id = $_SESSION["id"];

        if ($id && $id !== ""&& $userToUnfollowId && $userToUnfollowId !== "") {
            $sql = "DELETE FROM follows WHERE users_id = '$id' AND userToFollowId = '$userToUnfollowId'";
            $guardar = mysqli_query($connect, $sql);

            if ($guardar) {

                $sql_usernameToUnfollow= "SELECT username FROM users WHERE id = '".$userToUnfollowId."'";
                $query_usernameToUnfollow = mysqli_query($connect, $sql_usernameToUnfollow);
                $row_usernameToUnfollow = mysqli_fetch_assoc($query_usernameToUnfollow);
            
                header("Location: ../main/profile.php?id=$userToUnfollowId&username=$row_usernameToUnfollow[username]");
            } else {
                header("Location: ../error/error.php");
            }
        }
    }