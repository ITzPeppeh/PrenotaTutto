<?php
    session_start();

    if(isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }

    include("resources/data/config.php");

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
        
        if (mysqli_num_rows($result)) {
            $err = "Username giá esistente";
        } else {
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

    }

    mysqli_close($db);
?>
<html>
    <head>
        <title><?php echo $titleWebSite; ?> - Register</title>
        <link rel="stylesheet" type="text/css" href="resources/css/styles_access.css">
        <script type="text/javascript" src="resources/js/index.js"></script>
    </head>
    <body>
        <form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "POST" id="myreg">
            <div class="wrapper">
                <div class="content-wrapper">
                    <div class="header">
                        <div class="logo">
                            <img src="resources/images/logo.png">
                        </div>
                    </div>
                    <div class="content">
                        <ul class="nav">
                            <li class=""><a href="login.php" onclick=""> Accedi </a></li>
                            <li class="last active"><a href="register.php" onclick=""> Registrati </a></li>
                        </ul>
                    <div class="tab-content">
                        <div class="title">Registrati</div>
                            <div class="form">
                                <div class="form-group">
                                    <input type="text" name="nome" class="form-control" placeholder="Inserisci Nome" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="cognome" class="form-control" placeholder="Inserisci Cognome" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Inserisci Nome Utente" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="passwd1" name="passwd1" class="form-control" placeholder="Inserisci Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="passwd2" name="passwd2" class="form-control" placeholder="Ripeti Password" required>
                                </div>
                                <div class="children-box">
                                    <input type="checkbox" name="show_passwd" onclick="showPWD2()">
                                    <label for="show_passwd">Mostra password in chiaro</label>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn" value = "Registrati" onclick="checkpwd2()">
                                </div>
                                <a href="index.php" class="under-mex">Vuoi tornare alla pagina iniziale?</a>
                                <?php
                                    if(isset($err)) {
                                        echo '<font color="red">'.$err."</font>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
    </body>
</html>