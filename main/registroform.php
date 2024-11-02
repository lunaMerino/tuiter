<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<form action="../scripts/registro.php" method="POST">
            <fieldset>
                <legend>Registrate</legend>

                <div>
                    <label for="username" >Username:</label>
                    <div>
                        <input type="text" id="username" name="username" required />
                    </div>
                    <label for="username" >Email:</label>
                    <div>
                        <input type="email" id="email" name="email"/>
                    </div>
                </div>

                <div>
                    <label for="password" >Password:</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Debe contener al menos un número y una mayúscula y una minúscula, y al menos 8 o más carácteres"/>
                    </div>
                </div>

                <div >
                    <input id="sendBttn" type="submit" value="Send" name="submit"/>
                </div>
            </fieldset>
            <a href="../index.php">Log in</a>
        </form>
</body>
</html>


<!-- si el username se mete duplicado reconducir error -->