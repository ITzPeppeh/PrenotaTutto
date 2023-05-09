<?php
    session_start();

    if(isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    
    include("config.php");

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
            include("timeout.php");
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

        <style>
            * {
                box-sizing: border-box;
            }

            body {
                background-color: #f9f9fa;
                display: block;
                height: 100%;
                margin: 0 22px;
                font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;
                font-size: 14px;
                line-height: 1.57142857;
                color: #3c4650;
            }

            form {
                width: 100%;
                height: 100%;
                display: table;
                position: relative;
                margin-top: 0em;
            }

            div {
                display: block;
            }

            .wrapper {
                display: table-cell;
                vertical-align: middle;
                position: relative;
            }

            .content-wrapper {
                width: 400px;
                margin: 0 auto;
                text-align: center;
                padding-bottom: 44px;
            }

            .content-wrapper .header {
                margin-top: 44px;
                margin-bottom: 44px;
            }

            .content-wrapper .content .nav {
                width: 100%;
                margin: 22px 0;
                padding-left: 0;
                list-style: none;
            }
            .content-wrapper .content ul li {
                font-size: 12px;
                display: table-cell;
                width: 1%;
            }

            li a {
                margin-right: 20px;
                margin-bottom: 0;
                text-align: center;
                text-transform: uppercase;
                font-weight: 700;
                border: 1px solid #e8e9ea;
                position: relative;
                display: block;
                padding: 11px;
                text-decoration: none;
                border-radius: 4px;
                background-color: transparent;
                color: #9da2a7;
            }



            li.active a, a:hover {
                color: #3c4650;
                background-color: #fff;
                box-shadow: 0 0 0 2px #f3f4f4;
            }

            li.last a{
                margin-right: 0;
            }

            .content-wrapper .content .tab-content {
                padding: 44px 44px 22px;
                position: relative;
                box-shadow: 0 0 0 3px #f5f6f6;
                margin-bottom: 22px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                border-color: #edeeef;
            }

            .content-wrapper .content .title {
                font-size: 30px;
                font-weight: 800;
                line-height: 44px;
                margin-bottom: 33px;
            }

            .content-wrapper .content  .tab-content .form .form-group {
                text-align: left;
                margin-bottom: 22px;
            }

            .form-control {
                box-shadow: none;
                display: block;
                width: 100%;
                height: 44px;
                padding: 10px 12px;
                font-size: 14px;
                line-height: 1.57142857;
                color: #3c4650;
                background-color: #fff;
                background-image: none;
                border: 1px solid #d7d9db;
                border-radius: 4px;
            }

            .children-box input {
                float: left;
                display: block;
                width: 22px;
                height: 22px;
                border: 1px solid #d7d9db;
                background: #fff;
                vertical-align: middle;
                border-radius: 4px;
                color: #3c4650;
            }

            .children-box label {
                display: block;
                margin-left: 33px;
                font-weight: 400;
                vertical-align: middle;
                margin-bottom: 0;
                max-width: 100%;
                text-align: left;
            }

            .form-group .btn {
                margin-top: 22px;
                width: 100%;
                border-radius: 3px;
                text-transform: uppercase;
                color: #fff;
                background-color: #3c4650;
                border-color: #3c4650;
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

            .form .under-mex {
                color: #62b8ed;
                font-size: 12px;
                line-height: 22px;
                display: block;
                margin-top: 22px;
                text-decoration: none;
            }
            
        </style>

    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="wrapper">
                <div class="content-wrapper">
                    <div class="header">
                        <div class="logo">
                            <img src="img/logo.png">
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
        
        <script>
            function showPWD() {
              var x = document.getElementById("passbox");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
            
        </script>
    </body>
</html>

