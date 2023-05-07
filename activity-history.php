<?php 
    session_start();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    include("config.php");
?>

<form action="cancel-activity.php" method="POST">
    <input type="hidden" name="codU" value='<?php echo $codUtente; ?>'>
    <table>
        <?php 
            $sql = "SELECT P.CodA, A.NomeA, P.Persone
                    FROM prenota P, attivita A
                    WHERE P.CodA=A.CodA AND P.Username='$codUtente'";
            $result = mysqli_query($db, $sql);
            if (!$result) 
            {
                die ('Query error');
            }
            while ($row = mysqli_fetch_assoc($result))
            {
                $tempCodA = $row["CodA"];
                $tempNomeA = $row["NomeA"];
                $tempPersPren = $row["Persone"];
                echo "<tr> <td>$tempNomeA</td> <td>$tempPersPren</td> <td> <button type='submit' value='$tempCodA' name='prod' >DISDICI</button> </td> </tr>";
            }
        ?>
    </table>
</form>
