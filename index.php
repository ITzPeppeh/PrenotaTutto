<?php
    session_start();

    if(isset($_SESSION["iduser"])) {
        $codUtente = $_SESSION["iduser"];
    } else {
        $codUtente = NULL;
    }

    include("config.php");

    //controllo var
?>
<html>
    <body>
        Benvenuto, <?php echo $codUtente ? $codUtente : "ospite"; ?><br>
        <form action="activity.php" method="GET">
            <table>
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
                        $tiesto = " disabled>Registrati per prenotare";
                    } elseif (isset($pren)) {
                        $tiesto = " disabled>Giá prenotato";
                        unset($pren);
                    } elseif ($tempMaxPosti-$tempPostiPren == 0) {
                        $tiesto = " disabled>Posti terminati";
                    } else {
                        $tiesto = " >PRENOTA";
                    }

                    echo "<tr> <td>$tempNomeA</td> <td>$tempPostiPren/$tempMaxPosti</td> <td> <button type='submit' value='$tempCodA' name='prod' $tiesto</button> </td> </tr>"; //CONTROLLO MAX POSTI, SE GIÁ PRENOTATO
                }
                    
                ?>
            </table>
        </form>
        
    </body>
</html>