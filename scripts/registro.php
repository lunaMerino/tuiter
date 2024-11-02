 <?php

    if (isset($_POST["submit"])) {

        require_once("./connection.php");

        $username = mysqli_real_escape_string($connect, $_POST["username"]);
        $email = mysqli_real_escape_string($connect, $_POST["email"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);

        if ($username && $username !== "" && $email && $email !== "" && $password && $password !== "") {
            $pass = password_hash($password, PASSWORD_BCRYPT, ["cost" => 4]);
            $sql = "INSERT INTO users VALUES(null,'$username','$email', '$pass', null, NOW());";
            $guardar = mysqli_query($connect, $sql);

            if ($guardar) {
                header("Location: ../index.php");
            } else {
                header("Location: ../error/error.php");
            }
        }
    }