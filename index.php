<?php
    session_start();

    include("resources/data/timeout.php");
    checkSessionTimer();

    if(isset($_SESSION["iduser"])) {
        $codUtente = $_SESSION["iduser"];
    } else {
        $codUtente = NULL;
    }

    include("resources/data/config.php");

    $sql = "SELECT * FROM attivita WHERE (MaxPosti-PostiPren)<>0";
    $result = mysqli_query($db, $sql);
    if (!$result) 
    {
        die ('Query error');
    }

    $numAttLibere = mysqli_num_rows($result);
?>
<html>
    <head>
        <title><?php echo $titleWebSite; ?></title>
        <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
    </head>
    <body>
        <form action="activity.php" method="GET" style="margin-top: 0px;">
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
                            <h1>Buongiorno,</h1>
                            <h2><i><?php echo $codUtente ? $codUtente : "Ospite"; ?></i></h2>
                        </div>
                    </div>
                    <div class="col" style="float:right;margin-right:50px;text-align:right;">
                        <div class="titled">
                            <div>Numero di attivitá libere:</div>
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
                        $sql = "SELECT CodA, NomeA, MaxPosti, PostiPren FROM attivita ORDER BY MaxPosti-PostiPren DESC";
                        $result = mysqli_query($db, $sql);
                        if (!$result) 
                        {
                            die ('Query error');
                        }
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $tempCodA = $row["CodA"];
                            $tempNomeA = $row["NomeA"];
                            $tempPostiPren = $row["PostiPren"];
                            $tempMaxPosti = $row["MaxPosti"];

                            
                            $sql2 = "SELECT * FROM prenota WHERE Username = '$codUtente' AND CodA='$tempCodA'";
                            $result2 = mysqli_query($db, $sql2);
                            if (!$result2)
                            {
                                die ('Query error');
                            }
                            while ($row = mysqli_fetch_assoc($result2)) {
                                $pren = true;
                            }

                            if (!$codUtente) {
                                $tiesto = " disabled>Accedi per prenotare";
                            } elseif (isset($pren)) {
                                $tiesto = " disabled>Giá prenotato";
                                unset($pren);
                            } elseif ($tempMaxPosti-$tempPostiPren == 0) {
                                $tiesto = " disabled>Posti terminati";
                            } else {
                                $tiesto = " >Prenota";
                            }

                            echo "<li class='table-row'>
                                    <div class='col col-1'>$tempNomeA</div>
                                    <div class='col col-2'>$tempPostiPren su $tempMaxPosti</div>
                                    <div class='col col-3'><button type='submit' value='$tempCodA' name='prod' $tiesto</button></div>
                                  </li>";
                        }
                    ?>
                    
                </ul>
            </div>
        </form>        
    </body>
</html>