<?php 

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>

    <!-- usuario logeado u otro usuario -->
        <?php
            require_once("../scripts/connection.php");
            if (isset($_GET["id"])) {
                $profile_id = $_GET["id"];
                echo $_GET["username"];
            } elseif (isset($_SESSION["id"])) {
                $profile_id = $_SESSION["id"];
                echo $_SESSION["usuario"];
            }

        ?>
    </h1>

    <!-- Seguir o dejar de seguir -->
    <div>
        <?php
            if (($_GET["id"]!=$_SESSION["id"])) { 
                $sql_follow = "SELECT * FROM follows WHERE users_id = '".$_SESSION["id"]."' AND userToFollowId = '".$profile_id."'";	
                $query_follow = mysqli_query($connect, $sql_follow);
                $row_follow = mysqli_fetch_assoc($query_follow);

                if (!$row_follow) {
        ?>
            <form action="../scripts/follows.php" method="POST">
                <input type="hidden" id="profile_id" name="profile_id" value="<?php echo htmlspecialchars($profile_id); ?>" />
                <input id="followBttn" type="submit" value="Follow" name="submit"/>
            </form>
        <?php
                } elseif ($row_follow) {
        ?>  
            <form action="../scripts/unfollows.php" method="POST">
                <input type="hidden" id="profile_id" name="profile_id" value="<?php echo htmlspecialchars($profile_id); ?>" />
                <input id="unfollowBttn" type="submit" value="Unfollow" name="submit"/>
            </form>
        <?php
                }
                 
        }
        // else{}
        ?>
        
    </div>
    

    <!--Folowers y following -->

    <div>
        <!--followers-->
        <?php
            $sql_followers = "SELECT count(*) FROM follows WHERE userToFollowId = '".$profile_id."'";
            $query_followers = mysqli_query($connect, $sql_followers);
            $row_followers = mysqli_fetch_assoc($query_followers);
        ?>
        <form action="followers.php" method="POST">
            <input id="followers" type="submit" name="submit" value=" <?php echo $row_followers ["count(*)"] ?> Followers" />
            <input type="hidden"  id="profile_id" name="profile_id" value="<?php echo htmlspecialchars($profile_id); ?>" />
        </form>

        <!--followings-->
        <?php
            $sql_followings = "SELECT count(*) FROM follows WHERE users_id = '".$profile_id."'";
            $query_followings = mysqli_query($connect, $sql_followings);
            $row_followings = mysqli_fetch_assoc($query_followings);
        ?>
        <form action="../main/followings.php" method="POST">
            <input id="followings" type="submit" name="submit" value="<?php echo $row_followings ["count(*)"] ?> Followings" />
            <input type="hidden"  id="profile_id" name="profile_id" value="<?php echo htmlspecialchars($profile_id); ?>" />
        </form> 
    
    <div>

    <!-- Mostrar descripciones -->
        <div>
            <?php
                $sql_description = "SELECT description FROM users WHERE id = '".$profile_id."'";
                $query_description = mysqli_query($connect, $sql_description);
                $row_description = mysqli_fetch_assoc($query_description);
            ?>
            <p class="descr"><?php echo $row_description ["description"] ?></p>
        </div>

    <!-- Actualizar descripción (si usuario de sesión) -->
        <div>
            <?php if ($profile_id==$_SESSION["id"]) {
                ?>
                <form action="../scripts/description.php" method="POST">
                <textarea id="description" class="form-control text-info mt-2 w-10" name="description"placeholder="Add a description here" rows="8" cols="40" required></textarea>
                <input id="sendBttn" type="submit" value="Send" name="submit"/>
            </form>
            <?php
            }
            ?>
        </div>
        
    </div>

    <!-- Volver a Main -->
    <div>
        <form action="../main/main.php" method="POST">
            <input id="tl" type="submit" value="TL" name="submit"/>
        </form>
    </div>

    <!-- Mostrar publicaciones -->
    <div>
        <?php
        if(isset($_GET["id"])) {
            $sql_publication = "SELECT text, createDate FROM publications WHERE userId = '".$_GET["id"]."' order by createDate desc";
            $query_publication = mysqli_query($connect, $sql_publication);
            $row_publication = mysqli_fetch_assoc($query_publication);
            
            while ($row_publication = mysqli_fetch_assoc($query_publication)) {
                echo '<p>' . $row_publication["text"] . '</p>'. '<br>'. '<p>'. $row_publication["createDate"] . '</p>';
            }
        }elseif(isset($_SESSION["id"])) {
            $sql_publication = "SELECT text, createDate FROM publications WHERE userId = '".$_SESSION["id"]."' order by createDate desc";
            $query_publication = mysqli_query($connect, $sql_publication);
            $row_publication = mysqli_fetch_assoc($query_publication);
            
        
            while ($row_publication = mysqli_fetch_assoc($query_publication)) {
                echo '<p>' . $row_publication["text"] . '</p>'. '<br>'. '<p>'. $row_publication["createDate"] . '</p>';
            }
        }
        
        ?>
    </div>

    <a href="../scripts/logout.php">Logout</a>
    
</body>
</html>
