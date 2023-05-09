<?php 
    session_start();

    include("resources/data/timeout.php");
    checkSessionTimer();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    if (!$_GET && !$_POST) {
        header("Location: index.php");
    }

    include("resources/data/config.php");

    ?>

    <?php
        if (isset($_GET["prod"])) {
            checkSessionTimer();
            $idprod = $_GET["prod"];

            $sql = "SELECT CodA, NomeA, MaxPosti, PostiPren FROM attivita WHERE CodA='$idprod'";
            $result = mysqli_query($db, $sql);
            if (!$result) 
            {
                die ('Query error');
            }
            while ($row = mysqli_fetch_assoc($result))
            {
                $tempCodA = $row["CodA"];
                $tempNomeA = $row["NomeA"];
                $tempMaxPosti = $row["MaxPosti"];
                $tempPostiPren = $row["PostiPren"];
                $postiDisp = $tempMaxPosti-$tempPostiPren;
            }
            
        } else {
            header("Location: index.php");
        }
    ?>

<html>
    <head>
        <title><?php echo $titleWebSite; ?> - Attivitá</title>
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
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

            
            <header class="h-logo container">
                    <a href="index.php">
                        <img src="resources/images/logo_w.png" width="250" height="55">
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
                        <h1>Prenotati per l'attivitá</h1>
                        <h2><?php echo $tempNomeA; ?></h2>
                    </div>
                </div>
            </header>

            <div class="content">
                <div class="controls">
                    <legend>Prenotazione</legend>
                    <div class="form-group">
                        <label for="vogliopren">Sto prenotando</label>
                        <select name="vogliopren" class="form-control" required>
                        <?php 
                            switch ($postiDisp) {
                                case 1:
                                    echo "<option value = '1'>solo per me</option>";
                                    break;
                                case 2:
                                    echo "<option value = '1'>solo per me</option>";
                                    echo "<option value = '2'>per me e 1 figlio</option>";
                                    break;
                                case 3:
                                    echo "<option value = '1'>solo per me</option>";
                                    echo "<option value = '2'>per me e 1 figlio</option>";
                                    echo "<option value = '3'>per me e 2 figli</option>";
                                    break;
                                case $postiDisp>=4:
                                    echo "<option value = '1'>solo per me</option>";
                                    echo "<option value = '2'>per me e 1 figlio</option>";
                                    echo "<option value = '3'>per me e 2 figli</option>";
                                    echo "<option value = '4'>per me e 3 figli</option>";
                                    break;
                            }
                        ?>
                        </select> <br>
                        <input type="submit" value="Prenota ora!" class="btn">
                        <?php 
                            if ($_POST) {
                                checkSessionTimer();
                                $postidaPren = $_POST["vogliopren"];

                                $sql = "UPDATE attivita
                                        SET PostiPren = PostiPren+$postidaPren
                                        WHERE CodA = '$tempCodA' AND MaxPosti>=(PostiPren+$postidaPren);";
                                        
                                $result = mysqli_query($db, $sql);
                                if (!$result) 
                                {
                                    die ('Query error');
                                }
                                if (mysqli_affected_rows($db)) {
                                    $sql = "INSERT INTO prenota (CodA, Username, Persone)
                                    VALUES ('$tempCodA', '$codUtente', $postidaPren)";
                                    $result = mysqli_query($db, $sql);
                                    if (!$result) 
                                    {
                                    die ('Query error');
                                    }
                                    echo "<font color='green'>Posti prenotati!</font>";
                                } else {
                                    echo "<font color='red'>Ops, sei arrivato troppo tardi.</font>";
                                }
                            }
                        ?>
                    </div>
                </div>

            </div>

        </form>
    </body>
</html>