<?php

    session_start();
    if (isset($_POST["submit"])) {

        require_once("./connection.php");

        $userToFollowId = mysqli_real_escape_string($connect, $_POST["profile_id"]);
        $id = $_SESSION["id"];

        if ($id && $id !== ""&& $userToFollowId && $userToFollowId !== "") {
            $sql = "INSERT INTO follows(users_id, userToFollowId) VALUES('$id','$userToFollowId')";
            $guardar = mysqli_query($connect, $sql);

            if ($guardar) {

                $sql_usernameToFollow= "SELECT username FROM users WHERE id = '".$userToFollowId."'";
                $query_usernameToFollow = mysqli_query($connect, $sql_usernameToFollow);
                $row_usernameToFollow = mysqli_fetch_assoc($query_usernameToFollow);
            
                header("Location: ../main/profile.php?id=$userToFollowId&username=$row_usernameToFollow[username]");
            } else {
                header("Location: ../error/error.php");
            }
        }
    }