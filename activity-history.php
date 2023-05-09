<?php 
    session_start();

    include("resources/data/timeout.php");
    checkSessionTimer();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    include("resources/data/config.php");

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
        <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
    </head>
    <body>
        <form action="resources/data/cancel-activity.php" method="POST">
            <input type="hidden" name="codU" value='<?php echo $codUtente; ?>'>
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
                <div class="row">
                    <div class="col">
                        <div class="title">
                            <h1 style="font-weight: 700;color: inherit;">Le mie prenotazioni</h1>
                            <h2 style="font-weight: 300;color: #767e84;">Panoramica</h2>
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
