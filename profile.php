<?php 
    session_start();

    include("resources/data/timeout.php");
    checkSessionTimer();

    if(!isset($_SESSION["iduser"])) {
        header("Location: index.php");
    }
    $codUtente = $_SESSION["iduser"];

    include("resources/data/config.php");

    $sql = "SELECT Passwd, Cognome, Nome FROM utente WHERE Username='$codUtente'";
    $result = mysqli_query($db, $sql);
    if (!$result) 
    {
        die ('Query error');
    }
    $row = mysqli_fetch_assoc($result);

    $password = $row["Passwd"];
    $cognome = $row["Cognome"];
    $nome = $row["Nome"];

?>

<html>
    <head>
        <title><?php echo $titleWebSite; ?> - Profilo</title>
        <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
        <script type="text/javascript" src="resources/js/index.js"></script>
    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="myreg">

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
                    <h1 style="font-weight: 700;color: inherit;">Credenziali Profilo</h1>
                    <h2 style="font-weight: 300;color: #767e84;">Gestisci</h2>
                </div>
            </div>
        </header>

            <div class="content">
                <div class="controls">
                    <legend>Le tue credenziali</legend>
                    <div class="form-group">
                        <label for="nome">Nome*: </label>
                        <input type="text" name="nome" value="<?php echo $nome; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome*: </label>
                        <input type="text" name="cognome" value="<?php echo $cognome; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input type="text" name="username" value="<?php echo $codUtente; ?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="oldpasswd">Password attuale*: </label>
                        <input type="password" name="oldpasswd" id="passwd3" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="newpasswd1">Nuova password: </label>
                        <input type="password" name="passwd1" id="passwd1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="newpasswd2">Ripeti nuova password: </label>
                        <input type="password" name="passwd2" id="passwd2" class="form-control">
                    </div>
                    <input type="button" value="Aggiorna credenziali" class="btn" onclick="checkpwd()">
                    <?php 
                        if ($_POST) {
                            $pas = $_POST["oldpasswd"];
                            if (sha1($pas) != $password) {
                                echo '<font color="red">Password non corretta.</font>';
                            } else {
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
                                echo "<font color='green'>Credenziali aggiornate!</font>";
                            }
                    }
                    ?>
                </div>
            </div>
            
        </form>

    
    </body>
</html>




