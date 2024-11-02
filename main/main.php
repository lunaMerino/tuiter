<?php 

    session_start();

?>
<?php
    require_once("../scripts/connection.php");
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
    <h1>
        <?php

            if (isset($_SESSION["usuario"])) {
                echo "Bienvenido ".$_SESSION["usuario"];
                
            } else {
                header("Location: ../index.php");
            }
         ?>
    </h1>

    <!-- Entrar al perfil de sesion -->
    <?php
        if (isset($_SESSION["id"])) {
            $user_id = $_SESSION["id"];
        }

        $sql = "SELECT id, username FROM users WHERE id = '$user_id'";
        $query = mysqli_query($connect, $sql);

        if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        echo '<a href="profile.php?id=' . $row["id"] . '&username=' . $row["username"] . '">Ver perfil de ' . $row["username"] . '</a>';
        }
        ?>

    <div>

        <!-- Crear tweet -->
        <div>
            <form action="../scripts/tweet.php" method="POST">
                <textarea id="text" class="form-control text-info mt-2 w-10" name="text"placeholder="What's happening?" rows="15" cols="40" required></textarea>
                <input id="sendBttn" type="submit" value="Tweet" name="submit"/>
            </form>
        </div>
        <div>
            

        <!-- Mostrar publicaciones -->

            <h1>Followers</h1>
            <div>
            <?php

                $loggedInUser = $_SESSION["id"];

                $sql_followed_publi= "SELECT u.username as username, u.id as user_id, publi.createDate, publi.text FROM publications as publi
                JOIN users as u ON (publi.userId = u.id) JOIN follows as foll ON (foll.userToFollowId = u.id)
                WHERE foll.users_id = '$loggedInUser' AND publi.userId != '$loggedInUser' ORDER BY createDate DESC";
                
                $query_followed_publi = mysqli_query($connect, $sql_followed_publi);

                if ($query_followed_publi && mysqli_num_rows($query_followed_publi) > 0) {
                    while ($row = mysqli_fetch_assoc($query_followed_publi)) {
                    echo '<a href="profile.php?id=' . $row["user_id"] . '&username=' . $row["username"] . '">' . $row["username"]. '</a>'. '<br>' . '<p>'. $row["text"] . '</p>'. '<br>'. '<p>'. $row["createDate"] . '</p>';
                }
                }
                
            ?>
            </div>
        </div>
        <div>
            <h1>People you may know</h1>
            
            <?php

                $logged_in_user_id = $_SESSION["id"];

                $sql_not_followed_publications = "SELECT u.username as username, u.id AS user_id, publi.createDate, publi.text FROM publications as publi
                JOIN users as u ON (publi.userId = u.id)
                LEFT JOIN follows as foll ON (foll.userToFollowId = u.id) AND foll.users_id = '$loggedInUser'
                WHERE foll.userToFollowId IS NULL AND publi.userId != '$logged_in_user_id'
                ORDER BY publi.createDate DESC";
                
            $query_not_followed = mysqli_query($connect, $sql_not_followed_publications);
        
            if ($query_not_followed && mysqli_num_rows($query_not_followed) > 0) {
                while ($row = mysqli_fetch_assoc($query_not_followed)) {
                    echo '<a href="profile.php?id=' . $row["user_id"] . '&username=' . $row["username"] . '">' . $row["username"]. '</a>'. '<br>' . '<p>'. $row["text"] . '</p>'. '<br>'. '<p>'. $row["createDate"] . '</p>';
                }
            }
            ?>      
        </div>
    </div>
    

    <a href="../scripts/logout.php">Logout</a>
</body>
</html>





<!-- //cambiar genero del bienvenido -->