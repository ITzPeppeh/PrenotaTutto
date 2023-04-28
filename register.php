<?php
    session_start();

    if(isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }

    include("config.php");

    if(isset($_POST["formregistration"])) {
        $nomeUser = $_POST["nome"];
        $cognomeUser = $_POST["cognome"];
        $usernameUser = $_POST["username"];
        $passwordUser = sha1($_POST["passwd"]);

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
    <form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "POST">
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
                        <td><input type="password" name="passwd" required></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><input type="submit" value = "Registrati" name="formregistration"></td>
                    </tr>
                </table>
            </form>
    </body>
</html>