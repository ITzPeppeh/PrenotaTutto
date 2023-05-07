<?php
$userDB = "divino";
$passDB = "TV991T";
$hostnameDB = "localhost";
$namebaseDB = "divinodoni_prenotazioni";

$db = mysqli_connect ($hostnameDB, $userDB, $passDB, $namebaseDB);

if (mysqli_connect_errno())
{
    die ('Connection failed');
}
?>