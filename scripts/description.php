<?php
    session_start();
    if (isset($_POST["submit"])) {

        require_once("./connection.php");

        $description= mysqli_real_escape_string($connect, $_POST["description"]);
        $id = $_SESSION["id"];

        if ($description && $dedscription !== "") {
            $sql = "UPDATE users SET description = '$description' WHERE id = $id";
            $guardar = mysqli_query($connect, $sql);

            if ($guardar) {
                $username = $_SESSION["usuario"];
                header("Location: ../main/profile.php?id=$id&username=$username");
            } else {
                header("Location: ../error/error.php");
            }
        }
    }
?>