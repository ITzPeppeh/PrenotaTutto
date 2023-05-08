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
        body {
            background-color: #f9f9fa;
        }
    </style>

    <style>
        /**{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            min-height: 100vh;
            display: flex;
            font-family: sans-serif;
        }
        .container{
            margin: auto;
            width: 500px;
            max-width: 90%;
        }
        .container form{
            width: 100%;
            height: 100%;
            padding: 20px;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, .3);
        }
        .container form h1{
            text-align: center;
            margin-bottom: 24px;
            color: #222;
        }
        .container form .form-control{
            width: 100%;
            height: 40px;
            background: white;
            border-radius: 4px;
            border: 1px solid silver;
            margin: 10px 0 18px 0;
            padding: 0;
        }
        .container form .btn{
            margin-left: 50px;
            transform: translateX(-50%);
            width: 120px;
            height: 34px;
            border: none;
            outline: none;
            background-color: #27a327;
            cursor: pointer;
            font-size: 16px;
            text-transform: uppercase;
            color: white;
            border-radius: 4px;
            transition: .3s;
        }
        .container form .btn:hover{
            opacity: .7;
        }*/
    </style>

</head>
<body>
    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
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
    </div>
    
</body>
</html>

