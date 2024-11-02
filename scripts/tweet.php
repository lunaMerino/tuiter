<?php

    session_start();
    if (isset($_POST["submit"])) {

        require_once("./connection.php");

        $tweet= mysqli_real_escape_string($connect, $_POST["text"]);
        $id = $_SESSION["id"];

        if ($tweet && $tweet !== "") {
            $sql = "INSERT INTO publications(userId, text, createDate) VALUES('$id','$tweet', NOW());";
            $guardar = mysqli_query($connect, $sql);

            if ($guardar) {
                header("Location: ../main/main.php");
            } else {
                header("Location: ../error/error.php");
            }
        }
    }