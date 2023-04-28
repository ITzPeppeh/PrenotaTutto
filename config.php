<?php
$username = "divino";
$password = "TV991T";
$hostname = "localhost";
$namebase = "divinodoni_prenotazioni";

$db = mysqli_connect ($hostname, $username, $password, $namebase);

if (mysqli_connect_errno())
{
    die ('Connection failed');
}
?>