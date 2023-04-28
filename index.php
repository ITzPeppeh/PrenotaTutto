<?php
    session_start();

    if(isset($_SESSION["iduser"])) {
        $username = $_SESSION["iduser"];
    } else {
        $username = NULL;
    }

    //controllo var
?>