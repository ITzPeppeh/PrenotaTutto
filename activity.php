<?php 
    session_start();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    if (!$_GET && !$_POST) {
        header("Location: index.php");
    }

    include("config.php");

    //GET: CONTROLLO SE SEI GIÁ PRENOTATO OR PIENO=HEADER

    ?>

<html>
    <head>
        <title><?php echo $titleWebSite; ?> - My Activity</title>
    </head>
    <body>
        
    </body>
    <style>
        body {
            background-color: #f9f9fa;
        }
    </style>
</html>
<?php
    if (isset($_GET["prod"])) {
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
            echo "Attivitá n $tempCodA, titolo $tempNomeA, Posti disponibili $postiDisp";
        }
        
    } else {
        header("Location: index.php");
    }
?>
<form action="" method="POST">
    <label for="vogliopren">Prenoto per </label>
    <select name="vogliopren" required> <!--visualizza in base ai posti disp-->
    <?php 
        switch ($postiDisp) {
            case 1:
                echo "<option value = '1'>solo me</option>";
                break;
            case 2:
                echo "<option value = '1'>solo me</option>";
                echo "<option value = '2'>me e 1 figlio</option>";
                break;
            case 3:
                echo "<option value = '1'>solo me</option>";
                echo "<option value = '2'>me e 1 figlio</option>";
                echo "<option value = '3'>me e 2 figli</option>";
                break;
            case $postiDisp>=4:
                echo "<option value = '1'>solo me</option>";
                echo "<option value = '2'>me e 1 figlio</option>";
                echo "<option value = '3'>me e 2 figli</option>";
                echo "<option value = '4'>me e 3 figli</option>";
                break;
        }
    ?>
    </select>
    <input type="submit" value="Prenota ora!">
</form>
<?php 
    if ($_POST) {
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
            echo "Posti prenotati";
        } else {
            echo "Troppo tardi";
        }
    }
?>