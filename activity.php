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
        <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
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
                        <h1 style="font-weight: 700;color: inherit;">Prenotati per l'attivitá</h1>
                        <h2 style="font-weight: 300;color: #767e84;"><?php echo $tempNomeA; ?></h2>
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