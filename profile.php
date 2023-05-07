<?php 
    session_start();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    include("config.php");

    $sql = "SELECT Passwd, Cognome, Nome FROM utente WHERE Username='$codUtente'";
    $result = mysqli_query($db, $sql);
    if (!$result) 
    {
        die ('Query error');
    }
    while ($row = mysqli_fetch_assoc($result))
    {
        $password = $row["Passwd"];
        $cognome = $row["Cognome"];
        $nome = $row["Nome"];
    }

?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="myreg">
    <label for="nome">Nome: </label>
    <input type="text" name="nome" value="<?php echo $nome; ?>" required> <br>
    <label for="cognome">Cognome: </label>
    <input type="text" name="cognome" value="<?php echo $cognome; ?>" required> <br>
    <label for="username">Username: </label>
    <input type="text" name="username" value="<?php echo $codUtente; ?>" disabled> <br>
    <label for="oldpasswd">Vecchia password: </label>
    <input type="password" name="oldpasswd" id="passwd3" required> <br>
    <label for="newpasswd1">Nuova password: </label>
    <input type="password" name="passwd1" id="passwd1"> <br>
    <label for="newpasswd2">Ripeti nuova password: </label>
    <input type="password" name="passwd2" id="passwd2"> <br>
    <input type="button" value="Aggiorna credenziali" onclick="checkpwd()">
</form>

<?php 
    if ($_POST) {
        $pas = $_POST["oldpasswd"];
        if (sha1($pas) != $password) {
            die("Password non corretta.");
        }
    

    $tempNome = $_POST["nome"];
    $tempCognome = $_POST["cognome"];
    $che = sha1($_COOKIE["pwd"]);
    $posPassword = $che == $pas ? $pas : $che;

    $sql = "UPDATE utente
            SET Nome = '$tempNome', Cognome = '$tempCognome', Passwd = '$posPassword'
            WHERE Username = '$codUtente'";
            
    $result = mysqli_query($db, $sql);
    if (!$result) 
    {
        die ('Query error');
    }
    echo "Credenziali aggiornate!";
}
?>

<script>
    function checkpwd() {

        var password1 = document.getElementById('passwd1').value;
        var password2 = document.getElementById('passwd2').value;
        var oldpassword = document.getElementById('passwd3').value;

        if (password1) {
            if (password1 == password2) {
                if(password1.length >= 8) {
                    if (password1.match("[A-Z]")) {
                        if (password1.match("[0-9]")) {
                            document.getElementById("myreg").submit();
                        } else {
                            alert("Password must include at least one number");
                        }
                    } else {
                        alert("Password must include at least one upper case letter");
                    }
                } else {
                    alert("Password must be at least 8 characters in length");
                }
            } else {
                alert("Password non coincidono");
            }
        } else {
            document.cookie = "pwd=" + oldpassword;
            document.getElementById("myreg").submit();
        }

        
    }
</script>