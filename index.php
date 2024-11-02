<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <form action="scripts/login.php" method="POST">
            <fieldset>
                <legend>Login</legend>

                <div>
                    <p>Already have an account?</p>
                    <label for="username" >Username:</label>
                    <div>
                        <input type="text" id="username" name="username" required />
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
    </form>
    <a href="./main/registroform.php">Registro</a>

</body>
</html>