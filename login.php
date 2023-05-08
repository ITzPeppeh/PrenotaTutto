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
            header("Location: index.php");
        } else {
            $err = "Username or Password is invalid !";
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

            .conten-wrapper .header .logo {
                vertical-align: middle;
            }

            .content-wrapper .content .nav {
                width: 100%;
                margin: 22px 0;
                padding-left: 0;
                list-style: none;
            }
            .content-wrapper .content ul li {
                font-size: 12px;
            }

            li a {
                margin-right: 20px;
                text-align: center;
                text-transform: uppercase;
                font-weight: 700;
                border: 1px solid #e8e9ea;
                position: relative;
                display: block;
                padding: 11px;
                text-decoration: none;
                border-radius: 4px;
            }


            li.active a {
                color: #3c4650;
                background-color: #fff;
            }
            
        </style>

    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="header">
                    <div class="logo">
                        <?php echo $titleWebSite; ?>
                    </div>
                </div>
                <div class="content">
                    <ul class="nav">
                        <li class="active"><a href="login.php" onclick=""> Accedi </a></li>
                        <li ><a href="register.php" onclick=""> Registrati </a></li>
                    </ul>
                </div>
            </div>
        </div>
            <h1>Login Form</h1>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username" required>                
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="passwd" class="form-control" required>                
            </div>
            <input type="submit" class="btn" name="formconnection" value="Login">
        </form>
        <?php
            if(isset($err)) {
                echo '<font color="red">'.$err."</font>";
            }
        ?>
        
    </body>
</html>

