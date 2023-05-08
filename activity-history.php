<?php 
    session_start();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    include("config.php");

    $sql = "SELECT P.CodA, A.NomeA, P.Persone
            FROM prenota P, attivita A
            WHERE P.CodA=A.CodA AND P.Username='$codUtente'";
    $result = mysqli_query($db, $sql);
    if (!$result) 
    {
        die ('Query error');
    }

    $numAttLibere = mysqli_num_rows($result);
?>
<html>
    <head>
        <title><?php echo $titleWebSite; ?> - Le mie prenotazioni</title>

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

            .row {
                margin-left: 0;
                margin-right: 0;
            }

            .col {
                display: Inline-block;
            }

            .responsive-table li {
                border-radius: 3px;
                padding: 15px 30px;
                display: flex;
                justify-content: space-between;
                margin: 15px 15px 0 0;
            }
            .responsive-table .table-header {
                background-color: #3c4650;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 0.03em;
            }
            .responsive-table .table-row {
                background-color: #ffffff;
                box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
            }
            .responsive-table .col-1 {
                flex-basis: 60%;
            }
            .responsive-table .col-2 {
                flex-basis: 20%;
            }
            .responsive-table .col-3 {
                flex-basis: 20%;
            }
            .responsive-table .table-header .col {
                color: #fff;
            }

            .table-row button {
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

            .table-row button:hover {
                color: #3c4650;
                background-color: #fff;
                box-shadow: 0 0 0 2px #f3f4f4;
                cursor: pointer;
            }

        </style>
    </head>
    <body>
        <form action="cancel-activity.php" method="POST">
            <input type="hidden" name="codU" value='<?php echo $codUtente; ?>'>
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
                <div class="row">
                    <div class="col">
                        <div class="title">
                            <h1>Le mie prenotazioni</h1>
                            <h2>Panoramica</h2>
                        </div>
                    </div>
                    <div class="col" style="float:right;margin-right:50px;text-align:right;">
                        <div class="titled">
                            <div>Numero di prenotazioni:</div>
                            <div class="t"><?php echo $numAttLibere; ?></div>
                        </div>
                    </div>
                    
                </div>
            </header>

            <div class="container">
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1"><b>Nome Attivitá</b></div>
                        <div class="col col-2"><b>Posti Prenotati</b></div>
                        <div class="col col-3"></div>
                    </li>

                    <?php 
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $tempCodA = $row["CodA"];
                            $tempNomeA = $row["NomeA"];
                            $tempPersPren = $row["Persone"];

                            echo "
                            <li class='table-row'>
                                <div class='col col-1'>$tempNomeA</div>
                                <div class='col col-2'>$tempPersPren</div>
                                <div class='col col-3'><button type='submit' value='$tempCodA' name='prod' >Annulla prenotazione</button></div>
                            </li>";
                        }
                    ?>

                </ul>
            </div>
        </form>
    </body>
</html>
