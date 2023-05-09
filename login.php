<?php
    session_start();

    if(isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    
    include("resources/data/config.php");

    if(isset($_POST["formconnection"])) {
        $usernameconnect = $_POST["username"];
        $passwdconnect = sha1($_POST["passwd"]);

        $sql = "SELECT *
                FROM utente
                WHERE Username = '$usernameconnect' AND Passwd = '$passwdconnect'";

        $result = mysqli_query($db, $sql);
        if (!$result)
        {
            die ('Query error');
        }
        
        if (mysqli_num_rows($result)) {
            $_SESSION["iduser"] = $usernameconnect;
            include("resources/data/timeout.php");
            startSessionTimer();
            header("Location: index.php");
        } else {
            $err = "Nome utente o Password non valido!";
        }
    }

    if (isset($_GET["err_code"])) {
        switch ($_GET["err_code"]) {
            case 'no_longer_time':
                $err = "Tempo di sessione scaduto.";
                break;
        }
        
    }

    mysqli_close($db);
?>
<html>
    <head>
        <title><?php echo $titleWebSite; ?> - Login</title>
        <link rel="stylesheet" type="text/css" href="resources/css/styles_access.css">
        <script type="text/javascript" src="resources/js/index.js"></script>
    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="wrapper">
                <div class="content-wrapper">
                    <div class="header">
                        <div class="logo">
                            <img src="resources/images/logo.png">
                        </div>
                    </div>
                    <div class="content">
                        <ul class="nav">
                            <li class="active"><a href="login.php" onclick=""> Accedi </a></li>
                            <li class="last"><a href="register.php" onclick=""> Registrati </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="title">Accedi</div>
                            <div class="form">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Nome utente" autocomplete="username" required>
                                </div>
                                <div class="form-group has-child">
                                    <input type="password" id="passbox" name="passwd" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="children-box">
                                    <input type="checkbox" name="show_passwd" onclick="showPWD()">
                                    <label for="show_passwd">Mostra password in chiaro</label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn" name="formconnection" value="Login">
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

