<?php
    session_start();

    if(isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }

    include("config.php");

    if(isset($_POST["username"])) {
        $nomeUser = $_POST["nome"];
        $cognomeUser = $_POST["cognome"];
        $usernameUser = $_POST["username"];
        $passwordUser = sha1($_POST["passwd1"]);

        $sql = "SELECT *
                FROM utente
                WHERE Username = '$usernameUser'";

        $result = mysqli_query($db, $sql);
        if (!$result)
        {
            die ('Query error');
        }
        
        if (mysqli_num_rows($result)) { //migliorabile
            $err = "Username already exists";
            die("Username already exists");
        }

        $sql = "INSERT INTO utente (Username, Passwd, Cognome, Nome)
                VALUES ('$usernameUser', '$passwordUser', '$cognomeUser', '$nomeUser')";

        $result = mysqli_query($db, $sql);
        if (!$result)
        {
            die ('Query error');
        }

        $_SESSION["iduser"] = $usernameUser;
        header("Location: index.php");
    }

    mysqli_close($db);
?>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
    <form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "POST" id="myreg">
                <table>
                    <tr>
                        <td>Registrati al sito:</td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td><input type="text" name="nome" required></td>
                    </tr>
                    <tr>
                        <td>Cognome:</td>
                        <td><input type="text" name="cognome" required></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name = "username" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="passwd1" id="passwd1" required></td>
                    </tr>
                    <tr>
                        <td>Reinserisci Password:</td>
                        <td><input type="password" name="passwd2" id="passwd2" required></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><input type="button" value = "Registrati" onclick="checkpwd()"></td>
                    </tr>
                </table>
            </form>

        <script>
        function checkpwd() {
            var password1 = document.getElementById('passwd1').value;
            var password2 = document.getElementById('passwd2').value;

            if (password1 == password2) {
                if(password1.length >= 8) {
                    if (password1.match("[A-Z]")) {
                        if (password1.match("[0-9]")) {
                            document.getElementById("myreg").submit();
                        } else {
                            alert("Password must include at least one number");
                        }
                    } else {
                        alert("Password must include at least one upper case letter");
                    }
                } else {
                    alert("Password must be at least 8 characters in length");
                }
            } else {
                alert("Password non coincidono");
            }
        }
        </script>
    </body>
</html>