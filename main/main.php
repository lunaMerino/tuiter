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
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Main</title>
</head>
<body>

    <div class="header">
        <div>
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
                echo '<a href="profile.php?id=' . $row["id"] . '&username=' . $row["username"] . '">Mi perfil</a>';
                }
            ?>
        </div>

        <div class="logout">
            <form action="../scripts/logout.php" method="POST">
                <input id="logout" type="submit" value="Logout" name="submit"/>
            </form>
        </div>

    </div>

    <div class="body">

        <div class="publications">
        <!-- Mostrar publicaciones -->
            
            <div class="followers">
                <h3>Followers</h3>
                    <?php

                        $loggedInUser = $_SESSION["id"];

                        $sql_followed_publi= "SELECT u.username as username, u.id as user_id, publi.createDate, publi.text FROM publications as publi
                        JOIN users as u ON (publi.userId = u.id) JOIN follows as foll ON (foll.userToFollowId = u.id)
                        WHERE foll.users_id = '$loggedInUser' AND publi.userId != '$loggedInUser' ORDER BY createDate DESC";
                        
                        $query_followed_publi = mysqli_query($connect, $sql_followed_publi);

                        if ($query_followed_publi && mysqli_num_rows($query_followed_publi) > 0) {
                            while ($row = mysqli_fetch_assoc($query_followed_publi)) {
                            echo '<a href="profile.php?id=' . $row["user_id"] . '&username=' . $row["username"] . '">' .'<br>'. $row["username"]. '</a>'. '<br>' . '<p>'. $row["text"] . '</p>'. '<p>'. $row["createDate"] . '</p>';
                        }
                        }
                        
                    ?>
            </div>

            <div class="not-followed">
            <!-- Mostrar publicaciones de otros usuarios -->
                <h4>People you may know</h4>
                
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
                        echo '<a href="profile.php?id=' . $row["user_id"] . '&username=' . $row["username"] . '">' . '<br>'. $row["username"]. '</a>'. '<br>' . '<p>'. $row["text"] . '</p>'. '<p>'. $row["createDate"] . '</p>';
                    }
                }
                ?>      
            </div>
        </div>

        
        <div class="tweet">
        <!-- Crear tweet -->
            <form action="../scripts/tweet.php" method="POST">
                <div class="tweetButton">
                <textarea id="text" class="textarea" name="text"placeholder="What's happening?" rows="15" cols="40" required></textarea>
                <input id="sendBttn" type="submit" value="Tweet" name="submit"/>
                </div>
            </form>
        </div>

    </div>
    
</body>
</html>





<!-- //cambiar genero del bienvenido -->