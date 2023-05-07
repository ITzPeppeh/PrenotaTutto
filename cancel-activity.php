<?php 
    session_start();

    /*if(!isset($_SESSION["iduser"])) {
    header("Location: index.php");
    }*/ //APPENA LOGIN FATTO SI PUÓ TOGLIERE

    if (!$_GET && !$_POST) {
        header("Location: index.php");
    }

    include("config.php");

    if($_POST) {
        $codUtente = $_POST["codU"];
        $codAttivita = $_POST["prod"];

        $sql = "SELECT Persone FROM prenota WHERE Username = '$codUtente' AND CodA = '$codAttivita'";
        $result = mysqli_query($db, $sql);
        if (!$result) 
        {
            die ('Query error');
        }
        while ($row = mysqli_fetch_assoc($result))
        {
            $persone = $row["Persone"];
        }

        $sql = "DELETE FROM prenota
                WHERE Username = '$codUtente' AND CodA = '$codAttivita'";

        $result = mysqli_query($db, $sql);
        if (!$result) 
        {
            die ('Query error');
        }

        $sql = "UPDATE attivita
                SET PostiPren = PostiPren-'$persone'
                WHERE CodA = '$codAttivita'";
                
        $result = mysqli_query($db, $sql);
        if (!$result) 
        {
            die ('Query error');
        }

        header("Location: activity-history.php");
    }


?>