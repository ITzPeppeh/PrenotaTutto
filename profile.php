<?php 
    session_start();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    include("config.php");

    $sql = "SELECT Passwd, Cognome, Nome FROM utente WHERE Username='$codUtente'";
    $result = mysqli_query($db, $sql);
    if (!$result) 
    {
        die ('Query error');
    }
    $row = mysqli_fetch_assoc($result);

    $password = $row["Passwd"];
    $cognome = $row["Cognome"];
    $nome = $row["Nome"];

?>

<html>
    <head>
        <title><?php echo $titleWebSite; ?> - Profilo</title>

        <style>
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background-color: transparent; 
            }
            
            ::-webkit-scrollbar-thumb {
                background-color: #d6dee1;
                border-radius: 20px;
                border: 6px solid transparent;
            }
            
            * {
                box-sizing: border-box;
            }

            body {
                font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;
                font-size: 14px;
                line-height: 1.57142857;
                color: #3c4650;
                background-color: #f9f9fa;
                margin: 0;
                display: block;
            }

            form {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                padding-top: 55px;
                overflow-anchor: none;
                display: block;
            }

            .container {
                position: relative;
                margin: 0;
                width: 100%;
            }

            header.h-logo {
                border: none;
                background: #2d333d;
                top: 0;
                position: absolute;
                z-index: 1030;    
                min-height: 55px;
                margin-bottom: 22px;
                display: flex;
                justify-content: center;
                align-items: center;
            }


            header.h-navbar {
                border: none;
                background: #363d49;
                top: 0;
                z-index: 1030;
                min-height: 35px;
                display: table;
            }

            header.h-navbar .navig {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            header.h-navbar .navig ul {
                list-style: none;
                display: inline-block;
                margin: 0;
                padding: 0;
            }

            header.h-navbar .navig li {
                float: left;
                padding: 0 15px;
                border-left: 1px solid #636b73;
            }

            header.h-navbar .navig ul li:last-child {
                border-right: 1px solid #636b73;
            }
            
            header.h-navbar .navig li a {
                color: #636b73;
                font-weight: 600;
                text-transform: uppercase;
                text-decoration: none;
            }
            
            header.h-navbar .navig li a:hover {
                color: #fff;
            }

            .m-header {
                padding: 48px 0 40px;
                background-color: #fff;
                border-bottom: 1px solid #e8e9ea;
                box-shadow: inset 0 2px 0 0 #f3f4f4;
            }

            .m-header .title {
                padding-left: 75px;
            }

            .m-header .title h1 {
                font-weight: 700;
                color: inherit;
                margin: 0;
                font-size: 35px;
                font-family: inherit;
                line-height: 1.26;
            }
            
            .m-header .title h2 {
                font-weight: 300;
                color: #767e84;
                word-wrap: break-word;
                margin: 0;
                font-size: 35px;
                font-family: inherit;
                line-height: 1.26;
            }
            
            .m-header .titled div {
                color: #d8dadc;
            }
            
            .m-header .titled div.t {
                height: 88px;
                font-size: 100px;
                line-height: .88;
                color: #3c4650;
            }

            .col {
                display: Inline-block;
            }

            .content {
                margin: 15px 15px 0 15px;
                padding: 12px;
                background-color: #fff;
                box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
            }

            .content .controls {
                width: 100%;
                position: relative;
                min-height: 1px;
                padding-left: 11px;
                padding-right: 11px;
            }

            .content .controls legend {
                font-size: 22px;
                font-weight: 300;
                padding-bottom: 22px;
                display: block;
                width: 100%;
                padding: 0;
                margin-bottom: 22px;
                line-height: inherit;
                color: #3c4650;
                border: 0;
                border-bottom: 1px solid #e8e9ea;
            }

            .content .controls .form-group {
                margin-bottom: 22px;
                text-align: left;
                margin-bottom: 0;
                padding-top: 11px;
            }

            .content .controls label {
                display: inline-block;
                max-width: 100%;
                font-weight: 700;
                cursor: default;
            }

            .form-control {
                box-shadow: none;
                display: Inline-block;
                width: 50%;
                height: 44px;
                padding: 10px 12px;
                font-size: 14px;
                line-height: 1.57142857;
                border: 1px solid #d7d9db;
                border-radius: 4px;
            }
            .controls .btn {
                margin-top: 15px;
                text-transform: uppercase;
                border-radius: 3px;
                color: #fff;
                background-color: #1e9be3;
                border-color: #1e9be3;
                display: inline-block;
                margin-bottom: 0;
                font-weight: 700;
                text-align: center;
                vertical-align: middle;
                touch-action: manipulation;
                cursor: pointer;
                background-image: none;
                border: 1px solid transparent;
                white-space: nowrap;
                padding: 10px 12px;
                font-size: 14px;
                line-height: 1.57142857;
                user-select: none;
            }


        </style>
    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="myreg">

        <header class="h-logo container">
                <a href="index.php">
                    <img src="img/logo_w.png" width="250" height="55">
                </a>
        </header>

        <header class="h-navbar container">
            <div class="navig">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <?php 
                        if (!$codUtente) {
                            echo "
                            <li>
                                <a href='login.php'>Accesso</a>
                            </li>";
                        } else {
                            echo "
                            <li>
                                <a href='profile.php'>Profilo</a>
                            </li>
                            <li>
                                <a href='activity-history.php'>Le mie attivitá</a>
                            </li>
                            <li>
                                <a href='logout.php'>Logout</a>
                            </li>";
                        }
                    ?>
                </ul>
            </div>
        </header>

        <header class="m-header">
            <div class="col">
                <div class="title">
                    <h1>Credenziali Profilo</h1>
                    <h2>Gestisci</h2>
                </div>
            </div>
        </header>

            <div class="content">
                <div class="controls">
                    <legend>Le tue credenziali</legend>
                    <div class="form-group">
                        <label for="nome">Nome*: </label>
                        <input type="text" name="nome" value="<?php echo $nome; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome*: </label>
                        <input type="text" name="cognome" value="<?php echo $cognome; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input type="text" name="username" value="<?php echo $codUtente; ?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="oldpasswd">Password attuale*: </label>
                        <input type="password" name="oldpasswd" id="passwd3" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="newpasswd1">Nuova password: </label>
                        <input type="password" name="passwd1" id="passwd1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="newpasswd2">Ripeti nuova password: </label>
                        <input type="password" name="passwd2" id="passwd2" class="form-control">
                    </div>
                    <input type="button" value="Aggiorna credenziali" class="btn" onclick="checkpwd()">
                    <?php 
                        if ($_POST) {
                            $pas = $_POST["oldpasswd"];
                            if (sha1($pas) != $password) {
                                echo '<font color="red">Password non corretta.</font>';
                            } else {
                                $tempNome = $_POST["nome"];
                                $tempCognome = $_POST["cognome"];
                                $che = sha1($_COOKIE["pwd"]);
                                $posPassword = $che == $pas ? $pas : $che;

                                $sql = "UPDATE utente
                                        SET Nome = '$tempNome', Cognome = '$tempCognome', Passwd = '$posPassword'
                                        WHERE Username = '$codUtente'";
                                        
                                $result = mysqli_query($db, $sql);
                                if (!$result) 
                                {
                                    die ('Query error');
                                }
                                echo "<font color='green'>Credenziali aggiornate!</font>";
                            }
                    }
                    ?>
                </div>
            </div>
            
        </form>

        
        <script>
            function checkpwd() {

                var password1 = document.getElementById('passwd1').value;
                var password2 = document.getElementById('passwd2').value;
                var oldpassword = document.getElementById('passwd3').value;

                if (password1) {
                    if (password1 == password2) {
                        if(password1.length >= 8) {
                            if (password1.match("[A-Z]")) {
                                if (password1.match("[0-9]")) {
                                    document.cookie = "pwd=" + password1;
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
                } else {
                    document.cookie = "pwd=" + oldpassword;
                    document.getElementById("myreg").submit();
                }

                
            }
        </script>
    </body>
</html>




